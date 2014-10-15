<?php

require_once('../general/config.php');
require_once('../general/get-connection.php');
require_once('../vendor/email.php');

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

echo '<pre>';
print_r($subscribers);
echo '</pre>';

if (count($subscribers)) {
	foreach ($subscribers as $subscriber) {
		$email = $subscriber['email'];
		$libs = str_replace(',', '<br>', $subscriber['libs']);

		$template = file_get_contents('../template/welcome.htm');
		$template = str_replace('{{libs}}', $libs, $template);

		$mail = new Email('smtp.mail.ru', 465);
		$mail->setProtocol(Email::SSL);
		$mail->setLogin($smtpEmail, $smtpPassword);
		$mail->addTo('xquack@gmail.com');
		$mail->setFrom($smtpEmail);
		$mail->setSubject('Yoyo Subscription');
		$mail->setMessage($template, true);

		if ($mail->send()) {
			$st = $conn->prepare('update subscriber set welcome_email_sent = 1 where email = ?;');
			$st->execute([$email]);
		}

		echo '<pre>';
		print_r($mail->getLog());
		echo '</pre>'; break;
	}
}
