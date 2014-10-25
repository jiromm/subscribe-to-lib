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
				if (isset($data['channel']) && isset($data['version']) && isset($data['status'])) {
					$st = $conn->prepare('select * from subscriber where email = ?;');
					$st->execute([$data['email']]);
					$subscriberId = $st->fetchColumn();

					if (preg_match('/^[\d.]+$/', $data['version'])) {
						if (isset($data['channel'])) {
							if (intval($data['status'])) {
								$st = $conn->prepare('
									insert into rel_subscriber_library(subscriber_id, library_id, subscriber_version, notification_date) values(
										(select id from subscriber where email = ?),
										(select id from library where alias = ?),
										?, ?
									);
								');
								$st->execute([$data['email'], $data['channel'], $data['version'], date('Y-m-d H:i:s')]);
							} else {
								$st = $conn->prepare('
									delete from rel_subscriber_library where subscriber_id = (
										select id from subscriber where email = ?
									) and library_id = (
										select id from library where alias = ?
									);
								');
								$st->execute([$data['email'], $data['channel']]);
							}

							$result = [
								'status' => 'success',
								'message' => 'You are successfully subscribed to the selected library.'
							];
						} else {
							$result['message'] = 'Bad data provided';
						}
					} else {
						$result['message'] = 'Bad data provided';
					}
				} else {
					$st = $conn->prepare('select * from subscriber where email = ?;');
					$st->execute([$data['email']]);
					$subscriberId = $st->fetchColumn();
					$subscriptionList = [];

					if ($subscriberId === false) {
						$st = $conn->prepare('insert into subscriber(email, registration_date, hash) values(?, ?, ?);');
						$st->execute([$data['email'], date('Y-m-d H:i:s'), getHash($data['email'])]);

						$subscriberId = $conn->lastInsertId();
					} else {
						if (isset($data['channels']) && count($data['channels'])) {
							$stSubscriptions = $conn->prepare('select * from rel_subscriber_library where subscriber_id = ?;');
							$stSubscriptions->execute([$subscriberId]);
							$subscriptions = $stSubscriptions->fetchAll(PDO::FETCH_ASSOC);

							if (count($subscriptions)) {
								foreach ($subscriptions as $subscription) {
									array_push($subscriptionList, $subscription['library_id']);
								}
							}
						}
					}

					if (isset($data['channels']) && count($data['channels'])) {
						$stInsert = $conn->prepare('
							insert into rel_subscriber_library(subscriber_id, library_id, subscriber_version, notification_date) values(?, ?, ?, ?);
						');
						$st = $conn->prepare('select * from library;');
						$st->execute();
						$libraries = $st->fetchAll(PDO::FETCH_ASSOC);

						if (count($libraries)) {
							foreach ($libraries as $library) {
								if (in_array($library['id'], $subscriptionList)) {
									continue;
								}

								if (array_key_exists($library['alias'], $data['channels'])) {
									$stInsert->execute([
										$subscriberId,
										$library['id'],
										$data['channels'][$library['alias']],
										date('Y-m-d H:i:s')
									]);
								}
							}
						}
					}

					$result = [
						'status' => 'success',
						'message' => 'You are successfully subscribed to the selected libraries.'
					];
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
	die($ex->getMessage());
}

header('Content-Type: application/json');
echo json_encode($result);
