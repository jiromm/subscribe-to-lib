<?php

return [
	'name' => 'Jasmine',
	'vendor' => 'Pivotal Labs',
	'version' => function() {
		$jsLatest = file_get_contents('https://raw.githubusercontent.com/pivotal/jasmine/master/package.json');

		if ($jsLatest) {
			if (preg_match('/"version": "(\d{1,2}\.\d{1,2}\.\d{1,2})/i', $jsLatest, $matches)) {
				return $matches[1];
			}
		}

		return false;
	}
];
