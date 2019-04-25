<?php

include_once("meta_model.php");

class Exam_Subject extends metaModel {
	public function __construct() {
		parent::__construct();
	}

	public function getSubjectByExamId($examId)
	{
		$q = "SELECT * FROM Exam_Subject where exam_id = ".$this->fix_for_mysqli($examId)." and status = 1";
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