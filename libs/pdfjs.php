<?php

return [
	'name' => 'PDF.js',
	'vendor' => 'Mozilla',
	'version' => function() {
		$jsLatest = file_get_contents('http://mozilla.github.io/pdf.js/getting_started/');

		if ($jsLatest) {
			if (preg_match('/Stable \(v(\d{1,2}\.\d{1,2}\.\d{1,3})/i', $jsLatest, $matches)) {
				return $matches[1];
			}
		}

		return false;
	}
];
