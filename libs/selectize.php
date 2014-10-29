<?php

return [
	'name' => 'Selectize.js',
	'vendor' => 'Brian Reavis',
	'version' => function() {
		$jsLatest = file_get_contents('https://raw.githubusercontent.com/brianreavis/selectize.js/master/dist/js/selectize.min.js');

		if ($jsLatest) {
			$jsLatest = substr($jsLatest, 0, 30);

			if (preg_match('/selectize\.js - v(\d{1,2}\.\d{1,2}\.\d{1,2})/i', $jsLatest, $matches)) {
				return $matches[1];
			}
		}

		return false;
	}
];
