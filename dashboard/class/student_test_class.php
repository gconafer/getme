<?php

include_once("meta_model.php");

class Exam extends metaModel {
	public function __construct() {
		parent::__construct();
	}

	public function getTeacherByInstituateId($InstituateId)
	{
		$q = "SELECT * FROM Teacher where instituate_id = ".$this->fix_for_mysqli($InstituateId)." and status = 1";
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getTotalRecordInArray();
			return $result;
		} else {
			return array();
		}
	}
}
?>