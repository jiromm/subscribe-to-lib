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
					$result = [
						'status' => 'success',
						'message' => 'Everything is ok.',
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
