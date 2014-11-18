<?php

return [
	'name' => 'Slick',
	'vendor' => 'Ken Wheeler',
	'version' => function() {
		$jsLatest = file_get_contents('http://kenwheeler.github.io/slick/');

		if ($jsLatest) {
			if (preg_match('/(\d{1,2}\.\d{1,2}\.\d{1,2})\.zip/i', $jsLatest, $matches)) {
				return $matches[1];
			}
		}

		return false;
	}
];
