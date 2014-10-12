<?php

return [
	'name' => 'Moment.js',
	'vendor' => 'Tim Wood, Iskren Chernev',
	'version' => function() {
		$jsLatest = file_get_contents('http://momentjs.com/static/js/global.js');

		if ($jsLatest) {
			$jsLatest = substr($jsLatest, 0, 50);

			if (preg_match('/version \: (\d{1,2}\.\d{1,2}\.\d{1,2})/i', $jsLatest, $matches)) {
				return $matches[1];
			}
		}

		return false;
	}
];
