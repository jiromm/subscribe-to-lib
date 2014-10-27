<?php

return [
	'name' => 'jQuery Validation Plugin',
	'vendor' => 'Jörn Zaefferer',
	'version' => function() {
		$jsLatest = file_get_contents('http://jqueryvalidation.org/');

		if ($jsLatest) {
			$jsLatest = str_replace("\n", '', $jsLatest);

			if (preg_match('/Current version:<\/strong> (\d{1,2}\.\d{1,2}\.\d{1,2})/i', $jsLatest, $matches)) {
				return $matches[1];
			}
		}

		return false;
	}
];
