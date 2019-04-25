<?php

include_once("meta_model.php");

class Student_Test extends metaModel {
	public function __construct() {
		parent::__construct();
	}

	public function getStudentTestById($id)
	{
		$q = "SELECT * from Student_Test where id = ".$this->fix_for_mysqli($id);
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result;
		} else {
			return array();
		}
	}

	public function countStudentTest($test_id)
	{
		$q = "SELECT count(*) as count from Student_Test where test_id = ".$this->fix_for_mysqli($test_id);
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result['count'];
		} else {
			return array();
		}
	}

	public function getStudentTest($student_id, $id)
	{
		$q = "SELECT * from Student_Test where student_id = ".$this->fix_for_mysqli($student_id)." and id = ".$this->fix_for_mysqli($id);
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result;
		} else {
			return array();
		}
	}

	public function getExamTestStats($test_id)
	{
		$q = "SELECT AVG(marks) as avg, MAX(marks) as max, AVG(time) as time from Student_Test where submit = 1 and test_id = ".$this->fix_for_mysqli($test_id);
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result;
		} else {
			return array();
		}
	}

	public function getPreviousTestListOfStudent($studentId, $examId, $subjectId)
	{
		$q = "SELECT ST.time, ST.r_q, ST.w_q, ST.un_q, ST.t_q, ST.marks, ET.name, ET.level, ET.url FROM Student_Test as ST join Exam_Test as ET on (ST.test_id = ET.id) where ST.student_id = ".$this->fix_for_mysqli($studentId)." and ET.exam_id = ".$this->fix_for_mysqli($examId)." and ET.subject_id = ".$this->fix_for_mysqli($subjectId)." and ET.chapter_id = 0 and ST.submit = 1 and ST.status = 1";
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getTotalRecordInArray();
			return $result;
		} else {
			return array();
		}
	}

	public function insertStudentTest($student_id, $test_id, $submit, $r_q, $w_q, $marks, $status)
	{
		$case = "insert";
		$date = date('Y-m-d H:i:s');
		$timestamp = strtotime($date);
		$q = "Insert into Student_Test set student_id = '".$this->fix_for_mysqli($student_id)."', test_id = '".$this->fix_for_mysqli($test_id)."', submit = '".$this->fix_for_mysqli($submit)."', r_q = '".$this->fix_for_mysqli($r_q)."', w_q = '".$this->fix_for_mysqli($w_q)."', marks = '".$this->fix_for_mysqli($marks)."', status = '".$this->fix_for_mysqli($status)."', modified_on = '".date('Y-m-d H:i:s')."', created_on = '".$date."'";
		$this->setQuery($q);
		if($this->runQuery($case)) {
			$Id = $this->getLastInsertId();
			if($Id > 0) {
				return array('id' => $Id, 'time' => $timestamp);
			} else {
				return array();
			}
		}
	}

	public function updateStudentTest($time, $RightQ, $WrongQ, $UnattempQ, $TotalQ, $Marks, $id)
	{
		$case = "update";
		$q = "update Student_Test set submit = 1, time = ".$this->fix_for_mysqli($time).", r_q = ".$this->fix_for_mysqli($RightQ).", w_q = ".$this->fix_for_mysqli($WrongQ).", un_q = ".$this->fix_for_mysqli($UnattempQ).", t_q = ".$this->fix_for_mysqli($TotalQ).", marks = ".$this->fix_for_mysqli($Marks).", modified_on = '".date('Y-m-d H:i:s')."' where id = ".$this->fix_for_mysqli($id);
		$this->setQuery($q);
		if($this->runQuery($case)) {
			return true;
		} else {
			return false;
		}
	}
}
?>