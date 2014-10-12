<?php

return [
	'name' => 'jQuery',
	'vendor' => 'jQuery Foundation, Inc.',
	'version' => function() {
		$jsLatest = file_get_contents('http://code.jquery.com/jquery-latest.min.js');

		if ($jsLatest) {
			$jsLatest = substr($jsLatest, 0, 20);

			if (preg_match('/v(\d{1,2}\.\d{1,2}\.\d{1,2})/i', $jsLatest, $matches)) {
				return $matches[1];
			}
		}

		return false;
	}
];
