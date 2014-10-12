<?php

$result = '';

if (isset($_GET['lib'])) {
	switch ($_GET['lib']) {
		case 'jquery':
			$libinfo = include("../libs/jquery1.php");
			$result = $libinfo['version']();

			break;
		case 'bootstrap':
			$libinfo = include("../libs/bootstrap3.php");
			$result = $libinfo['version']();

			break;
		case 'daterangepicker':
			$libinfo = include("../libs/daterangepicker.php");
			$result = $libinfo['version']();

			break;
		case 'momentjs':
			$libinfo = include("../libs/momentjs.php");
			$result = $libinfo['version']();

			break;
	}
}

echo $result;
