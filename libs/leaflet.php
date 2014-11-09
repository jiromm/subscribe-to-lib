<?php

return [
	'name' => 'Leaflet',
	'vendor' => 'Vladimir Agafonkin',
	'version' => function() {
		$jsLatest = file_get_contents('http://leafletjs.com/download.html');

		if ($jsLatest) {
			if (preg_match('/Leaflet (\d{1,2}\.\d{1,2}\.\d{1,2})/i', $jsLatest, $matches)) {
				return $matches[1];
			}
		}

		return false;
	}
];
