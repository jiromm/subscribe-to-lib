<?php

require_once(dirname(__DIR__) . '/general/get-connection.php');
require_once(dirname(__DIR__) . '/general/functions.php');

try {
	if (isset($_GET['email']) && $_GET['hash']) {
		$st = $conn->prepare('select * from subscriber where email = ? and hash = ?;');
		$st->execute([$_GET['email'], $_GET['hash']]);
		$subscriberId = $st->fetchColumn();

		$st = $conn->prepare('update subscriber set subscribed = 0 where id = ?;');
		$st->execute([$subscriberId]);

		$result = true;
	} else {
		$result = false;
	}
} catch (Exception $ex) {
	$result = false;
}

if ($result) {
	echo 'You are successfully unsubscribed.';
} else {
	echo 'Something went wrong';
}
