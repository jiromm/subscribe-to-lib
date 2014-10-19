<?php

require_once(dirname(__DIR__) . '/general/get-connection.php');
require_once(dirname(__DIR__) . '/general/functions.php');

try {
	if (isset($_GET['email']) && $_GET['hash']) {
		$st = $conn->prepare('select * from subscriber where email = ? and hash = ?;');
		$st->execute([$_GET['email'], $_GET['hash']]);
		$subscriberId = $st->fetchColumn();

		$st = $conn->prepare('update subscriber set subscribed = 0 where id = ?;');
		$st->execute([$subscriberId]);

		$result = true;
	} else {
		$result = false;
	}
} catch (Exception $ex) {
	$result = false;
}

?><!doctype html>
<html lang="en">
<head>
	<title>Subscribe to Lib</title>
	<meta charset="utf-8">
	<meta name="description" content="Subscribe to Lib">
	<meta name="author" content="Aram Baghdasaryan">
</head>
<body>
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-55896642-1', 'auto');
		ga('send', 'pageview');
	</script>
<?php
	if ($result) {
		echo 'You are successfully unsubscribed.';
	} else {
		echo 'Something went wrong';
	}
?>
</body>
</html>

