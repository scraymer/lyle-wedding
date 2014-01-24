<?php

/*
 *	NAME:					Comment
 *
 *	DESCRIPTION:	This class is used to create comment objects. It can than be 
 *								used to add, modify, retrieve and delete comments using the 
 *								database.php object.
 *
 *	AUTHOR:				Samuel W. Craymer <sam@craymer.com>
 *	EMAIL:				sam@craymer.com
 *	PHONE:				1-613-316-7458
 *	
 *	INCLUDES:			database.php
 *	
 *	VERSION:			v1.1
 *	DATE:					June 1, 2012
 *
 *	HISTORY:			May 15, 2012		-	initial version v1.0
 *								June 1, 2012		-	added functionality for newsletter status
 *																-	added a public function to update fields to database
 *								
 *
 */

//includes
require_once("database.php");

class Comment {
	//local attributes
	private $id;
	private $username;
	private $subject;
	private $message;
	private $date;
	private $collection;
	private $status;
	private $newsletter;
	
	//constructor
	function __construct() {
		$this->set_id(null);
		$this->set_username(null);
		$this->set_subject(null);
		$this->set_message(null);
		$this->set_date(null);
		$this->set_collection(null);
		$this->set_status(null);
		$this->set_newsletter(null);
	}
	
	//helper methods
	public function addComment($message, $collection = null, $subject = null, $username = null) {
		$inst = new self();
		
		$inst->set_message($message);
		$inst->set_collection($collection);
		$inst->set_subject($subject);
		$inst->set_username($username);
		$inst->set_date(time());
		$inst->set_status('waiting');
		$inst->set_newsletter(false);
		
		$inst->dbCreateTable();
		$record = $inst->dbInsertRecord();
		
		$inst->set_id($record);
		$result = $inst->dbSelectRecordById();
		$record = mysql_fetch_array($result);
		$inst->populateFields($record);
		
		return $inst;
	}
	public function selectCommentById($id) {
		$object = null;
		
		$inst = new self();
		$inst->set_id($id);
		$result = $inst->dbSelectRecordById();
		
		if(mysql_num_rows($result) == 1) {
			$record = mysql_fetch_array($result);
			$comment = new Comment();
			$comment->populateFields($record);
			$object = $comment;
		}
		
		return $object;
	}
	public function selectCommentsByCollection($collection, $order = 'id', $dir = 'DESC') {
		$objects = null;
		
		$inst = new self();
		$inst->set_collection($collection);
		$result = $inst->dbSelectRecordsByCollection($order, $dir);
		
		for($i=0; $i<mysql_num_rows($result); $i++) {
			$record = mysql_fetch_array($result);
			$comment = new Comment();
			$comment->populateFields($record);
			$objects[] = $comment;
		}
		
		return $objects;
	}
	public function deleteCommentById($id) {
		$inst = new self();
		
		$inst->set_id($id);
		$inst->dbSelectRecordById();
		$inst->dbDeleteRecord();
		
		return $inst;
	}
	public function updateCommentStatus($id, $status) {
		$inst = new self();
		
		$inst->set_id($id);
		$result = $inst->dbSelectRecordById();
		$record = mysql_fetch_array($result);
		$inst->populateFields($record);
		
		$inst->set_status($status);
		$inst->dbUpdateRecord();
		
		return $inst;
	}
	
	//getter methods
	public function get_id() {
		return $this->id;
	}
	public function get_username() {
		return $this->username;
	}
	public function get_subject() {
		return $this->subject;
	}
	public function get_message() {
		return $this->message;
	}
	public function get_date($string = null) {
		if($string) {
			return date( 'd-m-Y h:i a', $this->date);
		} else {
			return $this->date;
		}
	}
	public function get_collection() {
		return $this->collection;
	}
	public function get_status() {
		return $this->status;
	}
	public function get_newsletter() {
		return $this->newsletter;
	}
	
