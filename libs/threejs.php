<?php

return [
	'name' => 'Three.js',
	'vendor' => 'Mr.doob',
	'version' => function() {
		$jsLatest = file_get_contents('http://threejs.org/');

		if ($jsLatest) {
			if (preg_match('/<a href="http:\/\/github\.com\/mrdoob\/three\.js\/releases">(r\d{2,3})<\/a>/i', $jsLatest, $matches)) {
				return $matches[1];
			}
		}

		return false;
	}
];
