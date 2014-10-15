<?php

require_once('config.php');

$conn = new PDO("mysql:dbname={$mysqlDb}", $mysqlUser, $mysqlPassword);
