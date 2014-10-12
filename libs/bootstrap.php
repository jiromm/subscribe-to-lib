<?php

return [
	'name' => 'Twitter Bootstrap',
	'vendor' => 'Twitter, Inc.',
	'version' => function() {
		$page = file_get_contents('http://getbootstrap.com');

		if ($page) {
			$page = str_replace("\n", '', $page);

			if (preg_match("/Currently v(\d{1,2}\.\d{1,2}\.\d{1,2})/i", $page, $matches)) {
				return $matches[1];
			}
		}

		return false;
	}
];
