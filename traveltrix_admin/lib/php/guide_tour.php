<?php 

	ob_start();

	session_start();
	
	include 'config.php';
	include 'class.db.php';
	include 'class.admin.php';
	include '../ext/Wixel/gump.class.php';

	$main = new admin(true);

	$action = $_GET['action'];
	$service_id = $_GET['service_id'];
	$guide_id = (int)$_SESSION['provider_id'];
	
	if($action == 'add'){
		
		$act = $main->insert_guide_to_tour($guide_id,$service_id);
		
		if(!$main->isAjax()){
			header("Location: " . $_siteUrl . "index.php");
		}else{
			if($act){
				echo 'success';
			}else{
				echo $act;
			}
		}
	}
	
	if($action == 'drop'){
		
		$act = $main->delete_guide_to_tour($guide_id,$service_id);
		
		if(!$main->isAjax()){
			header("Location: " . $_siteUrl . "index.php");
		}else{
			if($act){
				echo 'success';
			}else{
				echo $act;
			}
		}
	}
	
	ob_end_flush();
?>