<?php

require_once('config.php');

try {
	$conn = new PDO("mysql:dbname={$mysqlDb}", $mysqlUser, $mysqlPassword);
} catch (Exception $ex) {
	die('Problem with server. Try later.');
}
