<?php

include_once("meta_model.php");

class Student_Question extends metaModel {
	public function __construct() {
		parent::__construct();
	}

	public function getStudentTestMarks($student_id, $test_id)
	{
		$q = "SELECT EQ.answer as exam_ans, SQ.answer as stu_ans from Student_Question as SQ left join Exam_Question as EQ on (SQ.q_id = EQ.id and EQ.status = 1) where SQ.student_id = ".$this->fix_for_mysqli($student_id)." and SQ.test_id = ".$this->fix_for_mysqli($test_id);
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getTotalRecordInArray();
			return $result;
		} else {
			return array();
		}
	}

	public function getExamTestQuestionById($student_id, $test_id)
	{
		$q = "SELECT EQ.subject, EQ.op1, EQ.op2, EQ.op3, EQ.op4, EQ.solution, EQ.answer as exam_ans, SQ.answer as stu_ans from Student_Question as SQ left join Exam_Question as EQ on (SQ.q_id = EQ.id and EQ.status = 1) where SQ.student_id = ".$this->fix_for_mysqli($student_id)." and SQ.test_id = ".$this->fix_for_mysqli($test_id);
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getTotalRecordInArray();
			return $result;
		} else {
			return array();
		}
	}

	public function insertStudentQuestionOfTest($student_id, $test_id, $q_id, $answer)
	{
		$case = "insert";
		$q = "Insert into Student_Question set student_id = '".$this->fix_for_mysqli($student_id)."', test_id = '".$this->fix_for_mysqli($test_id)."', q_id = '".$this->fix_for_mysqli($q_id)."', answer = '".$this->fix_for_mysqli($answer)."', modified_on = '".date('Y-m-d H:i:s')."', created_on = '".date('Y-m-d H:i:s')."'";
		$this->setQuery($q);
		if($this->runQuery($case)) {
			$Id = $this->getLastInsertId();
			if($Id > 0) {
				return $Id;
			} else {
				return array();
			}
		}
	}
}
?>