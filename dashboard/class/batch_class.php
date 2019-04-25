<?php

include_once("meta_model.php");

class Batch extends metaModel {
	public function __construct() {
		parent::__construct();
	}

	public function getBatchDetail($InstituateId, $BatchId)
	{
		$q = "SELECT * FROM Batch where id = ".$this->fix_for_mysqli($BatchId)." and instituate_id = ".$this->fix_for_mysqli($InstituateId)." and status = 1";
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result;
		} else {
			return array();
		}
	}

	public function getBatchByInstituateId($InstituateId)
	{
		$q = "SELECT B.id, B.start_date, B.duration, B.timing, CC.name FROM Batch as B left join Courses as C on (B.course_id = C.id) left join Child_Category as CC on (C.child_category_id = CC.id) where B.instituate_id = ".$this->fix_for_mysqli($InstituateId)." and B.status = 1 and C.status = 1";
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getTotalRecordInArray();
			return $result;
		} else {
			return array();
		}
	}

	public function getCountBatchByInstituateId($InstituateId)
	{
		$q = "SELECT count(*) as count FROM Batch where instituate_id = ".$this->fix_for_mysqli($InstituateId)." and status = 1";
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result['count'];
		} else {
			return array();
		}
	}

	public function insertBatch($instituate_id, $course_id, $start_date, $timing, $class_duration, $duration, $description)
	{
		$case = "insert";
		$date = date('Y-m-d', strtotime($start_date));
		$q = "Insert into Batch set instituate_id = '".$this->fix_for_mysqli($instituate_id)."', course_id = '".$this->fix_for_mysqli($course_id)."', start_date = '".$this->fix_for_mysqli(date('Y-m-d', strtotime($date)))."', timing = '".$this->fix_for_mysqli($timing)."', class_duration = '".$this->fix_for_mysqli($class_duration)."', duration = '".$this->fix_for_mysqli($duration)."', description = '".$this->fix_for_mysqli($description)."', status = 1, modified_on = '".date('Y-m-d H:i:s')."', created_on = '".date('Y-m-d H:i:s')."'";
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

	public function updateBatch($id, $course_id, $start_date, $timing, $class_duration, $duration, $description)
	{
		$case = "update";
		$date = date('Y-m-d', strtotime($start_date));
		$q = "update Batch set course_id = '".$this->fix_for_mysqli($course_id)."', start_date = '".$this->fix_for_mysqli(date('Y-m-d', strtotime($date)))."', timing = '".$this->fix_for_mysqli($timing)."', class_duration = '".$this->fix_for_mysqli($class_duration)."', duration = '".$this->fix_for_mysqli($duration)."', description = '".$this->fix_for_mysqli($description)."', status = 1, modified_on = '".date('Y-m-d H:i:s')."' where id = ".$this->fix_for_mysqli($id);
		$this->setQuery($q);
		if($this->runQuery($case)) {
			return true;
		} else {
			return false;
		}
	}

	public function deleteBatch($id)
	{
		$case = "update";
		$q = "update Batch set status = 2, modified_on = '".date('Y-m-d H:i:s')."' where id = ".$this->fix_for_mysqli($id);
		$this->setQuery($q);
		if($this->runQuery($case)) {
			return true;
		} else {
			return false;
		}
	}

}
?>