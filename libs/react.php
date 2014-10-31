<?php

return [
	'name' => 'React',
	'vendor' => 'Facebook, Inc.',
	'version' => function() {
		$jsLatest = file_get_contents('http://facebook.github.io/react/');

		if ($jsLatest) {
			$jsLatest = str_replace("\n", '', $jsLatest);

			if (preg_match('/Download React v(\d{1,2}\.\d{1,2}\.\d{1,2})/i', $jsLatest, $matches)) {
				return $matches[1];
			}
		}

		return false;
	}
];
