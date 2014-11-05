<?php

return [
	'name' => 'Video.js',
	'vendor' => 'Brightcove, Inc.',
	'version' => function() {
		$jsLatest = file_get_contents('http://www.videojs.com/');

		if ($jsLatest) {
			if (preg_match('/vjs\.zencdn\.net\/(\d{1,2}\.\d{1,2}\.\d{1,2})\/video\.js/i', $jsLatest, $matches)) {
				return $matches[1];
			}
		}

		return false;
	}
];
