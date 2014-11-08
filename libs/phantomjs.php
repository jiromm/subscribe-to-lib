<?php

return [
	'name' => 'PhantomJS',
	'vendor' => 'Jamie Mason',
	'version' => function() {
		$jsLatest = file_get_contents('http://phantomjs.org/download.html');

		if ($jsLatest) {
			if (preg_match('/phantomjs-(\d{1,2}\.\d{1,2}\.\d{1,2})/i', $jsLatest, $matches)) {
				return $matches[1];
			}
		}

		return false;
	}
];
