<?php

include_once("meta_model.php");

class Exam_Test extends metaModel {
	public function __construct() {
		parent::__construct();
	}

	public function getExamTestList($instituate_id)
	{
		$q = "SELECT ET.id, ET.url, ET.level, ET.name as name, ET.status as status, E.name as exam, ES.name as subject, EC.name as chapter, COUNT(EQ.id) as count FROM Exam_Test as ET left join Exam as E on (ET.exam_id = E.id and E.status = 1) left join Exam_Subject as ES on (ET.subject_id = ES.id and ES.status = 1) left join Exam_Chapter as EC on (ET.chapter_id = EC.id and EC.status = 1) left join Exam_Question as EQ on (ET.id = EQ.test_id and EQ.status = 1) where ET.instituate_id = ".$this->fix_for_mysqli($instituate_id)." and ET.status IN (0, 1) group by ET.id order by ET.id desc";
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getTotalRecordInArray();
			return $result;
		} else {
			return array();
		}
	}

	public function getExamTestById($id)
	{
		$q = "SELECT * FROM Exam_Test where id = ".$this->fix_for_mysqli($id);
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result;
		} else {
			return array();
		}
	}

	public function getExamTestQuestionById($id)
	{
		$q = "SELECT ET.id as tid, ET.url, ET.level, ET.name as name, ET.status as tstatus, EQ.* FROM Exam_Test as ET left join Exam_Question as EQ on (ET.id = EQ.test_id and EQ.status = 1) where ET.status IN (0, 1) and ET.id = ".$this->fix_for_mysqli($id)." order by EQ.id asc";
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getTotalRecordInArray();
			return $result;
		} else {
			return array();
		}
	}
	
	public function insertExamTest($instituate_id, $exam_id, $subject_id, $chapter_id, $name, $url, $level, $instruction, $status)
	{
		$case = "insert";
		$q = "Insert into Exam_Test set instituate_id = '".$this->fix_for_mysqli($instituate_id)."', exam_id = '".$this->fix_for_mysqli($exam_id)."', subject_id = '".$this->fix_for_mysqli($subject_id)."', chapter_id = '".$this->fix_for_mysqli($chapter_id)."', name = '".$this->fix_for_mysqli($name)."', url = '".$this->fix_for_mysqli($url)."', level = '".$this->fix_for_mysqli($level)."', instruction = '".$this->fix_for_mysqli($instruction)."', status = '".$this->fix_for_mysqli($status)."', modified_on = '".date('Y-m-d H:i:s')."', created_on = '".date('Y-m-d H:i:s')."'";
		$this->setQuery($q);
		if($this->runQuery($case)) {
			$Id = $this->getLastInsertId();
			if($Id > 0) {
				return $Id;
			} else {
				return 0;
			}
		}
	}

	public function updateUrlExamTest($id, $url)
	{
		$case = "update";
		$q = "update Exam_Test set url = '".$this->fix_for_mysqli($url)."', modified_on = '".date('Y-m-d H:i:s')."' where id = ".$this->fix_for_mysqli($id);
		$this->setQuery($q);
		if($this->runQuery($case)) {
			return true;
		} else {
			return false;
		}
	}

	public function updateExamTest($id, $status)
	{
		$case = "update";
		$q = "update Exam_Test set status = ".$this->fix_for_mysqli($status).", modified_on = '".date('Y-m-d H:i:s')."' where id = ".$this->fix_for_mysqli($id);
		$this->setQuery($q);
		if($this->runQuery($case)) {
			return true;
		} else {
			return false;
		}
	}
}
?>