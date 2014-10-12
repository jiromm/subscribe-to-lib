<?php

const LIB_ERROR_VERSION = 1;

$conn = new PDO("mysql:dbname=subscribe-to-lib", "root", "");

$st = $conn->prepare('select * from library;');
$st->execute();
$libraries = $st->fetchAll(PDO::FETCH_ASSOC);

$libChanges = [];

if ($libraries) {
	foreach ($libraries as $library) {
		$alias = $library['alias'];
		$libName = "../libs/{$alias}.php";

		if (is_readable($libName)) {
			$libinfo = include("../libs/{$alias}.php");
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

	if ($libChanges) { echo '<pre>' . var_dump($libChanges);
		// write to queue to send email for the new version

		// update subscriber version for that lib
		foreach ($libChanges as $libChange) {
			$st = $conn->prepare('update rel_subscriber_library set subscriber_version = ?, notification_date = ? where library_id = ?');
			$st->execute([$libChange['version'], date('Y-m-d H:i:s'), $libChange['id']]);
		}
	}
}
