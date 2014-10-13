<?php

require_once('../general/get-connection.php');

$phpInput = file_get_contents('php://input');
$result = [
	'status' => 'error',
	'message' => 'Something went wrong. Please contact to author.',
];

if (!empty($phpInput)) {
	$data = json_decode($phpInput, true);

	if (isset($data['email'])) {
		if (filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
			$st = $conn->prepare('select * from subscriber where email = ?;');
			$st->execute([$data['email']]);
			$subscriber = $st->fetchColumn();

			if ($subscriber === false) {
				$st = $conn->prepare('insert into subscriber(email, registration_date) values(?, ?);');
				$st->execute([$data['email'], date('Y-m-d H:i:s')]);

				$subscriberId = $conn->lastInsertId();

				if (count($data['channels'])) {
					$stInsert = $conn->prepare('
						insert into rel_subscriber_library(subscriber_id, library_id, subscriber_version, notification_date) values(?, ?, ?, ?);
					');
					$st = $conn->prepare('select * from library;');
					$st->execute();
					$libraries = $st->fetchAll(PDO::FETCH_ASSOC);

					if (count($libraries)) {
						foreach ($libraries as $library) {
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

					$result = [
						'status' => 'success',
						'message' => 'You are successfully subscribed to the selected libraries.'
					];
				}
			} else {
				die($subscriber);
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

header('Content-Type: application/json');
echo json_encode($result);
