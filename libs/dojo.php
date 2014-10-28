<?php

return [
	'name' => 'Dojo Toolkit',
	'vendor' => 'The Dojo Foundation',
	'version' => function() {
		$jsLatest = file_get_contents('http://dojotoolkit.org/download/');

		if ($jsLatest) {
			$jsLatest = str_replace("\n", '', $jsLatest);

			if (preg_match('/Download (\d{1,2}\.\d{1,2}\.\d{1,2})/i', $jsLatest, $matches)) {
				return $matches[1];
			}
		}

		return false;
	}
];
