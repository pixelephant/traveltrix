<?php
 
	/*
	 * E-mail küldése sikertelen bankkártyás fizetés tényéről
	 */

	require_once("phpmailer/phpmailer.inc.php");
	include "config.php";
	
	$name = $_POST['name'];
	$mail = $_POST['email'];
	
	$message = $_POST['message'];
	
	$mail = new PHPMailer();
	
	//$mail->IsSMTP(); // SMTP használata
	$mail->CharSet = 'UTF-8';
	$mail->From = $mail;
	$mail->FromName = $name;
	//$mail->Host = "smtp1.site.com;smtp2.site.com";  // SMTP szerverek címe
	$mail->AddAddress($tt_to_mail,$tt_to_name);
	//$mail->AddReplyTo($mail, $name);
	$mail->WordWrap = 50;
	
	$mail->IsHTML(true);    // HTML e-mail
	$mail->Subject = "Message from the website!";
	$mail->Body = $message;
	
	if($mail->Send() === FALSE){
		echo 'sikertelen';
	}else{
		echo 'sikeres';
	}	
?>