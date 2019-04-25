<?php

include_once("meta_model.php");

class Exam_Question extends metaModel {
	public function __construct() {
		parent::__construct();
	}

	public function getQuestionListOfTestWithAnswer($studentId, $testId)
	{
		$q = "SELECT EQ.id, EQ.test_id, EQ.subject, EQ.descr, EQ.op1, EQ.op2, EQ.op3, EQ.op4, EQ.answer, EQ.solution, SQ.answer as student_answer FROM Exam_Question as EQ left join Student_Question as SQ on (EQ.test_id = SQ.test_id and EQ.id = SQ.q_id and SQ.student_id = ".$this->fix_for_mysqli($studentId).") where EQ.test_id = ".$this->fix_for_mysqli($testId)." and EQ.status = 1";
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