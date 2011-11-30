<?php 
session_start();
ob_start();

include 'config.php';
include 'class.db.php';
include 'class.admin.php';
include '../ext/Wixel/gump.class.php';

$main = new admin(true);

if($_POST['action'] == 'login' && ( $_SESSION['token'] == $_POST['token'] ) ){

	$cond['email'] = $_POST['email'];
	$cond['password'] = $_POST['password'];

	$user = $main->get_provider($cond);
	
	if($user['count'] == 1){
		$_SESSION['provider_id'] = $user[0]['id'];
		$_SESSION['is_guide'] = $user[0]['is_guide'];
		header("Location: " . $_siteUrl);
	}else{
		header("Location: " . $_siteUrl);
	}
}

ob_end_flush();

?>
