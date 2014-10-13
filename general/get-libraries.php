<?php

require_once('get-connection.php');

$st = $conn->prepare('select * from library;');
$st->execute();

return $st->fetchAll(PDO::FETCH_ASSOC);
