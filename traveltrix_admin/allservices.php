<?php 
include 'lib/php/skeleton_index.php';
include 'lib/php/include_admin.php';

$main = new admin();
?>

<?php startblock('h1') ?>
All Services
<?php endblock() ?>

<?php startblock('content') ?>
<div id="allServices">
	<?php $main->render_all_services(); ?>
</div>
<?php endblock() ?>

<?php
$main->close();
?>