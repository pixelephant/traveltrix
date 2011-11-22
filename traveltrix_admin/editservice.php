<?php 
include 'lib/php/skeleton_index.php';
include 'lib/php/class.db.php';
include 'lib/php/class.admin.php';
include 'lib/ext/Wixel/gump.class.php';

$main = new admin();

$service_id = (int)$_GET['service_id'];
?>

<?php startblock('h1') ?>
My Profile
<?php endblock() ?>

<?php startblock('content') ?>
<div id="editService">
	<p>Túra szerkesztése</p>
	<?php $main->render_edit_service_form($service_id); ?>
	<?php $main->render_service_photo_form($service_id); ?>
</div>
<?php endblock() ?>

<?php
$main->close();
?>