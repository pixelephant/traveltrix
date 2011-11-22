<?php
	header("Content-Type: text/html; charset=utf-8");
	session_start();
	$_SESSION['provider_id'] = 1;
//	if(!isset($_SESSION['provider_id'])){
//		header("Location: login.php");
//	}
	
	error_reporting(E_ALL);
	
	require_once 'ti.php';
	
?>


<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Traveltrix Admin</title>
	<link rel="stylesheet" href="lib/css/style.css" />
	<link rel="stylesheet" href="http://twitter.github.com/bootstrap/1.4.0/bootstrap.min.css">
</head>
<body>
	<header>
		<section>
			<div id="logo">
				<img src="img/logo.png" height="90px" alt="Traveltrix logo" />
			</div>
			<div id="breadcrumb">
				<h1><?php startblock('h1') ?><?php endblock() ?></h1>
			</div>
		</section>
	</header>

	<div id="main">
		<nav id="main-nav">
			<ul>
				<li id="dashboard"><a href="/dashboard">Dashboard</a></li>
				<li><a href="/profile">My Profile</a></li>
				<li><a href="/services">My Services</a></li>
				<li><a href="/allservices">All Services</a></li>
				<li><a href="/orders">Orders</a></li>
				<li><a href="/settings">Settings</a></li>
				<li><a href="/invitations">Invitations</a></li>
			</ul>
			<footer id="help">
				<h3>Need help?</h3>
				<p><a href="mailto:support@traveltrix.org">support@traveltrix.org</a></p>
				<p>+36-20-123-4567</p>
				<p id="copy">&copy; <?php echo date("Y") ?></p>
			</footer>
		</nav>
		<div id="content">
			<div id="content-inner">
				<?php startblock('content') ?><?php endblock() ?>
			</div>
		</div>
	</div>
</body>
</html>