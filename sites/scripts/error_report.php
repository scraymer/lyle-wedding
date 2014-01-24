<?php

function error_report($code) {
	return code_desc_prod($code);
}

function error_report_dev($code, $severity) {
	if(code_severity($code) <= $severity) {
		return "ERROR " . $code . ": " . code_desc($code) ." [" . code_loc($code) ."]";
	} else {
		return null;
	}
}

function code_desc($code) {
	switch ($code) {
		case 100:
			$desc = "POST variable 'user' could not be found";
			break;
		case 101:
			$desc = "POST variable 'password' could not be found";
			break;
		case 110:
			$desc = "username does not exist";
			break;
		case 111:
			$desc = "password does not match up with username";
			break;
		case 120:
			$desc = "could not find client IP address during login";
			break;
		case 200:
			$desc = "could not find client IP address during authenticating";
			break;
		case 210:
			$desc = "SESSION variable 'user' could not be found";
			break;
		case 211:
			$desc = "SESSION variable 'privilege' could not be found";
			break;
		case 212:
			$desc = "SESSION variable 'ip' could not be found";
			break;
		case 213:
			$desc = "SESSION variable 'last_activity' could not be found";
			break;
		case 214:
			$desc = "SESSION exceeds maximum timeout limit";
			break;
		case 215:
			$desc = "SESSION IP does not match current user";
			break;
		case 300:
			$desc = "POST variable 'to' could not be found";
			break;
		case 301:
			$desc = "POST variable 'subject' could not be found";
			break;
		case 302:
			$desc = "POST variable 'body' could not be found";
			break;
		case 310:
			$desc = "error when trying to send email, refer to PHPMailer 'Send' function";
			break;
		case 400:
			$desc = "POST variable 'username' could not be found";
			break;
		case 401:
			$desc = "POST variable 'subject' could not be found";
			break;
		case 402:
			$desc = "POST variable 'message' could not be found";
			break;
		case 403:
			$desc = "POST variable 'captcha_code' could not be found";
			break;
		case 404:
			$desc = "POST variable 'collection' could not be found";
			break;
		case 405:
			$desc = "POST variable 'submit' could not be found";
			break;
		case 410:
			$desc = "captcha security challenge failed";
			break;
		default:
			$desc = null;
	}
	
	return $desc;
}

function code_desc_prod($code) {
	switch ($code) {
		case 100:
			$desc = "An error has occurred during login. Please contact administration.";
			break;
		case 101:
			$desc = "An error has occurred during login. Please contact administration.";
			break;
		case 110:
			$desc = "Username or password is incorrect.";
			break;
		case 111:
			$desc = "Username or password is incorrect.";
			break;
		case 120:
			$desc = "Cannot obtain your IP address for authentication.";
			break;
		case 200:
			$desc = "Cannot obtain your IP address for authentication.";
			break;
		case 210:
			$desc = "Site administration has been restricted to the bride, groom and site developer(s) only.";
			break;
		case 211:
			$desc = "Site administration has been restricted to the bride, groom and site developer(s) only.";
			break;
		case 212:
			$desc = "Site administration has been restricted to the bride, groom and site developer(s) only.";
			break;
		case 213:
			$desc = "Site administration has been restricted to the bride, groom and site developer(s) only.";
			break;
		case 214:
			$desc = "Your session has exceeded the maximum timeout limit. You have been logged out.";
			break;
		case 215:
			$desc = "Your IP address change! Both IPs have been blocked for security and will be reviewed by the site administrator.";
			break;
		case 300:
			$desc = "An error has occurred and the message could not be sent. Please contact administration.";
			break;
		case 301:
			$desc = "An error has occurred and the message could not be sent. Please contact administration.";
			break;
		case 302:
			$desc = "An error has occurred and the message could not be sent. Please contact administration.";
			break;
		case 310:
			$desc = "An error has occurred and the message could not be sent. Please contact administration.";
			break;
		case 400:
			$desc = "An error has occurred and the message could not be sent. Please contact administration.";
			break;
		case 401:
			$desc = "An error has occurred and the message could not be sent. Please contact administration.";
			break;
		case 402:
			$desc = "An error has occurred and the message could not be sent. Please contact administration.";
			break;
		case 403:
			$desc = "An error has occurred and the message could not be sent. Please contact administration.";
			break;
		case 404:
			$desc = "An error has occurred and the message could not be sent. Please contact administration.";
			break;
		case 405:
			$desc = "An error has occurred and the message could not be sent. Please contact administration.";
			break;
		case 410:
			$desc = "Failed security verification. Please try again.";
			break;
		default:
			$desc = null;
	}
	
	return $desc;
}

