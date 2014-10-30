<?php

return [
	'name' => 'Ember',
	'vendor' => 'Tilde, Inc.',
	'version' => function() {
		$jsLatest = file_get_contents('http://emberjs.com/');

		if ($jsLatest) {
			$jsLatest = str_replace("\n", '', $jsLatest);
			$jsLatest = str_replace(" ", '', $jsLatest);

			if (preg_match('/class="info">(\d{1,2}\.\d{1,2}\.\d{1,2}):/i', $jsLatest, $matches)) {
				return $matches[1];
			}
		}

		return false;
	}
];