	//setter methods
	public function set_id($id) {
		$this->id = $id;
	}
	public function set_username($username) {
		$this->username = $username;
	}
	public function set_subject($subject) {
		$this->subject = $subject;
	}
	public function set_message($message) {
		$this->message = $message;
	}
	public function set_date($date, $string = null) {
		if($string) {
			$date = strtotime($date);
		}
		$this->date = $date;
	}
	public function set_collection($collection) {
		$this->collection = $collection;
	}
	public function set_status($status) {
		$this->status = $status;
	}
	public function set_newsletter($newsletter) {
		$this->newsletter = $newsletter;
	}
	
	//public general methods
	public function updateRecord() {
		$this->dbUpdateRecord();
	}
	
	//private general methods
	private function populateFields($record) {
		$this->set_id($record['id']);
		$this->set_username(stripslashes($record['username']));
		$this->set_subject(stripslashes($record['subject']));
		$this->set_message(stripslashes($record['message']));
		$this->set_date($record['date'], true);
		$this->set_collection($record['collection']);
		$this->set_status($record['status']);
		$this->set_newsletter((bool) $record['newsletter']);
	}
	
	//db methods
	private function dbCreateTable() {
		$db = new Database();
		$db->createTable("
			CREATE TABLE IF NOT EXISTS `comments` (
			`id` INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
			`username` VARCHAR(30) NULL, 
			`subject` VARCHAR(65) NULL, 
			`message` VARCHAR(1000) NOT NULL, 
			`date` DATETIME NOT NULL, 
			`collection` VARCHAR(30) NULL, 
			`status` VARCHAR(15) NOT NULL, 
			`newsletter` TINYINT NOT NULL DEFAULT 0, 
			UNIQUE (`id`)) 
			ENGINE = InnoDB;");
		$db = null;
	}
	private function dbInsertRecord() {
		$db = new Database();
		$db->insertStatement("
			INSERT INTO `comments` 
			(username, subject, message, date, collection, status, newsletter) 
			VALUES ('" . 
			addslashes($this->get_username()) . "', '" . 
			addslashes($this->get_subject()) . "', '" . 
			addslashes($this->get_message()) . "', '" . 
			$db->createMySQLDate($this->get_date()) . "', '" . 
			$this->get_collection() . "', '" . 
			$this->get_status() . "', '" . 
			(int) $this->get_newsletter() . "');");
		$id = mysql_insert_id();
		$db = null;
		
		return $id;
	}
	private function dbUpdateRecord() {
		$db = new Database();
		$db->updateStatement("
			UPDATE `comments` 
			SET `id`='" . $this->get_id() . "', 
			`username`='" . addslashes($this->get_username()) . "', 
			`subject`='" . addslashes($this->get_subject()) . "', 
			`message`='" . addslashes($this->get_message()) . "', 
			`date`='" . $db->createMySQLDate($this->get_date()) . "', 
			`collection`='" . $this->get_collection() . "', 
			`status`='" . $this->get_status() . "', 
			`newsletter`='" . (int) $this->get_newsletter() . "' 
			WHERE `id`='" . $this->get_id() . "';");
		$db = null;
		
		$this->dbSelectRecordById();
	}
	private function dbDeleteRecord() {
		$db = new Database();
		$db->deleteStatement("
			DELETE FROM `comments` 
			WHERE id='" . $this->get_id() . "';");
		$db = null;
	}
	private function dbSelectRecordById() {
		$db = new Database();
		$result = $db->selectStatement("
			SELECT * FROM `comments` 
			WHERE id='" . $this->get_id() . "';");
		$db = null;
		
		return $result;
	}
	private function dbSelectRecordsByCollection($order = 'id', $dir = 'DESC') {
		$db = new Database();
		$result = $db->selectStatement("
			SELECT * FROM `comments` 
			WHERE collection='" . $this->get_collection() . "' 
			ORDER BY " . $order . " " . $dir . ";");
		$db = null;
		
		return $result;
	}
}

?>