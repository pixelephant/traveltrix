<?php 
include 'lib/php/skeleton_index.php';
include 'lib/php/include_admin.php';

$main = new admin();

$service_id = (int)$_GET['service_id'];
?>

<?php startblock('h1') ?>
Edit service
<?php endblock() ?>

<?php startblock('content') ?>
<div id="editService">
	<h2>Edit service</h2>
	<?php $main->render_edit_service_form($service_id); ?>
	<?php $main->render_service_photo_form($service_id); ?>
</div>
<?php endblock() ?>

<?php
$main->close();
?>