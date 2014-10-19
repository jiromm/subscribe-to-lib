<?php

$libraries = include(dirname(__DIR__) . '/general/get-libraries.php');

?><html>
<head>
	<title>Subscribe to Lib</title>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="css/style.css" rel="stylesheet" media="screen">
	<link href="color/default.css" rel="stylesheet" media="screen">
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
	<div id="intro">
		<div class="intro-text">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="brand">
							<h1><a href="/">Subscribe to Lib</a></h1>
							<div class="line-spacer"></div>
							<p><span>Not using Bower, Grunt or Yeoman?</span></p>
							<p><span>So this tool for you!</span></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<section id="already-subscribed">
		<div class="container">
			<div class="row">
				<div class="col-md-offset-3 col-md-6">
					<h1>Already Subscribed</h1>
					<h3>
						<span class="text-muted">With</span> <span class="subscription-email"></span>
					</h3>
				</div>
			</div>
		</div>
	</section>

	<section id="subscribe">
		<div class="container">
			<div class="row">
				<div class="col-md-offset-3 col-md-6">
					<h1>Be Notified</h1>

					<form class="form-horizontal">
						<div class="form-group has-feedback">
							<input name="email" type="email" class="form-control input-lg email-input" placeholder="Your Email Address">
							<span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
						</div>
					</form>

					<a class="btn btn-primary btn-lg big-subscribe-button" type="button">Subscribe</a>
				</div>
			</div>
		</div>
	</section>

	<section class="home-section bg-white">
		<div class="container">
			<div class="row">
				<div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
						<h2>Libs</h2>
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
