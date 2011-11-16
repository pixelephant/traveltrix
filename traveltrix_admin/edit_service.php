<?php 
header("Content-Type: text/html; charset=utf-8");
session_start();

error_reporting(E_ALL);

include 'lib/php/config.php';
include 'lib/php/class.db.php';
include 'lib/php/class.admin.php';
include 'lib/ext/Wixel/gump.class.php';

$main = new admin();

$service_id = (int)$_GET['service_id'];
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="lib/css/style.css" />
</head>
<body>
<div id="editService">
	<p>Túra szerkesztése</p>
	<?php $main->render_edit_service_form($service_id); ?>
	<?php $main->render_service_photo_form($service_id); ?>
</div>
</body>
</html>

<?php 
$main->close();
?>