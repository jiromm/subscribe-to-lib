<?php

return [
	'name' => 'Ace',
	'vendor' => 'Cloud9 IDE, Inc.',
	'version' => function() {
		$jsLatest = file_get_contents('https://raw.githubusercontent.com/ajaxorg/ace-builds/master/ChangeLog.txt');

		if ($jsLatest) {
			if (preg_match('/Version (\d{1,2}\.\d{1,2}\.\d{1,2})/i', $jsLatest, $matches)) {
				return $matches[1];
			}
		}

		return false;
	}
];
