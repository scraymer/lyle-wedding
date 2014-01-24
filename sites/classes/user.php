<?php

/*
 *	NAME:					User
 *
 *	DESCRIPTION:	This class is used to create user objects and create, insert, update
 *								and delete entries from a database using the database.php class. It 
 *								uses MD5 hashing for password protection.
 *
 *	AUTHOR:				Samuel W. Craymer <sam@craymer.com>
 *	EMAIL:				sam@craymer.com
 *	PHONE:				1-613-316-7458
 *	
 *	INCLUDES:			database.php
 *	
 *	VERSION:			v1.2
 *	DATE:					June 1, 2012
 *
 *	HISTORY:			October 7, 2011	-	initial version v1.0
 *								April 15, 2012	-	change function names from _________ByName()
 *																	to _________ByUsername()
 *								April 15, 2011 	- added better error handling
 *								April 15, 2012 	-	updated to version v1.1
 *								June 1, 2012		-	added a newsletter field
 *
 */

//includes
require_once("database.php");

class User {
	//local attributes
	private $user_id;
	private $user_name;
	private $email;
	private $hash;
	private $privilege;
	private $name_last;
	private $name_first;
	private $join_date;
	private $signin_date;
	private $newsletter;
	
	//constructor
	function __construct() {
		$this->set_user_id(null);
		$this->set_user_name(null);
		$this->set_email(null);
		$this->set_hash(null);
		$this->set_privilege(null);
		$this->set_name_first(null);
		$this->set_name_last(null);
		$this->set_join_date(null);
		$this->set_signin_date(null);
		$this->set_newsletter(null);
	}
	
	//helper methods
	public function createMin($user_name, $email, $password, $privilege, $newsletter = false, $byPassHash = false) {
		$inst = new self();
		
		$inst->set_user_name($user_name);
		$inst->set_email($email);
		if($byPassHash) {
			$inst->set_hash($password);
		} else {
			$inst->set_password($password);
		}
		$inst->set_privilege($privilege);
		$inst->set_newsletter($newsletter);
		
		return $inst;
	}
	public function createMax($user_name, $email, $password, $privilege, $name_first, $name_last, $newsletter = false) {
		$inst = new self();
		
		$inst->set_user_name($user_name);
		$inst->set_email($email);
		$inst->set_password($password);
		$inst->set_privilege($privilege);
		$inst->set_name_first($name_first);
		$inst->set_name_last($name_last);
		$inst->set_newsletter($newsletter);
		
		return $inst;
	}
	public function selectUserById($user_id) {
		$inst = new self();
		
		$inst->set_user_id($user_id);
		
		if($inst->dbSelectRecordById()) {
			return $inst;
		} else {
			return false;
		}
	}
	public function selectUserByUsername($user_name) {
		$inst = new self();
		
		$inst->set_user_name($user_name);
		
		if($inst->dbSelectRecordByUsername()) {
			return $inst;
		} else {
			return false;
		}
	}
	public function selectUserByEmail($email) {
		$inst = new self();
		
		$inst->set_email($email);
		
		if($inst->dbSelectRecordByEmail()) {
			return $inst;
		} else {
			return false;
		}
	}
	public function selectUserByNewsletter($newsletter) {
		$objects = null;
		
		$inst = new self();
		$inst->set_newsletter($newsletter);
		$result = $inst->dbSelectRecordsByNewsletter();
		
		for($i=0; $i<mysql_num_rows($result); $i++) {
			$record = mysql_fetch_array($result);
			$user = new User();
			$user->populateFields($record);
			$objects[] = $user;
		}
		
		return $objects;
	}
	public function deleteUserById($user_id) {
		$inst = new self();
		
		$inst->set_user_id($user_id);
		
		if($inst->dbSelectRecordById()) {
			$inst->dbDeleteRecord();
			return $inst;
		} else {
			return false;
		}
	}
	public function deleteUserByUsername($user_name) {
		$inst = new self();
		
		$inst->set_user_name($user_name);
		
		if($inst->dbSelectRecordByUsername()) {
			$inst->dbDeleteRecord();
			return $inst;
		} else {
			return false;
		}
	}
	public function deleteUserByEmail($email) {
		$inst = new self();
		
		$inst->set_email($email);
		
		if($inst->dbSelectRecordByEmail()) {
			$inst->dbDeleteRecord();
			return $inst;
		} else {
			return false;
		}
	}
	
	//getter methods
	public function get_user_id() {
		return $this->user_id;
	}
	public function get_user_name() {
		return $this->user_name;
	}
	public function get_email() {
		return $this->email;
	}
	public function get_hash() {
		return $this->hash;
	}
	public function get_privilege() {
		return $this->privilege;
	}
	public function get_name_first() {
		return $this->name_first;
	}
	public function get_name_last() {
		return $this->name_last;
	}
	public function get_join_date() {
		return $this->join_date;
	}
	public function get_signin_date() {
		return $this->signin_date;
	}
	public function get_newsletter() {
		return $this->newsletter;
	}
	
	//setter methods
	public function set_user_id($user_id) {
		$this->user_id = $user_id;
	}
	public function set_user_name($user_name) {
		$this->user_name = $user_name;
	}
	public function set_email($email) {
		$this->email = $email;
	}
	public function set_hash($hash) {
		$this->hash = $hash;
	}
	public function set_password($password) {
		$this->hash = $this->md5_gen($password);
	}
	public function set_privilege($privilege) {
		$this->privilege = $privilege;
	}
	public function set_name_first($name_first) {
		$this->name_first = $name_first;
	}
	public function set_name_last($name_last) {
		$this->name_last = $name_last;
	}
	public function set_join_date($join_date) {
		$this->join_date = $join_date;
	}
	public function set_signin_date($signin_date) {
		$this->signin_date = $signin_date;
	}
	public function set_newsletter($newsletter) {
		$this->newsletter = $newsletter;
	}
	
