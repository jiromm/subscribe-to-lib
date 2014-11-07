<?php

return [
	'name' => 'D3',
	'vendor' => 'Mike Bostock',
	'version' => function() {
		$jsLatest = file_get_contents('https://raw.githubusercontent.com/mbostock/d3/master/src/start.js');

		if ($jsLatest) {
			if (preg_match('/version\: \"(\d{1,2}\.\d{1,2}\.\d{1,2})/i', $jsLatest, $matches)) {
				return $matches[1];
			}
		}

		return false;
	}
];
