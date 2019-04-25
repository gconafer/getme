<?php

include_once("meta_model.php");

class Courses_Enroll extends metaModel {
	public function __construct() {
		parent::__construct();
	}

	public function getCoursesEnrollByStudent($studentId)
	{
		$q = "SELECT E.* FROM Courses_Enroll as CE left join Exam as E on (CE.exam_id = E.id and E.status = 1) where CE.student_id = ".$this->fix_for_mysqli($studentId)." and CE.default_course = 1 and CE.status = 1";
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result;
		} else {
			return array();
		}
	}

	public function insertCourseEnroll($student_id, $exam_id, $default_course, $status)
	{
		$case = "insert";
		$q = "Insert into Courses_Enroll set student_id = '".$this->fix_for_mysqli($student_id)."', exam_id = '".$this->fix_for_mysqli($exam_id)."', default_course = '".$this->fix_for_mysqli($default_course)."', status = '".$this->fix_for_mysqli($status)."', modified_on = '".date('Y-m-d H:i:s')."', created_on = '".date('Y-m-d H:i:s')."'";
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