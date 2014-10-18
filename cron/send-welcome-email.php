<?php

require_once(dirname(__DIR__) . '/general/get-connection.php');
require_once(dirname(__DIR__) . '/general/functions.php');
require_once(dirname(__DIR__) . '/vendor/email.php');

try {
	$conn->exec('set session group_concat_max_len = 1000000;');

	$st = $conn->prepare('
		select subscriber.email as email, group_concat(library.name) as libs from subscriber
			right join rel_subscriber_library on subscriber.id = rel_subscriber_library.subscriber_id
			left join library on rel_subscriber_library.library_id = library.id
		where subscriber.welcome_email_sent = 0
		group by subscriber.email;
	');
	$st->execute();
	$subscribers = $st->fetchAll(PDO::FETCH_ASSOC);

//	echo '<pre>';
//	print_r($subscribers);
//	echo '</pre>';

	if (count($subscribers)) {
		foreach ($subscribers as $subscriber) {
			$email = $subscriber['email'];
			$libs = str_replace(',', '<br>', $subscriber['libs']);
			$hash = getHash($email);

			$template = file_get_contents(dirname(__DIR__) . '/template/welcome.htm');
			$template = str_replace('{{unsubscribe}}', "{$domain}/unsubscribe.php?email={$email}&hash={$hash}", $template);
			$template = str_replace('{{website}}', $domain, $template);
			$template = str_replace('{{libs}}', $libs, $template);

			$mail = new Email($smtpHost, $smtpPort);
			$mail->setProtocol(Email::SSL);
			$mail->setLogin($smtpEmail, $smtpPassword);
			$mail->addTo($tempTo);
			$mail->setFrom($smtpEmail);
			$mail->setSubject('Yoyo Subscription');
			$mail->setMessage($template, true);

			if ($mail->send()) {
				$st = $conn->prepare('update subscriber set welcome_email_sent = 1 where email = ?;');
				$st->execute([$email]);
			}

			echo '<pre>';
			print_r($mail->getLog());
			echo '</pre>';
		}
	}
} catch (Exception $ex) {
	// do nothing
}
