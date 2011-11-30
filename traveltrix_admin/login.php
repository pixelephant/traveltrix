<?php
	header("Content-Type: text/html; charset=utf-8");
	error_reporting(E_ALL);
	session_start();
	
	$token = sha1(microtime() . mt_rand());
	$_SESSION['token'] = $token;
?>
<html>
<head>
	<link href="http://twitter.github.com/bootstrap/1.4.0/bootstrap.min.css" rel="stylesheet">
	<link href="lib/css/style.css" rel="stylesheet">
</head>
<body>

<div id="content-inner">
	<div id="login">
		<h1>Bejelentkezés</h1>
		<form action="lib/php/login_process.php" method="POST">
			<input type="hidden" name="token" id="token" value="<?php echo $token;?>" />
			<input type="hidden" name="action" id="action" value="login" />
			<div class="formrow">
				<label for="email">E-mail</label><input type="text" id="email" name="email" /><span style="display:none;" class="error">Hiba!</span>
			</div>
			<div class="formrow">
				<label for="password">Jelszó</label><input type="password" id="password" name="password" /><span style="display:none;" class="error">Hiba!</span>
			</div>
			<div class="formrow">
				<input class="btn primary" type="submit" value="Elküld" />
			</div>
		</form>
	</div>
</div>
</body>
</html>