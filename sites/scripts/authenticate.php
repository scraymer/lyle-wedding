<?php

function authenticate() {
	//clear all variables
	$authenticate = null;
	$err = null;
	$ip = null;
	
	//get client IP address
	if (getenv("HTTP_CLIENT_IP")) {
		$ip = getenv("HTTP_CLIENT_IP");
	} elseif(getenv("HTTP_X_FORWARDED_FOR")) {
		$ip = getenv("HTTP_X_FORWARDED_FOR");
	} elseif(getenv("REMOTE_ADDR")) {
		$ip = getenv("REMOTE_ADDR");
	} else {
		$err = 200;
	}
	
	//start session and regenerate id
	session_start();
	session_regenerate_id();
	
	//check for necessary session variables
	if(!isset($_SESSION['user'])) {
		$err = 210;
	} elseif(!isset($_SESSION['privilege'])) {
		$err = 211;
	} elseif(!isset($_SESSION['ip'])) {
		$err = 212;
	} elseif(!isset($_SESSION['last_activity'])) {
		$err = 213;
	} elseif(time() - $_SESSION['last_activity'] > 1800) {
		$err = 214;
	} elseif(!isset($ip) || ($ip != $_SESSION['ip'])) {
		$err = 215;
	}
	 
	if(!$err) {
		$_SESSION['last_activity'] = time();
		$authenticate = array($_SESSION['user'], $_SESSION['privilege'], null);
		return $authenticate;
	} else {
		logout();
		$authenticate = array(null, null, $err);
		return $authenticate;
	}
}

function login() {
	//clear all variables
	$challenge = null;
	$authenticate = null;
	$err = null;
	$ip = null;
	$password = null;
	$user = null;
	$username = null;
	$privilege = null;
	
	//clear any current session
	logout();
	
	//check POST variables needed for verification
	if(isset($_POST['username'])) {
		$username = $_POST['username'];
	} else {
		$err = 100;
	}
	if(isset($_POST['password'])) {
		$password = $_POST['password'];
	} else {
		$err = 101;
	}
	
	//if error, return err code and exit
	if($err) {
		$authenticate = array(null, null, $err);
		return $authenticate;
		exit;
	}
	
	//include user classes needed for verification
	require_once('sites/classes/user.php'); 
	
	//select user based on provided username
	//and challenge with provided password
	$user = User::selectUserByUsername($username);
	if($user == 0) {
		$err = 110;
	} else {
		$challenge = $user->challenge_hash($password);
		if(!$challenge) {
			$err = 111;
		}
	}
	
	if (getenv("HTTP_CLIENT_IP")) {
		$ip = getenv("HTTP_CLIENT_IP");
	} else if(getenv("HTTP_X_FORWARDED_FOR")) {
		$ip = getenv("HTTP_X_FORWARDED_FOR");
	} else if(getenv("REMOTE_ADDR")) {
		$ip = getenv("REMOTE_ADDR");
	} else {
		$err = 120;
	}
	
	//if error, return err code and exit
	if($err) {
		$authenticate = array(null, null, $err);
		return $authenticate;
		exit;
	}
	
	//start a new session
	session_start();
	session_regenerate_id(true);
	
	//set SESSION variables
	$_SESSION['user'] = $user->get_user_id();
	$_SESSION['privilege'] = $user->get_privilege();
	$_SESSION['ip'] = $ip;
	$_SESSION['last_activity'] = time();
	
	$authenticate = array($user->get_user_id(), $user->get_privilege(), null);
	return $authenticate;
}

function logout() {
	session_start();
	session_unset();
	session_destroy();
	session_write_close();
	setcookie(session_name(),'',0,'/');
	session_regenerate_id(true);
	return true;
}

function set_auth_var() {
	//set global variables
	global $logout;
	global $login;
	global $auth;
	
	//clear global variables
	$logout = null;
	$login = null;
	$auth = null;
	
	//set global variables
	if(isset($_GET['logout'])) {
		$logout = logout();
	} elseif(isset($_POST['logout'])) {
		$logout = logout();
	} elseif(isset($_POST['login'])) {
		$login = login();
		$auth = authenticate();
	} else {
		$auth = authenticate();
	}
	
	//refresh page to removal all GET variables
	if($logout) {
		header('Location: administration.php');
		exit;
	}
}

set_auth_var();

?>