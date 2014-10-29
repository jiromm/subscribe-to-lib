<?php

return [
	'name' => 'jQuery Form Plugin',
	'vendor' => 'Mike Alsup',
	'version' => function() {
		$jsLatest = file_get_contents('http://malsup.github.io/jquery.form.js');

		if ($jsLatest) {
			$jsLatest = substr($jsLatest, 0, 50);

			if (preg_match('/version: (\d{1,2}\.\d{1,2}\.\d{1,2})-/i', $jsLatest, $matches)) {
				return $matches[1];
			}
		}

		return false;
	}
];
