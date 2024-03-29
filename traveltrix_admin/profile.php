<?php 
include 'lib/php/skeleton_index.php';
include 'lib/php/include_admin.php';

$main = new admin();
?>

<?php startblock('h1') ?>
My Profile
<?php endblock() ?>

<?php startblock('content') ?>
<div id="editProvider">
	<form enctype="multipart/form-data" action="lib/php/admin_process.php" method="POST">
		<?php $main->render_edit_provider_form(); ?>
		<div class="formrow">
			<input type="submit" class="btn primary" value="Submit" />
		</div>
	</form>
</div>
<?php endblock() ?>

<?php
$main->close();
?>