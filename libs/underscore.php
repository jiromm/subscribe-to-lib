<?php

return [
	'name' => 'Underscore',
	'vendor' => 'Jeremy Ashkenas',
	'version' => function() {
		$jsLatest = file_get_contents('http://underscorejs.org/underscore.js');

		if ($jsLatest) {
			$jsLatest = substr($jsLatest, 0, 30);

			if (preg_match('/Underscore\.js (\d{1,2}\.\d{1,2}\.\d{1,2})/i', $jsLatest, $matches)) {
				return $matches[1];
			}
		}

		return false;
	}
];
