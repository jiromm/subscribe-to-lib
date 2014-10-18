<?php

require_once(dirname(__DIR__) . '/general/get-connection.php');

try {
	$st = $conn->prepare('select * from library;');
	$st->execute();

	return $st->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $ex) {
	return [];
}
