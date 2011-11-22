<?php 
include 'lib/php/skeleton_index.php';
include 'lib/php/class.db.php';
include 'lib/php/class.admin.php';
include 'lib/ext/Wixel/gump.class.php';

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