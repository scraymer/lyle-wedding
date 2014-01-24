<?php

//open session
session_start();
session_regenerate_id();

//include required once
require_once '../classes/securimage/securimage.php';
require_once '../classes/comment.php';
include_once 'send_email.php';

function exitReturn($err) {
	$string = null;
	
	if($err && $err == 410) {
		//formate message variable in order to transport through url
		//and then insert into textarea
		$message = str_replace(" ", '+', $_POST['message']);
		$message = str_replace("\n", '%0D%0A', $message);
		$message = trim(preg_replace('/\s+/', '', $message));
		
		$string = "err=" . $err . "&username=" . $_POST['username'] . "&subject=" . $_POST['subject'] . "&message=" . $message;
	} elseif($err) {
		$string = "err=" . $err;
	} else {
		$string = "done=true";
	}
	
	if(isset($_GET['get'])) {
		$string .= "&" . $_GET['get'] . "=true";
	}
	
	if(isset($_GET['src']) && isset($_GET['loc'])) {
		header("Location: ../../" . $_GET['src'] . ".php?" . $string . "#" . $_GET['loc']);
	} elseif(isset($_GET['src'])) {
		header("Location: ../../" . $_GET['src'] . ".php?" . $string);
	} else {
		header("Location: ../../home.php?" . $string);
	}
	
	exit;
}

function validateVariables() {
	//clear required variables
	$err = null;
	
	//check all post variables
	if(!isset($_POST['username'])) {
		$err = 400;
	} elseif(!isset($_POST['subject'])) {
		$err = 401;
	} elseif(!isset($_POST['message'])) {
		$err = 402;
	} elseif(!isset($_POST['captcha_code'])) {
		$err = 403;
	} elseif(!isset($_POST['collection'])) {
		$err = 404;
	} elseif(!isset($_POST['submit'])) {
		$err = 405;
	}
	
	//check captcha response
	$securimage = new Securimage();
	if ($securimage->check($_POST['captcha_code']) == false) {
		// the code was incorrect
		$err = 410;
	}
	
	//if any errors, exit and return to page
	if($err) {
		exitReturn($err);
	} else {
		return true;
	}
}

function cleanVariables() {
	//set variable values
	$username = $_POST['username'];
	$subject = $_POST['subject'];
	$message = strip_tags($_POST['message']);
	$collection = $_POST['collection'];
	
	//remove consecutive line breaks and change to <br> tags so when we remove 
	//consecutive whitespace in the next step, the line breaks remain intact. 
	//Moreover, whitespace at the beginning and end are removed with trim()
	//$message = preg_replace('/(\r\n)+/', '<br><br>', trim($message));
	$message = preg_replace('/(\r\n)+/', '<br/><br/>', trim($message));
	
	//remove consecutive whitespace (not including line breaks <br> tags)
	$username = preg_replace('/\s+/', ' ', $username);
	$subject = preg_replace('/\s+/', ' ', $subject);
	$message = preg_replace('/\s+/', ' ', $message);
	$collection = preg_replace('/\s+/', ' ', $collection);
	
	//change line break <br> tag back into \n breaks for the database
	//$message = preg_replace('/<br/><br/>/i', "\r\n", $message);
	
	//gather all variables into an array
	$variable = array("username"=>$username, "subject"=>$subject, "message"=>$message, 
		"collection"=>$collection);
	
	//return array with all cleaned variables
	return $variable;
}

function saveComment($variable) {
	$comment = Comment::addComment($variable['message'], $variable['collection'], 
		$variable['subject'], $variable['username']);
	return $comment;
}

function emailAdmins($comment) {
	$id = $comment->get_id();
	$date = $comment->get_date(true);
	$username = $comment->get_username();
	if($username == "") { $username = 'Anonymous'; }
	$subject = $comment->get_subject();
	$message = $comment->get_message();
	$collection = $comment->get_collection();
	
	ob_start();
	include '../blocks/blog-admin-email-alt.php';
	$altBody = ob_get_contents();
	ob_end_clean();
	
	ob_start();
	include '../blocks/blog-admin-email-html.php';
	$htmlBody = ob_get_contents();
	ob_end_clean();
	
	//$_POST['to'] = 'sam@craymer.com; lisa@craymer.com; kylewatters@live.ca';
	$_POST['to'] = 'sam@craymer.com';
	$_POST['subject'] = 'New Post Awaiting Approval';
	$_POST['altBody'] = $altBody;
	$_POST['body'] = $htmlBody;
	
	sendMessage();
}

if(validateVariables()) {
	$comment = saveComment(cleanVariables());
	emailAdmins($comment);
}

exitReturn(null);

?>
