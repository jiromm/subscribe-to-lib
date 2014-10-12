<?php

return [
	'name' => 'Date Range Picker for Bootstrap',
	'vendor' => 'Dan Grossman',
	'version' => function() {
		$jsLatest = file_get_contents('https://raw.githubusercontent.com/dangrossman/bootstrap-daterangepicker/master/daterangepicker.js');

		if ($jsLatest) {
			$jsLatest = substr($jsLatest, 0, 30);

			if (preg_match('/@version: (\d{1,2}\.\d{1,2}\.\d{1,2})/i', $jsLatest, $matches)) {
				return $matches[1];
			}
		}

		return false;
	}
];
