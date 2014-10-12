<?php

$result = [];

if (!isset($_GET['lib'])) {
	return false;
} else {

	switch ($_GET['lib']) {
		case 'jQuery':
			$libinfo = include("../libs/jquery.php");

			$libName = $libinfo['name'];
			$libVendor = $libinfo['vendor'];
			$libVersion = $libinfo['version']();

			$result = ['version' => $libVersion];
	}
}

header('Content-Type: application/json');

echo json_encode($result);
