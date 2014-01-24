<?php

/*
 *	NAME:					Database
 *
 *	DESCRIPTION:	This class is used to create and maintain a connection to a MySQL
 *								database using either the local attributes or received parameters.
 *								Moreover, the main purpose is to use the built in functions to send
 *								SQL statements to the connected MySQL database.
 *
 *	AUTHOR:				Samuel W. Craymer <sam@craymer.com>
 *	EMAIL:				sam@craymer.com
 *	PHONE:				1-613-316-7458
 *	
 *	VERSION:			v1.1
 *	DATE:					May 15, 2012
 *
 *	HISTORY:			October 7, 2011	-	initial version - v1.0
 *								May 15, 2012		- added timezone feature
 *								v1.1						- added MySQL date creator
 *
 */

//timezone
date_default_timezone_set('America/Toronto');

class Database {
	//public attributes
	public $db = null;
	
	//local attributes
	private $host = "localhost";
	private $user = "lyle";
	private $password = "abDFNXR932hWXsyJ";
	private $name = "lyle";
	
	//constructor
	function __construct() {
		$this->set_db($this->dbConnect());
		$this->dbSelect();
	}
	
	//destructor
	function __destruct() {
		$this->dbDisconnect();
	}
	
	//getter methods
	public function get_db() {
		return $this->db;
	}
	public function get_host() {
		return $this->host;
	}
	public function get_user() {
		return $this->user;
	}
	public function get_password() {
		return $this->password;
	}
	public function get_name() {
		return $this->name;
	}
	
	//setter methods
	public function set_db($db) {
		$this->db = $db;
	}
	public function set_host($host) {
		$this->host = $host;
	}
	public function set_user($user) {
		$this->user = $user;
	}
	public function set_password($password) {
		$this->password = $password;
	}
	public function set_name($name) {
		$this->name = $name;
	}
	
	//connection methods
	public function dbConnect() {
		$tmp = mysql_connect($this->get_host(), $this->get_user(), $this->get_password()) or die('Unable to connect to SQL Server: ' . mysql_error());
		return $tmp;
	}
	public function dbSelect() {
		mysql_select_db($this->get_name()) or die('Unable to connect to the database ' . $this->get_name() . ': ' . mysql_error());
	}
	public function dbDisconnect() {
		mysql_close() or die('Error closing database connection: ' . mysql_errno());
	}
	
	//statement methods
	public function createDatabase($sql) {
		mysql_query($sql) or die('Error creating database: ' . mysql_error());
	}
	public function createTable($sql) {
		mysql_query($sql) or die('Error creating table: ' . mysql_error());
	}
	public function insertStatement($sql) {
		mysql_query($sql) or die('Error inserting record(s): ' . mysql_error());
	}
	public function updateStatement($sql) {
		mysql_query($sql) or die('Error updating record(s): ' . mysql_error());
	}
	public function deleteStatement($sql) {
		mysql_query($sql) or die('Error deleting record(s): ' . mysql_error());
	}
	public function selectStatement($sql) {
		$tmp = mysql_query($sql) or die('Error selecting record(s): ' . mysql_error());
		return $tmp;
	}
	
	//general methods
	public function createMySQLDate($date, $string = null) {
		if($string) {
			$date = strtotime($date);
		}
		return date('Y-m-d H:i:s', $date);
	}
}

?>