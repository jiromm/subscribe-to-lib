<?php

require_once(dirname(__DIR__) . '/general/get-connection.php');

const LIB_ERROR_VERSION = 1;

try {
	$st = $conn->prepare('select * from library;');
	$st->execute();
	$libraries = $st->fetchAll(PDO::FETCH_ASSOC);

	$libChanges = [];

	if ($libraries) {
		foreach ($libraries as $library) {
			$alias = $library['alias'];
			$libName = dirname(__DIR__) . "/libs/{$alias}.php";

			if (is_readable($libName)) {
				$libinfo = include(dirname(__DIR__) . "/libs/{$alias}.php");
				$libVersion = $libinfo['version']();

				if ($libVersion !== false) {
					if ($libVersion != $library['version']) {
						// update to latest version
						$st = $conn->prepare('update library set version = ? where id = ?');
						$st->execute([$libVersion, $library['id']]);

						array_push($libChanges, [
							'id' => $library['id'],
							'name' => $library['name'],
							'author' => $library['author'],
							'version' => $libVersion,
						]);
					}
				} else {
					$st = $conn->prepare('update library set error = ? where id = ?');
					$st->execute([LIB_ERROR_VERSION, $library['id']]);
				}
			}
		}

		if ($libChanges) {
			// update subscriber version for that lib
			$stRel = $conn->prepare('update rel_subscriber_library set subscriber_version = ?, notification_date = ? where library_id = ?');

			// write to queue to notify by email
			$stQueue = $conn->prepare('insert into mailing_queue(library_id) values(?)');

			foreach ($libChanges as $libChange) {
				$stRel->execute([$libChange['version'], date('Y-m-d H:i:s'), $libChange['id']]);
				$stQueue->execute([$libChange['id']]);
			}
		}
	}
} catch (Exception $ex) {
	// do nothing
}
