<?php

return [
	'name' => 'Prototype',
	'vendor' => 'Prototype Core Team',
	'version' => function() {
		$jsLatest = file_get_contents('http://prototypejs.org/');

		if ($jsLatest) {
			$jsLatest = str_replace("\n", '', $jsLatest);

			if (preg_match('/Prototype (\d{1,2}\.\d{1,2}\.\d{1,2})/i', $jsLatest, $matches)) {
				return $matches[1];
			}
		}

		return false;
	}
];
