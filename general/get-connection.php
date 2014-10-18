<?php

require_once(dirname(__DIR__) . '/general/config.php');

try {
	$conn = new PDO("mysql:dbname={$mysqlDb}", $mysqlUser, $mysqlPassword);
} catch (Exception $ex) {
	die('Problem with server. Try later.');
}
