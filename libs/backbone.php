<?php

return [
	'name' => 'Backbone.js',
	'vendor' => 'Jeremy Ashkenas',
	'version' => function() {
		$jsLatest = file_get_contents('http://backbonejs.org/backbone.js');

		if ($jsLatest) {
			if (preg_match('/Backbone\.js (\d{1,2}\.\d{1,2}\.\d{1,2})/i', $jsLatest, $matches)) {
				return $matches[1];
			}
		}

		return false;
	}
];
