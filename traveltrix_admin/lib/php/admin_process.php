<?php 

	ob_start();

	session_start();
	
	include 'config.php';
	include 'class.db.php';
	include 'class.admin.php';
	include 'class.image-resize.php';

	$main = new admin(true);

	print_r($_POST);

	if($_POST['action'] == 'invite_guide'){
		
		$inviteGuideName = $_POST['inviteGuideName'];
		$inviteGuideEmail = $_POST['inviteGuideEmail'];
	
		$password = $main->randomString(10);
		
		$main->invite_guide($inviteGuideName,$inviteGuideEmail,$password);
		
		require '../ext/phpmailer/phpmailer.inc.php';
		
		$mail = new PHPMailer();
		
		//$mail->IsSMTP(); // SMTP használata
		$mail->CharSet = 'UTF-8';
		$mail->From = $_inviteEmailAddress;
		$mail->FromName = $_inviteEmailName;
		
		/*
		$mail->Host = "pixelephant.hu";  // SMTP szerverek címe
		$mail->SMTPAuth = true;
		$mail->Port = 26;
		$mail->Username = "balazs.antal@pixelephant.hu";
		$mail->Password = "pix3l3phant";
		*/
		
		$mail->AddAddress($inviteGuideEmail, $inviteGuideName);
		$mail->AddReplyTo($_inviteEmailAddress, $_inviteEmailName);
		$mail->WordWrap = 50;
		
		$mail->IsHTML(true);    // HTML e-mail
		$mail->Subject = "You have been chosen!";
		$mail->Body = '<h1><a href="' . $_loginLink . '">Check out your new profile!</a></h1>
						<p>Your username: ' . $inviteGuideEmail . '</p>
						<p>Your password: ' . $password . '</p>';
		
		$action = $mail->Send();
		
		print_r($action);
		
		if(!$main->isAjax()){
			header("Location: " . $_siteUrl . "index.php");
		}else{
			if($action){
				echo 'success';
			}else{
				echo $action;
			}
		}
		
	}
	
	if($_POST['action'] == 'edit_guide' || $_POST['ajax_action'] == 'edit_guide'){

		if(isset($_FILES)){
			
			$target_path = '../../' . $_guide_profile_directory . $_SESSION['provider_id'] . '_profile.jpg';
			$thumbnail_path = '../../' . $_guide_profile_thumbnail_directory . $_SESSION['provider_id'] . '_profile.jpg';
			move_uploaded_file($_FILES['photo']['tmp_name'], $target_path);
			$_POST['photo'] = $_SESSION['provider_id'] . '_profile.jpg';
			
			copy($target_path, $thumbnail_path);
			
			$obj = new img_opt(); 
			$obj->max_width(50); 
			$obj->max_height(50); 
			$obj->image_path($thumbnail_path);  
			$obj->image_resize(); 
			
		}
	
		$data = array_filter($_POST);
		unset($data['action']);

		if(isset($data['password'])){
			if($data['password'] != $data['password_retype']){
				echo 'password_mismatch';
				return FALSE;
			}else{
				$cond['password'] = $data['old_password'];
				unset($data['old_password']);
				unset($data['password_retype']);
			}
		
		}
		
		$cond['id'] = $_SESSION['provider_id'];
		
		$action = $main->update_guide($data,$cond);
		
		if(!$main->isAjax()){
			header("Location: " . $_siteUrl . "index.php");
		}else{
			if($action){
				echo 'success';
			}else{
				echo $action;
			}
		}
		
	}
	
	if($_POST['action'] == 'add_tour' || $_POST['ajax_action'] == 'add_tour'){

		$data = array_filter($_POST);
		unset($data['action']);
		
		$data['provider_id'] = $_SESSION['provider_id'];
		
		$action = $main->insert_tour($data);
		
		if(!$main->isAjax()){
			header("Location: " . $_siteUrl . "index.php");
		}else{
			if($action){
				echo 'success';
			}else{
				echo $action;
			}
		}
		
	}
	
	if($_POST['action'] == 'edit_tour' || $_POST['ajax_action'] == 'edit_tour'){
	
		$data = array_filter($_POST);
		unset($data['action']);
		
		$cond['id'] = $data['id'];
		
		$action = $main->update_tour($data,$cond);
		
		if(!$main->isAjax()){
			header("Location: " . $_siteUrl . "index.php");
		}else{
			if($action){
				echo 'success';
			}else{
				echo $action;
			}
		}
		
	}
	
	if($_POST['action'] == 'add_tour_photo'){

		if(isset($_FILES)){
		
			$filename = sha1(microtime()) . '.jpg';
		
			$target_path = '../../' . $_tours_directory . $filename;
			$thumbnail_path = '../../' . $_tours_thumbnail_directory . $filename;
			move_uploaded_file($_FILES['photo']['tmp_name'], $target_path);
			
			copy($target_path, $thumbnail_path);
			
			$obj = new img_opt(); 
			$obj->max_width(50); 
			$obj->max_height(50); 
			$obj->image_path($thumbnail_path);  
			$obj->image_resize(); 
			
		}
		
		$tour_id = $_POST['tour_id'];
		
		$action = $main->insert_tour_photo($tour_id,$filename);
		
		if(!$main->isAjax()){
			header("Location: " . $_siteUrl . "index.php");
		}else{
			if($action){
				echo 'success';
			}else{
				echo $action;
			}
		}
		
	}
	
	if($_POST['action'] == 'delete_tour'){
	
		$tour_id = $_POST['tour_id'];
		$action = $main->delete_tour($tour_id);
		
		if(!$main->isAjax()){
			header("Location: " . $_siteUrl . "index.php");
		}else{
			if($action){
				echo 'success';
			}else{
				echo $action;
			}
		}
		
	}
	
	$main->close();
	ob_end_flush();
?>