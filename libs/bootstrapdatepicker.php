<?php

return [
	'name' => 'Date Picker for Bootstrap',
	'vendor' => 'Andrew Rowls',
	'version' => function() {
		$jsLatest = file_get_contents('https://raw.githubusercontent.com/eternicode/bootstrap-datepicker/master/dist/js/bootstrap-datepicker.min.js');

		if ($jsLatest) {
			if (preg_match('/Datepicker for Bootstrap v(\d{1,2}\.\d{1,2}\.\d{1,2})/i', $jsLatest, $matches)) {
				return $matches[1];
			}
		}

		return false;
	}
];
