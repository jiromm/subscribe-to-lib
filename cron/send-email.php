<?php

const LIB_ERROR_VERSION = 1;

$conn = new PDO("mysql:dbname=subscribe-to-lib", "root", "");

$st = $conn->prepare('
	select * from mailing_queue
	left join library on mailing_queue.library_id = library.id
	right join rel_subscriber_library on library.id = rel_subscriber_library.library_id
	left join subscriber on subscriber.id = rel_subscriber_library.subscriber_id;
');
$st->execute();
$subscribers = $st->fetchAll(PDO::FETCH_ASSOC);
$listBySubscriber = [];

if ($subscribers) {
	foreach ($subscribers as $subscriber) {
		if (!isset($listBySubscriber[$subscriber['email']])) {
			$listBySubscriber[$subscriber['email']] = [];
		}

		$listBySubscriber[$subscriber['email']][] = [
			'name' => $subscriber['name'],
			'author' => $subscriber['author'],
			'version' => $subscriber['version'],
			'link' => $subscriber['link'],
		];
	}

	foreach ($listBySubscriber as $email => $subscriber) {
		echo "<p>{$email}</p>";
		echo '<ul>';

		foreach ($subscriber as $libs) {
			echo "<li><a href='{$libs['link']}'>{$libs['name']} v{$libs['version']} {$libs['author']}</a></li>";
		}

		echo '</ul>';
	}
}
