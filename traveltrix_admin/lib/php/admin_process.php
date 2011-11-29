<?php 

	ob_start();

	session_start();
	
	include 'config.php';
	include 'class.db.php';
	include 'class.admin.php';
	include 'class.image-resize.php';
	include '../ext/Wixel/gump.class.php';

	$main = new admin(true);

	print_r($_POST);

	if($_POST['action'] == 'invite_provider'){
		
		$inviteProviderName = $_POST['inviteProviderName'];
		$inviteProviderEmail = $_POST['inviteProviderEmail'];
		$inviteProviderType = $_POST['inviteProviderType'];
	
		
		$password = $main->randomString(10);
		
		if(!$main->invite_provider($inviteProviderName,$inviteProviderEmail,$password,$inviteProviderType)){
			echo 'Sikertelen';
			return FALSE;
		}
		
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
		
		$mail->AddAddress($inviteProviderEmail, $inviteProviderName);
		$mail->AddReplyTo($_inviteEmailAddress, $_inviteEmailName);
		$mail->WordWrap = 50;
		
		$mail->IsHTML(true);    // HTML e-mail
		$mail->Subject = "You have been chosen!";
		$mail->Body = '<h1><a href="' . $_loginLink . '">Check out your new profile!</a></h1>
						<p>Your username: ' . $inviteProviderEmail . '</p>
						<p>Your password: ' . $password . '</p>';
		
		$action = $mail->Send();
		
		if(!$main->isAjax()){
			header("Location: " . $_siteUrl);
		}else{
			if($action){
				echo 'success';
			}else{
				echo $action;
			}
		}
		
	}
	
	if($_POST['action'] == 'edit_provider' || $_POST['ajax_action'] == 'edit_provider'){

		if(isset($_FILES)){
			
			$target_path = '../../' . $_provider_profile_directory . $_SESSION['provider_id'] . '_profile.jpg';
			$thumbnail_path = '../../' . $_provider_profile_thumbnail_directory . $_SESSION['provider_id'] . '_profile.jpg';
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
		
		$action = $main->update_provider($data,$cond);
		
		if(!$main->isAjax()){
			header("Location: " . $_siteUrl);
		}else{
			if($action){
				echo 'success';
			}else{
				echo $action;
			}
		}
		
	}
	
	if($_POST['action'] == 'add_service' || $_POST['ajax_action'] == 'add_service'){

		$data = array_filter($_POST);
		unset($data['action']);
		
		$data['provider_id'] = (int)$_SESSION['provider_id'];
		$data['is_tour'] = (int)$_SESSION['is_guide'];
		
		$action = $main->insert_service($data);
		
		if(!$main->isAjax()){
			header("Location: " . $_siteUrl);
		}else{
			if($action){
				echo 'success';
			}else{
				echo $action;
			}
		}
		
	}
	
	if($_POST['action'] == 'edit_service' || $_POST['ajax_action'] == 'edit_service'){
	
		$data = array_filter($_POST);
		unset($data['action']);
		
		$cond['id'] = $data['id'];
		
		$action = $main->update_service($data,$cond);
		
		if(!$main->isAjax()){
			header("Location: " . $_siteUrl);
		}else{
			if($action){
				echo 'success';
			}else{
				echo $action;
			}
		}
		
	}
	
	if($_POST['action'] == 'add_service_photo'){

		if(isset($_FILES)){
		
			$filename = sha1(microtime()) . '.jpg';
		
			$target_path = '../../' . $_services_directory . $filename;
			$thumbnail_path = '../../' . $_services_thumbnail_directory . $filename;
			move_uploaded_file($_FILES['photo']['tmp_name'], $target_path);
			
			copy($target_path, $thumbnail_path);
			
			$obj = new img_opt(); 
			$obj->max_width(50); 
			$obj->max_height(50); 
			$obj->image_path($thumbnail_path);  
			$obj->image_resize(); 
			
		}
		
		$service_id = $_POST['service_id'];
		
		$action = $main->insert_service_photo($service_id,$filename);
		
		if(!$main->isAjax()){
			header("Location: " . $_siteUrl);
		}else{
			if($action){
				echo 'success';
			}else{
				echo $action;
			}
		}
		
	}
	
	if($_POST['action'] == 'delete_service'){
	
		$service_id = $_POST['service_id'];
		$action = $main->delete_service($service_id);
		
		if(!$main->isAjax()){
			header("Location: " . $_siteUrl);
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