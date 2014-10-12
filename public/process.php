<?php

//$result = [];
$result = '';

if (!isset($_GET['lib'])) {
	return false;
} else {
	switch ($_GET['lib']) {
		case 'jquery':
			$libinfo = include("../libs/jquery.php");

			$libName = $libinfo['name'];
			$libVendor = $libinfo['vendor'];
			$libVersion = $libinfo['version']();

//			$result = ['version' => $libVersion];
			$result = $libVersion;
	}
}

//header('Content-Type: application/json');
//echo json_encode($result);

echo $result;
