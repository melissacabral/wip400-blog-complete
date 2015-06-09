<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Simple PHP + MySQL Blog</title>
	<link rel="stylesheet" type="text/css" href="<?php echo SITE_URL; ?>/css/normalize.css">
	<link rel="stylesheet" type="text/css" href="<?php echo SITE_URL; ?>/css/style.css">

	<!-- This is important for feed readers/apps to find your feed! -->
	<link rel="alternate" type="application/rss+xml" 
	     href="<?php echo SITE_URL ?>/rss.php" title="Subscribe to Posts"> 
</head>
<body>
	<header>
		<h1><a href="<?php echo SITE_URL; ?>">PHP &amp; MySQL Blog</a></h1>
	</header>