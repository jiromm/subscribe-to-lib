<?php

require_once(dirname(__DIR__) . '/general/get-connection.php');
require_once(dirname(__DIR__) . '/general/functions.php');
require_once(dirname(__DIR__) . '/vendor/email.php');

try {
	$st = $conn->prepare('
		select
			subscriber.id as subscriber_id,
			subscriber.email,
			library.id as library_id,
			library.name,
			library.author,
			library.version,
			library.link
		from rel_subscriber_library
		left join library on rel_subscriber_library.library_id = library.id
		left join subscriber on subscriber.id = rel_subscriber_library.subscriber_id
		where library.version <> rel_subscriber_library.subscriber_version and subscriber.subscribed = 1;
	');
	$st->execute();
	$subscribers = $st->fetchAll(PDO::FETCH_ASSOC);
	$listBySubscriber = [];

	if ($subscribers) {
		$stUpdate = $conn->prepare('
			update rel_subscriber_library set subscriber_version = ?
			where subscriber_id = ? and library_id = ?;
		');

		foreach ($subscribers as $subscriber) {
			if (!isset($listBySubscriber[$subscriber['email']])) {
				$listBySubscriber[$subscriber['email']] = [];
			}

			$listBySubscriber[$subscriber['email']][] = [
				'subscriber_id' => $subscriber['subscriber_id'],
				'library_id' => $subscriber['library_id'],
				'name' => $subscriber['name'],
				'author' => $subscriber['author'],
				'version' => $subscriber['version'],
				'link' => $subscriber['link'],
			];
		}

		foreach ($listBySubscriber as $email => $subscriber) {
			$freshVersions = [];
			$libs = '<ul>';

			foreach ($subscriber as $lib) {
				$libs .= "<li><a href='{$lib['link']}'>{$lib['name']} v{$lib['version']}</a></li>";
			}

			$libs .= '</ul>';
			$hash = getHash($email);

			$template = file_get_contents(dirname(__DIR__) . '/template/update.htm');
			$template = str_replace('{{unsubscribe}}', "{$domain}/unsubscribe.php?email={$email}&hash={$hash}", $template);
			$template = str_replace('{{website}}', $domain, $template);
			$template = str_replace('{{libs}}', $libs, $template);

			$mail = new Email($smtpHost, $smtpPort);
			$mail->setProtocol(Email::SSL);
			$mail->setLogin($smtpEmail, $smtpPassword);
			$mail->addTo($tempTo);
			$mail->setFrom($smtpEmail);
			$mail->setSubject('Yoyo Updates');
			$mail->setMessage($template, true);

			if ($mail->send()) {
				foreach ($subscriber as $lib) {
					$stUpdate->execute([$lib['version'], $lib['subscriber_id'], $lib['library_id']]);
				}
			}
		}
	}
} catch (Exception $ex) {
	// do nothing
}
