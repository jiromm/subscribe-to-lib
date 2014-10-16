<?php

//require_once('../general/get-connection.php');
//require_once('../general/functions.php');
//require_once('../vendor/email.php');
require_once('/var/www/notify.jiromm.com/general/get-connection.php');
require_once('/var/www/notify.jiromm.com/general/functions.php');
require_once('/var/www/notify.jiromm.com/vendor/email.php');

try {
	$st = $conn->prepare('
		select * from mailing_queue
		left join library on mailing_queue.library_id = library.id
		right join rel_subscriber_library on library.id = rel_subscriber_library.library_id
		left join subscriber on subscriber.id = rel_subscriber_library.subscriber_id
		where subscriber.subscribed = 1;
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
			$libs = '<ul>';

			foreach ($subscriber as $lib) {
				$libs .= "<li><a href='{$lib['link']}'>{$lib['name']} v{$lib['version']}</a></li>";
			}

			$libs .= '</ul>';
			$hash = getHash($email);

//			$template = file_get_contents('../template/update.htm');
			$template = file_get_contents('/var/www/notify.jiromm.com/template/update.htm');
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
				// do nothing
			}
		}
	}
} catch (Exception $ex) {
	// do nothing
}
