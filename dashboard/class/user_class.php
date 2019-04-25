<?php

include_once("meta_model.php");

class User extends metaModel {
	public function __construct() {
		parent::__construct();
	}

	public function getUserByEmail($email)
	{
		$q = "SELECT * FROM User where email = '".$this->fix_for_mysqli($email)."'";
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
		$q = "SELECT * FROM User where id = ".$this->fix_for_mysqli($id)." and password = '".$this->fix_for_mysqli($old_password)."'";
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result;
		} else {
			return array();
		}
	}

	public function updateUserPassword($id, $password)
	{
		$case = "update";
		$q = "update User set password = '".$this->fix_for_mysqli($password)."', modified_on = '".date('Y-m-d H:i:s')."' where id = ".$this->fix_for_mysqli($id);
		$this->setQuery($q);
		if($this->runQuery($case)) {
			return true;
		} else {
			return false;
		}
	}

}
?>