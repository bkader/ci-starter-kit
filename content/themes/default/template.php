<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo @$title; ?></title>
	<?php echo @$metadata; ?>

	<!-- StyleSheets -->
	<?php echo css('bootstrap.min', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'); ?>
	<?php echo css('bootstrap-theme.min', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css'); ?>
	<?php echo @$css_files; ?>

	<?php echo js('modernizr.min.js', 'https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js', null, 'common'); ?>
	<!--[if lt IE 9]>
	<?php echo js('html5shiv.min.js', 'https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js', null, 'common'); ?>
	<?php echo js('respond.min.js', 'https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js', null, 'common'); ?>
	<![endif]-->

</head>
<body>
	<?php echo @$layout."\n"; ?>

	<!-- JavaScripts -->
    <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?php echo js_url('jquery-1.12.4.min', 'common'); ?>"><\/script>')</script>
	<?php echo js('bootstrap.min.js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'); ?>
	<?php echo @$js_files."\n"; ?>
	
	<!-- Feel free to remove this line because you don't need it -->
	<script async defer src="https://buttons.github.io/buttons.js"></script>

    <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
    <!-- (remove this line here)
    <script>
        window.ga=function(){ga.q.push(arguments)};ga.q=[];ga.l=+new Date;
        ga('create','UA-XXXXX-Y','auto');ga('send','pageview')
    </script>
    <script src="https://www.google-analytics.com/analytics.js" async defer></script>
    (and this one here)-->
</body>
</html>