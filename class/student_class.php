<?php

include_once("meta_model.php");

class Student extends metaModel {
	public function __construct() {
		parent::__construct();
	}

	public function getStudentByEmail($Email, $type)
	{
		if ($type == 1) {
			$q = "SELECT * FROM entrepreneur where email = '".$this->fix_for_mysqli($Email)."'";
		} else {
			$q = "SELECT * FROM investor where email = '".$this->fix_for_mysqli($Email)."'";
		}
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result;
		} else {
			return array();
		}
	}

	public function getStudentById($Id, $type)
	{
		if ($type == 1) {
			$q = "SELECT * FROM entrepreneur where id = '".$this->fix_for_mysqli($Id)."'";
		} else {
			$q = "SELECT * FROM investor where id = '".$this->fix_for_mysqli($Id)."'";
		}
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result;
		} else {
			return array();
		}
	}

	public function getStudentByEmailAndPassword($Email, $Password, $type)
	{
		if ($type == 1) {
			$q = "SELECT * FROM entrepreneur where email = '".$this->fix_for_mysqli($Email)."' and password = '".$this->fix_for_mysqli($Password)."'";
		} else {
			$q = "SELECT * FROM investor where email = '".$this->fix_for_mysqli($Email)."' and password = '".$this->fix_for_mysqli($Password)."'";
		}
		
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result;
		} else {
			return array();
		}
	}

	public function checkOldPassword($id, $old_password)
	{
		$q = "SELECT * FROM Student where id = ".$this->fix_for_mysqli($id)." and password = '".$this->fix_for_mysqli($old_password)."'";
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result;
		} else {
			return array();
		}
	}

	public function insertStudent($name, $email, $password, $type)
	{
		$case = "insert";
		if ($type == 1) {
			$q = "Insert into entrepreneur set firstName = '".$this->fix_for_mysqli($name)."', email = '".$this->fix_for_mysqli($email)."', password = '".$this->fix_for_mysqli($password)."'";
		} else {
			$q = "Insert into investor set firstName = '".$this->fix_for_mysqli($name)."', email = '".$this->fix_for_mysqli($email)."', password = '".$this->fix_for_mysqli($password)."'";
		}
		$this->setQuery($q);
		if($this->runQuery($case)) {
			$Id = $this->getLastInsertId();
			if($Id > 0) {
				return $Id;
			} else {
				return 0;
			}
		}
	}

	public function updateStudent($name, $email, $password, $type, $contact_no, $image, $gender, $fb_link, $gplus_link, $email_status, $status, $id)
	{
		$q = "";
		$case = "update";
		if(!empty($name)) $q.= "name = '".$this->fix_for_mysqli($name)."', ";
		if(!empty($email)) $q.= "email = '".$this->fix_for_mysqli($email)."', ";
		if(!empty($password)) $q.= "password = '".$this->fix_for_mysqli($password)."', ";
		if(!empty($type)) $q.= "type = '".$this->fix_for_mysqli($type)."', ";
		if(!empty($contact_no)) $q.= "name = '".$this->fix_for_mysqli($contact_no)."', ";
		if(!empty($image)) $q.= "image = '".$this->fix_for_mysqli($image)."', ";
		if(!empty($gender)) $q.= "gender = '".$this->fix_for_mysqli($gender)."', ";
		if(!empty($fb_link)) $q.= "fb_link = '".$this->fix_for_mysqli($fb_link)."', ";
		if(!empty($gplus_link)) $q.= "gplus_link = '".$this->fix_for_mysqli($gplus_link)."', ";
		if(!empty($email_status)) $q.= "email_status = '".$this->fix_for_mysqli($email_status)."', ";
		if(!empty($status)) $q.= "status = '".$this->fix_for_mysqli($status)."', ";

		$query = "update Student set ".$q." modified_on = '".date('Y-m-d H:i:s')."' where id = ".$this->fix_for_mysqli($id);
		$this->setQuery($query);
		if($this->runQuery($case)) {
			return true;
		} else {
			return false;
		}
	}

	public function updateStudentPassword($password, $id)
	{
		$case = "update";
		$q = "update Student set password = '".$this->fix_for_mysqli($password)."', modified_on = '".date('Y-m-d H:i:s')."' where id = ".$this->fix_for_mysqli($id);
		$this->setQuery($q);
		if($this->runQuery($case)) {
			return true;
		} else {
			return false;
		}
	}

	public function updateUserPassword($id, $password)
	{
		$case = "update";
		$q = "update Student set password = ".$this->fix_for_mysqli($password).", modified_on = '".date('Y-m-d H:i:s')."' where id = ".$this->fix_for_mysqli($id);
		$this->setQuery($q);
		if($this->runQuery($case)) {
			return true;
		} else {
			return false;
		}
	}
}
?>