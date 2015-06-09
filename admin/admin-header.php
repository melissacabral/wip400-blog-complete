<?php 
session_start();
require('../db-connect.php');

//run the security check - if it fails, send them back to login
check_login_key( '../login.php');
 ?>
<!doctype html>
<html>
<head>
	<title>Admin Panel</title>
	<link rel="stylesheet" type="text/css" href="css/admin-style.css">
</head>
<body>
	<header>
		<h1>Blog Admin Panel</h1>
		<nav>
			<ul>
				<li><a href="index.php">Dashboard</a></li>
				<li><a href="admin-write.php">Write Post</a></li>
				<li><a href="admin-manage.php">Manage Posts</a></li>
				<li><a href="#">Manage Comments</a></li>
				<li><a href="#">Edit Profile</a></li>
				<li><a href="admin-userpic.php">Edit User Pic</a></li>

			</ul>
		</nav>
		<ul class="utilities">
			<li><a href="../login.php?logout=true" class="warn">Log Out!</a></li>
		</ul>
	</header>