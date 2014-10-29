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
					$st = $conn->prepare('
						select library.id, library.alias, library.version from rel_subscriber_library
							left join library on library.id = rel_subscriber_library.library_id
						where rel_subscriber_library.subscriber_id = ?;
					');
					$st->execute([$subscriberId]);
					$channels = $st->fetchAll(PDO::FETCH_ASSOC);
					$channelsClientSimpleList = [];

					if (count($channels)) {
						// Get client side list
						foreach ($data['channels'] as $alias => $version) {
							array_push($channelsClientSimpleList, $alias);
						}

						// Prepare to return also server side list
						foreach ($channels as $channel) {
							if (in_array($channel['alias'], $channelsClientSimpleList)) {
								continue;
							}

							array_push($channels, ['alias' => $channel['alias'], 'version' => $channel['version']]);
						}
					} else {
						$channels = $data['channels'];
					}

					$result = [
						'status' => 'success',
						'message' => 'Synchronized!',
						'channels' => $channels,
					];
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
