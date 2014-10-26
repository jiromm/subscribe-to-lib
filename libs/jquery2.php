<?php

return [
	'name' => 'jQuery',
	'vendor' => 'jQuery Foundation, Inc.',
	'version' => function() {
		$jsLatest = file_get_contents('http://jquery.com/download/');

		if ($jsLatest) {
			$jsLatest = str_replace("\n", '', $jsLatest);

			if (preg_match('/Download the compressed, production jQuery (2\.\d{1,2}\.\d{1,2})/i', $jsLatest, $matches)) {
				return $matches[1];
			}
		}

		return false;
	}
];