function code_loc($code) {
	switch ($code) {
		case 100:
			$loc = "sites/scripts/authenticate.php";
			break;
		case 101:
			$loc = "sites/scripts/authenticate.php";
			break;
		case 110:
			$loc = "sites/scripts/authenticate.php";
			break;
		case 111:
			$loc = "sites/scripts/authenticate.php";
			break;
		case 120:
			$loc = "sites/scripts/authenticate.php";
			break;
		case 200:
			$loc = "sites/scripts/authenticate.php";
			break;
		case 210:
			$loc = "sites/scripts/authenticate.php";
			break;
		case 211:
			$loc = "sites/scripts/authenticate.php";
			break;
		case 212:
			$loc = "sites/scripts/authenticate.php";
			break;
		case 213:
			$loc = "sites/scripts/authenticate.php";
			break;
		case 214:
			$loc = "sites/scripts/authenticate.php";
			break;
		case 215:
			$loc = "sites/scripts/authenticate.php";
			break;
		case 300:
			$loc = "sites/scripts/send_email.php";
			break;
		case 301:
			$loc = "sites/scripts/send_email.php";
			break;
		case 302:
			$loc = "sites/scripts/send_email.php";
			break;
		case 310:
			$loc = "sites/scripts/send_email.php";
			break;
		case 400:
			$loc = "sites/scripts/submit_comment.php";
			break;
		case 401:
			$loc = "sites/scripts/submit_comment.php";
			break;
		case 402:
			$loc = "sites/scripts/submit_comment.php";
			break;
		case 403:
			$loc = "sites/scripts/submit_comment.php";
			break;
		case 404:
			$loc = "sites/scripts/submit_comment.php";
			break;
		case 405:
			$loc = "sites/scripts/submit_comment.php";
			break;
		case 410:
			$loc = "sites/scripts/submit_comment.php";
			break;
		default:
			$loc = null;
	}
	
	return $loc;
}

function code_severity($code) {
	// 1 - reported to client, logged on server and IP blocked
	// 2 - reported to client and logged on server
	// 3 - logged on server only
	// 4 - reported to client only
	// 5 - not reported
	
	switch ($code) {
		case 100:
			$level = 2;
			break;
		case 101:
			$level = 2;
			break;
		case 110:
			$level = 4;
			break;
		case 111:
			$level = 4;
			break;
		case 120:
			$level = 4;
			break;
		case 200:
			$level = 4;
			break;
		case 210:
			$level = 5;
			break;
		case 211:
			$level = 5;
			break;
		case 212:
			$level = 5;
			break;
		case 213:
			$level = 5;
			break;
		case 214:
			$level = 3;
			break;
		case 215:
			$level = 1;
			break;
		case 300:
			$level = 2;
			break;
		case 301:
			$level = 2;
			break;
		case 302:
			$level = 2;
			break;
		case 310:
			$level = 2;
			break;
		case 400:
			$level = 2;
			break;
		case 401:
			$level = 2;
			break;
		case 402:
			$level = 2;
			break;
		case 403:
			$level = 2;
			break;
		case 404:
			$level = 2;
			break;
		case 405:
			$level = 2;
			break;
		case 410:
			$level = 4;
			break;
		default:
			$level = null;
	}
	
	return $level;
}

?>