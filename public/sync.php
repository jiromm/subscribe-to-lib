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
				if (isset($data['channels'])) {
					$st = $conn->prepare('
						select library.id, library.name, library.version from rel_subscriber_library
						left join library on library.id = rel_subscriber_library.library_id
						left join subscriber on subscriber.id = rel_subscriber_library.subscriber_id
						where subscriber.email = ?;
					');
					$st->execute([$data['email']]);
					$channels = $st->fetchAll(PDO::FETCH_ASSOC);

					$result = [
						'status' => 'success',
						'message' => 'Everything is ok.',
						'channels' => $channels,
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
}

header('Content-Type: application/json');
echo json_encode($result);