	//general methods
	private function populateFields($result) {
		$this->set_user_id($result['user_id']);
		$this->set_user_name($result['user_name']);
		$this->set_hash($result['hash']);
		$this->set_privilege($result['privilege']);
		$this->set_email($result['email']);
		$this->set_name_last($result['name_last']);
		$this->set_name_first($result['name_first']);
		$this->set_join_date($result['join_date']);
		$this->set_signin_date($result['signin_date']);
		$this->set_newsletter((bool) $result['newsletter']);
	}
	
	//password hash methods
	private function md5_gen($password) {
		$chars = str_split('~`!@#$%^&*()[]{}-_\/|\'";:,.+=<>?');
		$keys = array_rand($chars, 6);
		
		foreach($keys as $key) {
			$hash['salt'][] = $chars[$key];
		}
		
		$hash['salt'] = implode('', $hash['salt']);
		$hash['salt'] = md5($hash['salt']);
		$hash['code'] = md5($hash['salt'].$password.$hash['salt']);
		
		$hash = "" . $hash['salt'] . "" . $hash['code'];
		
		return $hash;
	}
	private function md5_hash($password, $salt) {
		$hash['salt'] = $salt;
		$hash['code'] = md5($hash['salt'].$password.$hash['salt']);
		
		return $hash;
	}
	public function challenge_hash($password) {
		$answer['salt'] = substr($this->get_hash(), 0, 32);
		$answer['code'] = substr($this->get_hash(), 32, 64);
		
		$challenge = $this->md5_hash($password, $answer['salt']);
		
		if($challenge['code'] == $answer['code']) {
			return true;
		} else {
			return false;
		}
	}
	
	//db methods
	public function dbCreateTable() {
		$db = new Database();
		$db->createTable("CREATE TABLE IF NOT EXISTS `users` (`user_id` INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY, `user_name` VARCHAR(320) NOT NULL, `hash` VARCHAR(64) NOT NULL, `privilege` INT(3) NOT NULL, `email` VARCHAR(320) NOT NULL, `name_last` VARCHAR(50) NULL, `name_first` VARCHAR(50) NULL, `join_date` DATE NULL, `signin_date` DATETIME NULL, `newsletter` TINYINT NOT NULL DEFAULT 0, UNIQUE (`user_name`, `email`)) ENGINE = InnoDB;");
		$db = null;
	}
	public function dbInsertRecord() {
		$db = new Database();
		$db->insertStatement("INSERT INTO `users` (user_name, hash, privilege, email, name_last, name_first, join_date, signin_date, newsletter) VALUES ('" . $this->get_user_name() . "', '" . $this->get_hash() . "', '" . $this->get_privilege() . "', '" . $this->get_email() . "', '" . $this->get_name_last() . "', '" . $this->get_name_first() . "', '" . $this->get_join_date() . "', '" . $this->get_signin_date() . "', '" . (int) $this->get_newsletter() . "');");
		$db = null;
		
		$this->dbSelectRecordByUsername();
	}
	public function dbUpdateRecord() {
		$db = new Database();
		$db->updateStatement("UPDATE `users` SET `user_id`='" . $this->get_user_id() . "', `user_name`='" . $this->get_user_name() . "', `hash`='" . $this->get_hash() . "', `privilege`='" . $this->get_privilege() . "', `email`='" . $this->get_email() . "', `name_last`='" . $this->get_name_last() . "', `name_first`='" . $this->get_name_first() . "', `join_date`='" . $this->get_join_date() . "', `signin_date`='" . $this->get_signin_date() . "', `newsletter`='" . (int) $this->get_newsletter() . "' WHERE `user_id`='" . $this->get_user_id() . "';");
		$db = null;
		
		$this->dbSelectRecordById();
	}
	public function dbDeleteRecord() {
		$db = new Database();
		$db->deleteStatement("DELETE FROM `users` WHERE user_id='" . $this->get_user_id() . "';");
		$db = null;
	}
	private function dbSelectRecordById() {
		$db = new Database();
		$result = $db->selectStatement("SELECT * FROM `users` WHERE user_id='" . $this->get_user_id() . "';");
		$db = null;
		
		if(mysql_num_rows($result) == 1) {
			$this->populateFields(mysql_fetch_array($result));
			return true;
		} else {
			return false;
		}
	}
	private function dbSelectRecordByUsername() {
		$db = new Database();
		$result = $db->selectStatement("SELECT * FROM `users` WHERE user_name='" . $this->get_user_name() . "';");
		$db = null;
		
		if(mysql_num_rows($result) == 1) {
			$this->populateFields(mysql_fetch_array($result));
			return true;
		} else {
			return false;
		}
	}
	private function dbSelectRecordByEmail() {
		$db = new Database();
		$result = $db->selectStatement("SELECT * FROM `users` WHERE email='" . $this->get_email() . "';");
		$db = null;
		
		if(mysql_num_rows($result) == 1) {
			$this->populateFields(mysql_fetch_array($result));
			return true;
		} else {
			return false;
		}
	}
	private function dbSelectRecordsByNewsletter() {
		$db = new Database();
		$result = $db->selectStatement("
			SELECT * FROM `users` 
			WHERE newsletter=" . (int) $this->get_newsletter() . ";");
		$db = null;
		
		return $result;
	}
}

?>