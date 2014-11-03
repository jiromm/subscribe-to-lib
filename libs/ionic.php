<?php

return [
	'name' => 'Ionic',
	'vendor' => 'Drifty Co',
	'version' => function() {
		$jsLatest = file_get_contents('http://ionicframework.com/');

		if ($jsLatest) {
			$jsLatest = str_replace("\n", '', $jsLatest);

			if (preg_match('/v(\d{1,2}\.\d{1,2}\.\d{1,2})/i', $jsLatest, $matches)) {
				return $matches[1];
			}
		}

		return false;
	}
];
