<?php

include_once("meta_model.php");

class Exam_Test extends metaModel {
	public function __construct() {
		parent::__construct();
	}

	public function getExamTestById($Id)
	{
		$q = "SELECT ET.id, ET.exam_id, ET.url, ET.level, ET.name as name, E.name as exam, ES.name as subject, EC.name as chapter, COUNT(EQ.id) as count FROM Exam_Test as ET left join Exam as E on (ET.exam_id = E.id and E.status = 1) left join Exam_Subject as ES on (ET.subject_id = ES.id and ES.status = 1) left join Exam_Chapter as EC on (ET.chapter_id = EC.id and EC.status = 1) left join Exam_Question as EQ on (ET.id = EQ.test_id and EQ.status = 1) where ET.id = '".$this->fix_for_mysqli($Id)."' and ET.status = 1";
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result;
		} else {
			return array();
		}
	}

	public function getExamTestByUrl($Url)
	{
		$q = "SELECT ET.id, ET.url, ET.level, ET.name as name, E.name as exam, ES.name as subject, EC.name as chapter, COUNT(EQ.id) as count FROM Exam_Test as ET left join Exam as E on (ET.exam_id = E.id and E.status = 1) left join Exam_Subject as ES on (ET.subject_id = ES.id and ES.status = 1) left join Exam_Chapter as EC on (ET.chapter_id = EC.id and EC.status = 1) left join Exam_Question as EQ on (ET.id = EQ.test_id and EQ.status = 1) where ET.url = '".$this->fix_for_mysqli($Url)."' and ET.status = 1 having count > 1";
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result;
		} else {
			return array();
		}
	}

	public function getTestStatusById($test_id)
	{
		$q = "SELECT * FROM Exam_Test where id = '".$this->fix_for_mysqli($test_id)."' and status = 1";
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result;
		} else {
			return array();
		}
	}

	public function getPopularExamTest($exam_id)
	{
		$q = "SELECT ET.*, COUNT(EQ.id) as count FROM Exam_Test as ET left join Exam_Question as EQ on (ET.id = EQ.test_id and EQ.status = 1) where ET.exam_id = '".$this->fix_for_mysqli($exam_id)."' and ET.status = 1 group by ET.id order by count desc limit 0, 5";
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getTotalRecordInArray();
			return $result;
		} else {
			return array();
		}
	}

	public function getTestStatusByIdAndUrl($test_id, $url)
	{
		$q = "SELECT * FROM Exam_Test where id = '".$this->fix_for_mysqli($test_id)."' and url = '".$this->fix_for_mysqli($url)."' and status = 1";
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result;
		} else {
			return array();
		}
	}

	public function getTestAndQuestion($test_id)
	{
		$q = "SELECT EQ.* FROM Exam_Test as ET left join Exam_Question as EQ on (ET.id = EQ.test_id and EQ.status = 1) where ET.id = '".$this->fix_for_mysqli($test_id)."' and ET.status = 1 order by EQ.id asc";
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getTotalRecordInArray();
			return $result;
		} else {
			return array();
		}
	}

	public function getTestListOfStudent($examId, $subjectId, $studentId)
	{
		$q = "SELECT ET.*, COUNT(EQ.id) as count FROM Exam_Test as ET left join Student_Test as ST on (ET.id = ST.test_id and ST.student_id = ".$this->fix_for_mysqli($studentId).") left join Exam_Question as EQ on (ET.id = EQ.test_id and EQ.status = 1) where ET.exam_id = ".$this->fix_for_mysqli($examId)." and ET.subject_id = ".$this->fix_for_mysqli($subjectId)." and ET.chapter_id = 0 and ET.status = 1 and ST.id IS NULL group by ET.id order by ET.created_on desc limit 0, 5";
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