<?php

include_once("meta_model.php");

class Exam extends metaModel {
	public function __construct() {
		parent::__construct();
	}

	public function getExamList()
	{
		$q = "SELECT * FROM Exam where status = 1";
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getTotalRecordInArray();
			return $result;
		} else {
			return array();
		}
	}

	public function getExamDetailByUrl($examUrl)
	{
		$q = "select * from Exam where url = '".$this->fix_for_mysqli($examUrl)."' E.status = 1";
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result;
		} else {
			return array();
		}
	}

	public function getExambyUrl($q, $q1)
	{
		if(!empty($q1)) $string = "and ES.url = '".$this->fix_for_mysqli($q1)."' ";
		$q = "SELECT ET.id, ET.url, ET.level, ET.name as name, E.name as exam, ES.name as subject, EC.name as chapter, COUNT(EQ.id) as count FROM Exam as E left join Exam_Test as ET on (E.id = ET.exam_id and ET.status = 1) left join Exam_Subject as ES on (ET.subject_id = ES.id and ES.status = 1) left join Exam_Chapter as EC on (ET.chapter_id = EC.id and EC.status = 1) left join Exam_Question as EQ on (ET.id = EQ.test_id and EQ.status = 1) where E.url = '".$this->fix_for_mysqli($q)."' ".$string."and E.status = 1 group by ET.id having count > 0 order by ET.id desc";
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getTotalRecordInArray();
			return $result;
		} else {
			return array();
		}
	}

	public function getSubjectWiseExam($q)
	{
		$q = "SELECT E.name as exam, E.url as exam_url, ES.name as subject, ES.url as subject_url, COUNT(ET.id) as count FROM Exam as E left join Exam_Subject as ES on (E.id = ES.exam_id and ES.status = 1) left join Exam_Test as ET on (ET.subject_id = ES.id and ET.status = 1) where E.url = '".$this->fix_for_mysqli($q)."' and E.status = 1 group by ES.id order by count desc, ES.id desc";
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getTotalRecordInArray();
			return $result;
		} else {
			return array();
		}
	}

	public function getExamByUrlAndSubjectId($examUrl, $subjectId)
	{
		$q = "select E.id as exam_id, E.name as exam_name, E.url as exam_url, ES.id as subject_id, ES.name as subject_name, ES.url as subject_url from Exam as E left join Exam_Subject as ES on (E.id = ES.exam_id and ES.status = 1) where E.url = '".$this->fix_for_mysqli($examUrl)."' and ES.id = ".$this->fix_for_mysqli($subjectId)." and E.status = 1";
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result;
		} else {
			return array();
		}
	}

	public function getExamListByEnrolledStudentId($studentId)
	{
		$q = "select E.id, E.name, E.url, CE.status from Exam as E left join Courses_Enroll as CE on (E.id = CE.exam_id and CE.student_id = ".$this->fix_for_mysqli($studentId).") where E.status = 1";
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