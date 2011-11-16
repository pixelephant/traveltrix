<?php
	header("Content-Type: text/html; charset=utf-8");
	session_start();
	
	if(!isset($_SESSION['provider_id'])){
		header("Location: login.php");
	}
	
	error_reporting(E_ALL);
	
	include 'lib/php/class.db.php';
	include 'lib/php/class.admin.php';
	include 'lib/ext/Wixel/gump.class.php';		
	$main = new admin();
	
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="lib/css/style.css" />
</head>
<body>
<header>
	<nav>
		<ul>
			<li id="invite_provider">
				<a href="#">Invite!</a>
			</li>
			<li id="edit_provider">
				<a href="#">Edit profile</a>
			</li>
			<li id="insert_service">
				<a href="#">Add service</a>
			</li>
			<li id="my_services">
				<a href="#">My services</a>
			</li>
			<li id="all_services">
				<a href="#">All services</a>
			</li>
			<li id="logout">
				<a href="logout.php">Logout</a>
			</li>
		</ul>
	</nav>
</header>
<hr />
<div id="inviteProvider">
	<p>Szolgáltató meghívás</p>
	<form action="lib/php/admin_process.php" method="POST">
		<input type="hidden" name="action" id="action" value="invite_provider" />
		<div class="row">
			<label for="inviteProviderName">Név</label><input type="text" id="inviteProviderName" name="inviteProviderName"/><span style="display:none;" class="error">Hiba!</span>
		</div>
		<div class="row">
			<label for="inviteProviderEmail">Email</label><input type="text" id="inviteProviderEmail" name="inviteProviderEmail"/><span style="display:none;" class="error">Hiba!</span>
		</div>
		<div class="row">
			<label for="inviteProviderType">Típus</label><select id="inviteProviderType" name="inviteProviderType"><option value="1">Guide</option><option value="0">Egyéb szolgáltató</option></select>
		</div>
		<div class="row">
			<input type="submit" value="Elküld" />
		</div>
	</form>
</div>
<hr />
<div id="editProvider">
	<p>Adataim</p>
	<form enctype="multipart/form-data" action="lib/php/admin_process.php" method="POST">
		<?php $main->render_edit_provider_form(); ?>
		<div class="row">
			<input type="submit" value="Elküld" />
		</div>
	</form>
</div>
<hr />
<div id="insertService">
	<p>Szolgáltatás hozzáadása</p>
	<form action="lib/php/admin_process.php" method="POST">
		<input type="hidden" name="action" id="action" value="add_service" />
		<div class="row">
			<label for="service_name">Név</label><input type="text" id="service_name" name="service_name"/><span style="display:none;" class="error">Hiba!</span>
		</div>
		<div class="row">
			<label for="short_description">Rövid leírás</label><textarea id="short_description" name="short_description"></textarea><span style="display:none;" class="error">Hiba!</span>
		</div>
		<div class="row">
			<label for="long_description">Hosszú leírás</label><textarea id="long_description" name="long_description"></textarea><span style="display:none;" class="error">Hiba!</span>
		</div>
		<div class="row">
			<label for="category_id">Kategória</label><select id="category_id" name="category_id"><?php $main->render_categories_option(); ?></select>
		</div>
		<div class="row">
			<label for="duration">Hossza</label><select id="duration" name="duration"><?php $main->render_duration_option(); ?></select>
		</div>
		<div class="row">
			<label for="price">Ár</label><input type="text" id="price" name="price"/> / fő<span style="display:none;" class="error">Hiba!</span>
		</div>
		<div class="row">
			<input type="submit" value="Elküld" />
		</div>
	</form>
</div>
<hr />
<div id="myServices">
	<p>Szolgáltatásaim</p>
	<?php $main->render_my_services(); ?>
</div>
<hr />
<div id="allServices">
	<p>Összes szolgáltatás</p>
	<?php $main->render_all_services(); ?>
</div>
</body>
</html>
<?php 
	$main->close();
?>