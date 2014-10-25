<?php

require_once(dirname(__DIR__) . '/general/get-connection.php');
require_once(dirname(__DIR__) . '/general/functions.php');

$phpInput = file_get_contents('php://input');
$result = [
	'status' => 'error',
	'message' => 'Something went wrong. Please contact to author.',
];

try {
	if (!empty($phpInput)) {
		$data = json_decode($phpInput, true);

		if (isset($data['email'])) {
			if (filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
				$st = $conn->prepare('
					select id from subscriber
					where subscriber.email = ?;
				');
				$st->execute([$data['email']]);
				$subscriberId = $st->fetchColumn();

				if ($subscriberId) {
					if (isset($data['channels'])) {
						$st = $conn->prepare('
							select library.id, library.alias, library.version from rel_subscriber_library
							left join library on library.id = rel_subscriber_library.library_id
							where subscriber.id = ?;
						');
						$st->execute([$subscriberId]);
						$channels = $st->fetchAll(PDO::FETCH_ASSOC);
						$channelsSimpleList = [];
						$channelsRelList = [];

						if (count($channels)) {
							foreach ($channels as $channel) {
								array_push($channelsSimpleList, $channel['alias']);
								$channelsRelList[$channel['alias']] = [
									'id' => $channel['id'],
									'version' => $channel['version'],
								];
							}

							if (count($data['channels'])) {
								$stInsert = $conn->prepare('
									insert into rel_subscriber_library(subscriber_id, library_id, subscriber_version, notification_date) values(?, ?, ?, ?);
								');

								foreach ($data['channels'] as $alias => $version) {
									if (in_array($alias, $channelsSimpleList)) {
										continue;
									}

									// Prepare to return
									array_push($channels, ['alias' => $alias, 'version' => $version]);

									// Save to db
									$stInsert->execute([$subscriberId, $channelsRelList[$alias]['id'], $channelsRelList[$alias]['version'], date('Y-m-d H:i:s')]);
								}
							}
						} else {
							$channels = $data['channels'];
						}

						$result = [
							'status' => 'success',
							'message' => 'Synchronized!',
							'channels' => $channels,
						];
					}
				} else {
					$result['message'] = 'Bad request';
				}
			} else {
				$result['message'] = 'Email invalid';
			}
		} else {
			$result['message'] = 'Bad request';
		}
	} else {
		$result['message'] = 'Bad request';
	}
} catch (Exception $ex) {
	// do nothing
}

header('Content-Type: application/json');
echo json_encode($result);
