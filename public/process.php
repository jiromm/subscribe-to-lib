<?php

$result = '';

if (isset($_GET['lib'])) {
	switch ($_GET['lib']) {
		case 'jquery':
			$libinfo = include("../libs/jquery.php");

			$libName = $libinfo['name'];
			$libVendor = $libinfo['vendor'];
			$libVersion = $libinfo['version']();

			$result = $libVersion;

			break;
		case 'bootstrap':
			$libinfo = include("../libs/bootstrap.php");

			$libName = $libinfo['name'];
			$libVendor = $libinfo['vendor'];
			$libVersion = $libinfo['version']();

			$result = $libVersion;

			break;
	}
}

echo $result;
