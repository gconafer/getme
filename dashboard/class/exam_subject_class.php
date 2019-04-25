<?php

include_once("meta_model.php");

class Exam_Subject extends metaModel {
	public function __construct() {
		parent::__construct();
	}

	public function getExamSubjectList($ExamId)
	{
		$q = "SELECT id, name FROM Exam_Subject where exam_id = ".$this->fix_for_mysqli($ExamId)." and status = 1";
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