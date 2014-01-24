<?php

/*
 *	NAME:					Privilege (INCOMPLETE)
 *
 *	DESCRIPTION:	This class is used to define different privileges that users can have.
 *								It uses the parent class User and requires the Database class inorder 
 *								to connect to a database.
 *
 *	AUTHOR:				Samuel W. Craymer <sam@craymer.com>
 *	EMAIL:				sam@craymer.com
 *	PHONE:				1-613-316-7458
 *	
 *	INCLUDES:			database.php
 *
 *	VERSION:			v1.0
 *	DATE:					October 7, 2011
 *
 *	HISTORY:			October 7, 2011	-	initial version v1.0
 *
 */

//includes
include_once("database.php");

class Privilege {
	//local attributes
	private $privilege_id, $name, $description;
	
	//constructor(s)
	function __construct($privilege_id) {
		
	}
	
	//getter methods
	public function get_privilege_id() {
		return $this->$privilege_id;
	}
	public function get_name() {
		return $this->$name;
	}
	public function get_description() {
		return $this->$description;
	}
	
	//setter methods
	public function set_privilege_id($privilege_id) {
		$this->$privilege_id = $privilege_id;
	}
	public function set_name($name) {
		$this->$name = $name;
	}
	public function set_description($description) {
		$this->$description = $description;
	}
	
	//db methods
	public function dbCreatePrivilege() {
		
	}
	public function dbAddPrivilege() {
	
	}
	public function dbUpdatePrivilege() {
	
	}
	public function dbDeletePrivilege() {
	
	}
	public function dbPopulateClass() {
	
	}
}

?>