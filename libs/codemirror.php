<?php

return [
	'name' => 'CodeMirror',
	'vendor' => 'Marijn Haverbeke',
	'version' => function() {
		$jsLatest = file_get_contents('http://codemirror.net/');

		if ($jsLatest) {
			if (preg_match('/version (\d{1,2}\.\d{1,2})/i', $jsLatest, $matches)) {
				return $matches[1];
			}
		}

		return false;
	}
];
