<?php

include_once("meta_model.php");

class Forget_Password extends metaModel {
	public function __construct() {
		parent::__construct();
	}

	public function getForgetPasswordById($id)
	{
		$q = "SELECT * FROM Forget_Password where status = 0 and id = '".$this->fix_for_mysqli($id)."'";
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result;
		} else {
			return array();
		}
	}

	public function insertForgetPassword($student_id, $type, $status)
	{
		$case = "insert";
		$time = date('Y-m-d H:i:s');
		$q = "Insert into Forget_Password set student_id = '".$this->fix_for_mysqli($student_id)."', type = '".$this->fix_for_mysqli($type)."', status = '".$this->fix_for_mysqli($status)."', created_on = '".$time."'";
		$this->setQuery($q);
		if($this->runQuery($case)) {
			$Id = $this->getLastInsertId();
			if($Id > 0) {
				return array('id' => $Id, 'time' => $time);
			} else {
				return 0;
			}
		}
	}

	public function updateForgetPassword($status, $id)
	{
		$case = "update";
		$q = "update Forget_Password set status = ".$this->fix_for_mysqli($status)." where id = ".$this->fix_for_mysqli($id);
		$this->setQuery($q);
		if($this->runQuery($case)) {
			return true;
		} else {
			return false;
		}
	}
}
?>