<?php 
include 'lib/php/skeleton_index.php';
include 'lib/php/class.db.php';
include 'lib/php/class.admin.php';

$main = new admin();
?>

<?php startblock('h1') ?>
My Services
<?php endblock() ?>

<?php startblock('content') ?>
<div id="insertService">
	<h2>Szolgáltatás hozzáadása</h2>
	<form action="lib/php/admin_process.php" method="POST">
		<input type="hidden" name="action" id="action" value="add_service" />
		<div class="formrow">
			<label for="service_name">Név</label><input type="text" id="service_name" name="service_name"/><span style="display:none;" class="error">Hiba!</span>
		</div>
		<div class="formrow">
			<label for="short_description">Rövid leírás</label><textarea id="short_description" name="short_description"></textarea><span style="display:none;" class="error">Hiba!</span>
		</div>
		<div class="formrow">
			<label for="long_description">Hosszú leírás</label><textarea id="long_description" name="long_description"></textarea><span style="display:none;" class="error">Hiba!</span>
		</div>
		<div class="formrow">
			<label for="category_id">Kategória</label><select id="category_id" name="category_id"><?php $main->render_categories_option(); ?></select>
		</div>
		<div class="formrow">
			<label for="duration">Hossza</label><select id="duration" name="duration"><?php $main->render_duration_option(); ?></select>
		</div>
		<div class="formrow">
			<label for="price">Ár</label><input type="text" id="price" name="price"/> / fő<span style="display:none;" class="error">Hiba!</span>
		</div>
		<div class="formrow">
			<input type="submit" value="Elküld" />
		</div>
	</form>
</div>
<div id="myServices">
	<?php $main->render_my_services(); ?>
</div>
<?php endblock() ?>

<?php
$main->close();
?>