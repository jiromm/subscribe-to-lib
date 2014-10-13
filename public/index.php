<?php

$libraries = include('../general/get-libraries.php');

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
	<div id="intro">
		<div class="intro-text">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="brand">
							<h1><a href="/">Subscribe to Lib</a></h1>
							<div class="line-spacer"></div>
							<p>
								<span>
									Still not using Bower, Grunt or Yeoman? <br>
									So this tool for you!
								</span>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<section>
		<div class="container">
			<div class="row">
				<div class="col-md-offset-3 col-md-6">
					<h1>BE NOTIFIED</h1>

					<input class="form-control input-lg" placeholder="Your Email Address">

					<div class="well-sm">
						<a class="btn btn-primary btn-lg" type="button">Subscribe</a>
					</div>
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
	<script src="js/async-include.js"></script>
	<script src="js/simpleStorage.js"></script>
	<script src="js/custom.js"></script>
</body>
</html>
