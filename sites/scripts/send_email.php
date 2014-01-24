<?php

function sendMessage() {
	//set defaults for all used variables
	$to = null;
	$cc = null;
	$bcc = null;
	$subject = null;
	$body = null;
	$length = null;
	$array = null;
	$err = null;
	
	//check if all POST variables exist and set
	if(isset($_POST['to'])) {
		$to = $_POST['to'];
	} else {
		$err = 300;
	}
	if(isset($_POST['cc'])) {
		$cc = $_POST['cc'];
	}
	if(isset($_POST['bcc'])) {
		$bcc = $_POST['bcc'];
	}
	if(isset($_POST['subject'])) {
		$subject = $_POST['subject'];
	} else {
		$err = 301;
	}
	if(isset($_POST['body'])) {
		$body = $_POST['body'];
	} else {
		$err = 302;
	}
	if(isset($_POST['altBody'])) {
		$altBody = $_POST['altBody'];
	}
	
	//if there is an error return value
	if($err) {
		return array(null, null, $err);
	}
	
	
	//include necessary classes
	include_once("sites/classes/PHPMailer_5.2.1/class.phpmailer.php");
	include_once("../classes/PHPMailer_5.2.1/class.phpmailer.php");
	
	//create new mail message
	$mail = new PHPMailer();
	
	
	//create to array from substrings of to separated by a semicolon
	if($to) {
		$end = 0;
		$start = 0;
		$length = strlen($to);
		$arrayTo = array();
		
		while($end < $length) {
			if(substr($to, $end, 1) == ";") {
				$arrayTo[] = substr($to, $start, ($end-$start));
				$start = $end + 1;
			}
			$end++;
		}
		
		if(substr($to, -1) != ";") {
			$arrayTo[] = substr($to, $start);
		}
		
		//set email message to address(es)
		for($i = 0; $i < count($arrayTo); $i++) {
			$mail->AddAddress($arrayTo[$i]);
		}
	}
	
	//create cc array from substrings of to separated by a semicolon
	if($cc) {
		$end = 0;
		$start = 0;
		$length = strlen($cc);
		$arrayCC = array();
		
		while($end < $length) {
			if(substr($cc, $end, 1) == ";") {
				$arrayCC[] = substr($cc, $start, ($end-$start));
				$start = $end + 1;
			}
			$end++;
		}
		
		if(substr($cc, -1) != ";") {
			$arrayCC[] = substr($cc, $start);
		}
		
		//set email message to address(es)
		for($i = 0; $i < count($arrayCC); $i++) {
			$mail->AddCC($arrayCC[$i]);
		}
	}
	
	//create bcc array from substrings of to separated by a semicolon
	if($bcc) {
		$end = 0;
		$start = 0;
		$length = strlen($bcc);
		$arrayBCC = array();
		
		while($end < $length) {
			if(substr($bcc, $end, 1) == ";") {
				$arrayBCC[] = substr($bcc, $start, ($end-$start));
				$start = $end + 1;
			}
			$end++;
		}
		
		if(substr($bcc, -1) != ";") {
			$arrayBCC[] = substr($bcc, $start);
		}
		
		//set email message to address(es)
		for($i = 0; $i < count($arrayBCC); $i++) {
			$mail->AddBCC($arrayBCC[$i]);
		}
	}
	
	
	//set email message subject and body
	$mail->Subject = $subject;
	$mail->Body = $body;
	
	
	//send email message
	if(!$mail->Send()) {
		$err = 310;
		return array(null, null, $err);
	} elseif($arrayTo) {
		return array($arrayTo, $subject, null);
	} else {
		return array(null, $subject, null);
	}
	return null;
}


if(isset($_POST['email'])) {
	$email = sendMessage();
}

?>