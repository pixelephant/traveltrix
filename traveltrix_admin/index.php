<?php
	header("Content-Type: text/html; charset=utf-8");
	session_start();
	
	if(!isset($_SESSION['guide_id'])){
		header("Location: login.php");
	}
	
	error_reporting(E_ALL);
	
	include 'lib/php/class.db.php';
	include 'lib/php/class.admin.php';	
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
			<li id="invite_guide">
				<a href="#">Invite!</a>
			</li>
			<li id="edit_guide">
				<a href="#">Edit profile</a>
			</li>
			<li id="insert_tour">
				<a href="#">Add tour</a>
			</li>
			<li id="my_tours">
				<a href="#">My tours</a>
			</li>
			<li id="all_tours">
				<a href="#">All tour</a>
			</li>
			<li id="logout">
				<a href="logout.php">Logout</a>
			</li>
		</ul>
	</nav>
</header>
<hr />
<div id="inviteGuide">
	<p>Guide meghívás</p>
	<form action="lib/php/admin_process.php" method="POST">
		<input type="hidden" name="action" id="action" value="invite_guide" />
		<div class="row">
			<label for="inviteGuideName">Név</label><input type="text" id="inviteGuideName" name="inviteGuideName"/><span style="display:none;" class="error">Hiba!</span>
		</div>
		<div class="row">
			<label for="inviteGuideEmail">Email</label><input type="text" id="inviteGuideEmail" name="inviteGuideEmail"/><span style="display:none;" class="error">Hiba!</span>
		</div>
		<div class="row">
			<input type="submit" value="Elküld" />
		</div>
	</form>
</div>
<hr />
<div id="editGuide">
	<p>Adataim</p>
	<form enctype="multipart/form-data" action="lib/php/admin_process.php" method="POST">
		<?php $main->render_edit_guide_form(); ?>
		<div class="row">
			<input type="submit" value="Elküld" />
		</div>
	</form>
</div>
<hr />
<div id="insertTour">
	<p>Túra hozzáadása</p>
	<form action="lib/php/admin_process.php" method="POST">
		<input type="hidden" name="action" id="action" value="add_tour" />
		<div class="row">
			<label for="tourname">Név</label><input type="text" id="tourname" name="tourname"/><span style="display:none;" class="error">Hiba!</span>
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
			<input type="submit" value="Elküld" />
		</div>
	</form>
</div>
<hr />
<div id="myTours">
	<p>Túráim</p>
	<?php $main->render_my_tours(); ?>
</div>
<hr />
<div id="allTours">
	<p>Összes túra</p>
	<?php $main->render_all_tours(); ?>
</div>
</body>
</html>
<?php 
	$main->close();
?>