<?php

return [
	'name' => 'DataTables',
	'vendor' => 'SpryMedia Ltd',
	'version' => function() {
		$jsLatest = file_get_contents('http://www.datatables.net/download/index');

		if ($jsLatest) {
			$jsLatest = str_replace("\n", '', $jsLatest);

			if (preg_match('/Download DataTables <br> v(\d{1,2}\.\d{1,2}\.\d{1,2})/i', $jsLatest, $matches)) {
				return $matches[1];
			}
		}

		return false;
	}
];
