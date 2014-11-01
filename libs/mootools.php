<?php

return [
	'name' => 'MooTools',
	'vendor' => 'Valerio Proietti',
	'version' => function() {
		$jsLatest = file_get_contents('http://mootools.net/download');

		if ($jsLatest) {
			$jsLatest = str_replace("\n", '', $jsLatest);

			if (preg_match('/Download MooTools (\d{1,2}\.\d{1,2}\.\d{1,2})/i', $jsLatest, $matches)) {
				return $matches[1];
			}
		}

		return false;
	}
];
