<?php

return [
	'name' => 'Select2',
	'vendor' => 'Igor Vaynberg',
	'version' => function() {
		$jsLatest = file_get_contents('http://ivaynberg.github.io/select2/');

		if ($jsLatest) {
			$jsLatest = str_replace("\n", '', $jsLatest);

			if (preg_match('/Select2 (\d{1,2}\.\d{1,2}\.\d{1,2})/i', $jsLatest, $matches)) {
				return $matches[1];
			}
		}

		return false;
	}
];
