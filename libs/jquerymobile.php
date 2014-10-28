<?php

return [
	'name' => 'jQuery Mobile',
	'vendor' => 'The jQuery Foundation',
	'version' => function() {
		$jsLatest = file_get_contents('http://jquerymobile.com/');

		if ($jsLatest) {
			$jsLatest = str_replace("\n", '', $jsLatest);

			if (preg_match('/Version (\d{1,2}\.\d{1,2}\.\d{1,2})/i', $jsLatest, $matches)) {
				return $matches[1];
			}
		}

		return false;
	}
];
