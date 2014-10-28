<?php

return [
	'name' => 'Modernizr',
	'vendor' => 'Stu Cox, Paul Irish, ...',
	'version' => function() {
		$jsLatest = file_get_contents('http://modernizr.com/');

		if ($jsLatest) {
			$jsLatest = str_replace("\n", '', $jsLatest);

			if (preg_match('/Download Modernizr (\d{1,2}\.\d{1,2}\.\d{1,2})/i', $jsLatest, $matches)) {
				return $matches[1];
			}
		}

		return false;
	}
];
