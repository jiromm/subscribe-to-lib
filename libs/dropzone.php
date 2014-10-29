<?php

return [
	'name' => 'Dropzone.js',
	'vendor' => 'Matias Meno',
	'version' => function() {
		$jsLatest = file_get_contents('https://raw.githubusercontent.com/enyo/dropzone/master/lib/dropzone.js');

		if ($jsLatest) {
			$jsLatest = str_replace("\n", '' ,$jsLatest);

			if (preg_match('/Dropzone.version = "(\d{1,2}\.\d{1,2}\.\d{1,2})/i', $jsLatest, $matches)) {
				return $matches[1];
			}
		}

		return false;
	}
];
