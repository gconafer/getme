<?php

include_once("meta_model.php");

class Exam_Question extends metaModel {
	public function __construct() {
		parent::__construct();
	}

	public function insertExamQuestion($test_id, $q, $a, $b, $c, $d, $r, $s, $desc)
	{
		$case = "insert";
		$q = "Insert into Exam_Question set test_id = '".$this->fix_for_mysqli($test_id)."', subject = '".$this->fix_for_mysqli($q)."', descr = '".$this->fix_for_mysqli($desc)."', op1 = '".$this->fix_for_mysqli($a)."', op2 = '".$this->fix_for_mysqli($b)."', op3 = '".$this->fix_for_mysqli($c)."', op4 = '".$this->fix_for_mysqli($d)."', answer = '".$this->fix_for_mysqli($r)."', solution = '".$this->fix_for_mysqli($s)."', status = 1, modified_on = '".date('Y-m-d H:i:s')."', created_on = '".date('Y-m-d H:i:s')."'";
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

	public function updateExamQuestion($test_id, $q_id, $q, $a, $b, $c, $d, $r, $s, $desc)
	{
		$case = "update";
		$q = "update Exam_Question set subject = '".$this->fix_for_mysqli($q)."', descr = '".$this->fix_for_mysqli($desc)."', op1 = '".$this->fix_for_mysqli($a)."', op2 = '".$this->fix_for_mysqli($b)."', op3 = '".$this->fix_for_mysqli($c)."', op4 = '".$this->fix_for_mysqli($d)."', answer = '".$this->fix_for_mysqli($r)."', solution = '".$this->fix_for_mysqli($s)."', status = 1, modified_on = '".date('Y-m-d H:i:s')."' where id = ".$this->fix_for_mysqli($q_id)." and test_id = ".$this->fix_for_mysqli($test_id);
		$this->setQuery($q);
		if($this->runQuery($case)) {
			return true;
		} else {
			return false;
		}
	}

	public function getExamTotalQuesCount($test_id)
	{
		$q = "SELECT count(*) as count FROM Exam_Question where test_id = '".$this->fix_for_mysqli($test_id)."' and status = 1";
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result['count'];
		} else {
			return array();
		}
	}

	public function getExamQuesByQuesNumber($test_id, $ques_id)
	{
		$quesNo = $ques_id-1;
		$q = "SELECT * FROM Exam_Question where test_id = '".$this->fix_for_mysqli($test_id)."' and status = 1 order by id asc limit $quesNo, 1";
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result;
		} else {
			return array();
		}
	}

	public function getExamQuesByQuesID($test_id, $ques_id)
	{
		$q = "SELECT * FROM Exam_Question where test_id = '".$this->fix_for_mysqli($test_id)."' and id = ".$this->fix_for_mysqli($ques_id);
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result;
		} else {
			return array();
		}
	}
}
?>