<?php
	header("Content-Type: text/html; charset=utf-8");
	error_reporting(E_ALL);
?>
<html>
<head>

</head>
<body>

<div id="login">
	<p>Bejelentkezés</p>
	<form action="lib/php/login_process.php" method="POST">
		<input type="hidden" name="action" id="action" value="login" />
		<div class="row">
			<label for="email">E-mail</label><input type="text" id="email" name="email" /><span style="display:none;" class="error">Hiba!</span>
		</div>
		<div class="row">
			<label for="password">Jelszó</label><input type="password" id="password" name="password" /><span style="display:none;" class="error">Hiba!</span>
		</div>
		<div class="row">
			<input type="submit" value="Elküld" />
		</div>
	</form>
</div>
</body>
</html>