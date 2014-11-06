<?php

return [
	'name' => 'Less',
	'vendor' => 'Alexis Sellier',
	'version' => function() {
		$jsLatest = file_get_contents('http://lesscss.org/');

		if ($jsLatest) {
			if (preg_match('/<li>Currently v(\d{1,2}\.\d{1,2}\.\d{1,2})/i', $jsLatest, $matches)) {
				return $matches[1];
			}
		}

		return false;
	}
];
