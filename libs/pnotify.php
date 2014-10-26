<?php

return [
	'name' => 'PNotify',
	'vendor' => 'Hunter Perrin',
	'version' => function() {
		$jsLatest = file_get_contents('http://sciactive.github.io/pnotify/pnotify.core.js');

		if ($jsLatest) {
			$jsLatest = substr($jsLatest, 0, 40);

			if (preg_match('/PNotify (\d{1,2}\.\d{1,2}\.\d{1,2})/i', $jsLatest, $matches)) {
				return $matches[1];
			}
		}

		return false;
	}
];
