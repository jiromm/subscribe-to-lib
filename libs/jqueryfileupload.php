<?php

return [
	'name' => 'jQuery File Upload',
	'vendor' => 'Sebastian Tschan',
	'version' => function() {
		$jsLatest = file_get_contents('https://github.com/blueimp/jQuery-File-Upload/tags');

		if ($jsLatest) {
			if (preg_match('/class="tag-name">(\d{1,2}\.\d{1,2}\.\d{1,2})/i', $jsLatest, $matches)) {
				return $matches[1];
			}
		}

		return false;
	}
];
