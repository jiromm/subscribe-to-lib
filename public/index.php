<?php

$libraries = include(dirname(__DIR__) . '/general/get-libraries.php');

?><!doctype html>
<html>
<head>
	<title>Subscribe to Lib (stage)</title>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<meta name="author" content="Aram Baghdasaryan">

	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
	<link href="css/pnotify.custom.min.css" rel="stylesheet" media="screen">
	<link href="css/style.css" rel="stylesheet" media="screen">
	<script src="js/modernizr.custom.js"></script>
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

	<section class="headline">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="brand">
						<h1>Subscribe to Lib</h1>
						<p>Not using Bower, Grunt or Yeoman?</p>
						<p>So this tool is for you!</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<div class="subscribe-action" data-spy="affix">
		<section>
			<div class="container">
				<div class="row">
					<div class="col-xs-2 relative">
						<div class="plane-container">
							<img src="img/plane.png">
						</div>
					</div>
					<div id="already-subscribed" class="col-xs-offset-1 col-xs-6 cols">
						<h1>Already Subscribed</h1>
						<h3><span class="text-muted">With</span> <span class="subscription-email"></span></h3>
						<p>It means you'll be receiving emails every time when new update will be ready. But don't upset because lalala...</p>
					</div>
					<div id="subscribe" class="col-xs-offset-1 col-xs-6 cols">
						<h1>Be Notified</h1>

						<form class="form-inline">
							<div class="form-group has-feedback">
								<input name="email" type="email" class="form-control input-lg email-input" placeholder="Your Email Address">
								<a class="btn btn-primary btn-lg big-subscribe-button" type="button">Subscribe</a>
							</div>
						</form>

						<p>To receive an emails when update will be ready.. Tra lya lya, lya lya lya. So don't hesitate to subscribe</p>
					</div>
				</div>
			</div>
		</section>
	</div>

	<section class="home-section">
		<div class="container">
			<div class="row">
				<div class="col-sm-offset-2 col-sm-8">
					<h2 class="title title-libraries">Libraries <small>(<?php echo count($libraries); ?>)</small></h2>

					<div class="row">
						<div class="col-md-8 col-lg-7">
							<input class="form-control input-lg live-search" placeholder="E.g. PhantomJS">
						</div>
					</div>

					<br>

					<div class="section-heading">
						<?php if (count($libraries)) { ?>
							<?php foreach ($libraries as $k => $library) { ?>
								<?php $libraries[$k]['lower'] = strtolower($library['name']); ?>
						<p class="channel" data-id="<?php echo $library['id']; ?>">
							<a href="<?php echo $library['link']; ?>" rel="nofollow" class="text-primary" target="_blank">
								<?php echo $library['name']; ?>
							</a><span class="old-version"></span> v<?php echo $library['version']; ?>
							<span class="text-muted"><?php echo $library['author']; ?></span>
							<a class="btn btn-xs subscribe-button btn-default pull-right" data-status="0" data-alias="<?php echo $library['alias']; ?>" data-version="<?php echo $library['version']; ?>"><span>Subscribe</span> <i class="glyphicon glyphicon-ok hide"></i></a>
							<a class="btn btn-xs btn-success approve-button hide" data-toggle="tooltip" title="Approve changes" data-alias="<?php echo $library['alias']; ?>" data-version="<?php echo $library['version']; ?>"><i class="glyphicon glyphicon-ok"></i></a>
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
				<div class="col-sm-offset-2 col-sm-8">
					<h2 class="title title-story">Story of my life</h2>
					<p>Why this project alive? Shrien Dewani did not look like the victim of a robbery on the night his new wife was killed, according to one of the first policemen to see the Bristol businessman after armed men allegedly hijacked the taxi he was travelling in. His clothes were clean and he did…</p>
				</div>
			</div>
		</div>
	</section>

	<footer>
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<p>Copyright &copy; 2014 Aram Baghdasaryan. All rights reserved.</p>
				</div>
			</div>
		</div>
	</footer>

	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/simpleStorage.js"></script>
	<script src="js/pnotify.custom.min.js"></script>
	<script src="js/taffy.min.js"></script>
	<script src="js/custom.js"></script>

	<script> var data = JSON.parse('<?php echo json_encode($libraries); ?>'); </script>
</body>
</html>
