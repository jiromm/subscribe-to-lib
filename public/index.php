<?php

$libraries = include(dirname(__DIR__) . '/general/get-libraries.php');

?><!doctype html>
<html>
<head>
	<title>Subscribe to Lib</title>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<meta name="author" content="Aram Baghdasaryan">

	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
	<link href="css/style.css" rel="stylesheet" media="screen">
	<link href="css/ns-default.css" rel="stylesheet" media="screen">
	<link href="css/ns-style-other.css" rel="stylesheet" media="screen">
	<script src="js/modernizr.custom.js"></script>
	<script src="js/snap.svg-min.js"></script>
	<script src="js/classie.js"></script>
	<script src="js/notificationFx.js"></script>
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

	<div class="notification-shape shape-box" id="notification-shape" data-path-to="m 0,0 500,0 0,500 -500,0 z">
		<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 500 500" preserveAspectRatio="none">
			<path d="m 0,0 500,0 0,500 0,-500 z">
		</svg>
	</div>

	<section class="headline">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="brand">
						<h1>Subscribe to Lib</h1>
						<p>Not using Bower, Grunt or Yeoman?</p>
						<p>So this tool for you!</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<div class="subscribe-action">
		<section id="already-subscribed">
			<div class="container">
				<div class="row">
					<div class="col-md-offset-3 col-md-6">
						<h1>Already Subscribed</h1>
						<h3><span class="text-muted">With</span> <span class="subscription-email"></span></h3>
						<p>It means you'll be receiving emails every time when new update will be ready. But don't upset because lalala...</p>
					</div>
				</div>
			</div>
		</section>

		<section id="subscribe">
			<div class="container">
				<div class="row">
					<div class="col-md-offset-4 col-md-6">
						<h1>Be Notified</h1>

						<form class="form-inline">
							<div class="form-group has-feedback">
								<input name="email" type="email" class="form-control input-lg email-input" placeholder="Your Email Address">
								<a class="btn btn-primary btn-lg big-subscribe-button" type="button">Subscribe</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</section>
	</div>

	<section class="home-section">
		<div class="container">
			<div class="row">
				<div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
						<?php if (count($libraries)) { ?>
							<?php foreach ($libraries as $library) { ?>
						<p>
							<a href="<?php echo $library['link']; ?>" rel="nofollow" class="text-primary">
								<?php echo $library['name']; ?>
							</a><span class="old-version"></span> v<?php echo $library['version']; ?>
							<span class="text-muted"><?php echo $library['author']; ?></span>
							<a class="btn btn-xs subscribe-button btn-default" data-status="0" data-alias="<?php echo $library['alias']; ?>" data-version="<?php echo $library['version']; ?>"><span>Subscribe</span> <i class="glyphicon glyphicon-ok hide"></i></a>
							<a class="btn btn-xs btn-warning approve-button hide" data-alias="<?php echo $library['alias']; ?>" data-version="<?php echo $library['version']; ?>">Approve!</a>
						</p>
							<?php } ?>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="story">
		<div class="container">
			<div class="row">
				<div class="col-md-offset-2 col-md-8">
					<h2>Story of my life</h2>
					<p>Why this project alive? Shrien Dewani did not look like the victim of a robbery on the night his new wife was killed, according to one of the first policemen to see the Bristol businessman after armed men allegedly hijacked the taxi he was travelling in. His clothes were clean and he did…</p>
				</div>
			</div>
		</div>
	</section>

	<footer>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<p>Copyright &copy; 2014 Aram Baghdasaryan. All rights reserved.</p>
				</div>
			</div>
		</div>
	</footer>

	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/simpleStorage.js"></script>
	<script src="js/custom.js"></script>
</body>
</html>
