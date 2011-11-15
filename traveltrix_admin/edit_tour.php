<?php 
header("Content-Type: text/html; charset=utf-8");
session_start();

error_reporting(E_ALL);

include 'lib/php/config.php';
include 'lib/php/class.db.php';
include 'lib/php/class.admin.php';

$main = new admin();

$tour_id = $_GET['tour_id'];
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="lib/css/style.css" />
</head>
<body>
<div id="editTour">
	<p>Túra szerkesztése</p>
	<?php $main->render_edit_tour_form($tour_id); ?>
	<?php $main->render_tour_photo_form($tour_id); ?>
</div>
</body>
</html>

<?php 
$main->close();
?>