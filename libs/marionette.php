<?php

return [
	'name' => 'Marionette',
	'vendor' => 'Derick Bailey, Muted Solutions, LLC',
	'version' => function() {
		$jsLatest = file_get_contents('http://marionettejs.com/');

		if ($jsLatest) {
			if (preg_match('/v(\d{1,2}\.\d{1,2}\.\d{1,2})/i', $jsLatest, $matches)) {
				return $matches[1];
			}
		}

		return false;
	}
];
