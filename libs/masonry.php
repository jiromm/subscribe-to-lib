<?php

return [
	'name' => 'Masonry',
	'vendor' => 'David DeSandro',
	'version' => function() {
		$jsLatest = file_get_contents('http://masonry.desandro.com/masonry.pkgd.min.js');

		if ($jsLatest) {
			$jsLatest = substr($jsLatest, 0, 50);

			if (preg_match('/Masonry PACKAGED v(\d{1,2}\.\d{1,2}\.\d{1,2})/i', $jsLatest, $matches)) {
				return $matches[1];
			}
		}

		return false;
	}
];
