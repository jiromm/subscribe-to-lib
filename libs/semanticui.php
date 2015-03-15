<?php

return [
	'name' => 'Semantic UI',
	'vendor' => 'Jack Lukic',
	'version' => function() {
		$jsLatest = file_get_contents('https://raw.githubusercontent.com/Semantic-Org/Semantic-UI/master/dist/semantic.min.js');

		if ($jsLatest) {
			if (preg_match('/Semantic UI - (\d{1,2}\.\d{1,2}\.\d{1,2})/i', $jsLatest, $matches)) {
				return $matches[1];
			}
		}

		return false;
	}
];
