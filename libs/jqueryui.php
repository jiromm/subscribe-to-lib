<?php

return [
	'name' => 'jQuery UI',
	'vendor' => 'The jQuery Foundation',
	'version' => function() {
		$jsLatest = file_get_contents('http://jqueryui.com/');

		if ($jsLatest) {
			$jsLatest = str_replace("\n", '', $jsLatest);

			if (preg_match('/Download jQuery UI (\d{1,2}\.\d{1,2}\.\d{1,2})/i', $jsLatest, $matches)) {
				return $matches[1];
			}
		}

		return false;
	}
];
