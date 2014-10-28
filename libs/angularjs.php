<?php

return [
	'name' => 'AngularJS',
	'vendor' => 'Google, Inc.',
	'version' => function() {
		$jsLatest = file_get_contents('https://angularjs.org/');

		if ($jsLatest) {
			$jsLatest = str_replace("\n", '', $jsLatest);

			if (preg_match('/libs\/angularjs\/(\d{1,2}\.\d{1,2}\.\d{1,2})\/angular\.min\.js/i', $jsLatest, $matches)) {
				return $matches[1];
			}
		}

		return false;
	}
];
