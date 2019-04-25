<?php

include_once("meta_model.php");

class Exam_Chapter extends metaModel {
	public function __construct() {
		parent::__construct();
	}

	public function getSubjectChapterList($SubjectId)
	{
		$q = "SELECT id, name FROM Exam_Chapter where exam_subject_id = ".$this->fix_for_mysqli($SubjectId)." and status = 1";
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