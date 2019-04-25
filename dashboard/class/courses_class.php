<?php

include_once("meta_model.php");

class Courses extends metaModel {
	public function __construct() {
		parent::__construct();
	}

	public function getCoursesByInstituateId($InstituateId)
	{
		$q = "SELECT C.*, CC.name as cname, CM.name as mname FROM Courses as C left join Child_Category as CC on (C.child_category_id = CC.id) left join Category_Master as CM on (C.master_category_id = CM.id) where instituate_id = ".$this->fix_for_mysqli($InstituateId)." and status = 1";
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getTotalRecordInArray();
			return $result;
		} else {
			return array();
		}
	}

	public function getCountCoursesByInstituateId($InstituateId)
	{
		$q = "SELECT count(*) as count FROM Courses where instituate_id = ".$this->fix_for_mysqli($InstituateId)." and status = 1";
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result['count'];
		} else {
			return array();
		}
	}

	public function getCourseDetail($InstituateId, $CourseId)
	{
		$q = "SELECT * FROM Courses where id = ".$this->fix_for_mysqli($CourseId)." and instituate_id = ".$this->fix_for_mysqli($InstituateId)." and status = 1";
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result;
		} else {
			return array();
		}
	}

	public function insertCourse($master_category_id, $child_category_id, $instituate_id, $price, $duration, $avg_no_student, $description, $teaching_pattern)
	{
		$case = "insert";
		$q = "Insert into Courses set master_category_id = '".$this->fix_for_mysqli($master_category_id)."', child_category_id = '".$this->fix_for_mysqli($child_category_id)."', instituate_id = '".$this->fix_for_mysqli($instituate_id)."', price = '".$this->fix_for_mysqli($price)."', duration = '".$this->fix_for_mysqli($duration)."', avg_no_student = '".$this->fix_for_mysqli($avg_no_student)."', description = '".$this->fix_for_mysqli($description)."', teaching_pattern = '".$this->fix_for_mysqli($teaching_pattern)."', status = 1, modified_on = '".date('Y-m-d H:i:s')."', created_on = '".date('Y-m-d H:i:s')."'";
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

	public function updateCourse($id, $master_category_id, $child_category_id, $price, $duration, $avg_no_student, $description, $teaching_pattern)
	{
		$case = "update";
		$q = "update Courses set master_category_id = '".$this->fix_for_mysqli($master_category_id)."', child_category_id = '".$this->fix_for_mysqli($child_category_id)."', price = '".$this->fix_for_mysqli($price)."', duration = '".$this->fix_for_mysqli($duration)."', avg_no_student = '".$this->fix_for_mysqli($avg_no_student)."', description = '".$this->fix_for_mysqli($description)."', teaching_pattern = '".$this->fix_for_mysqli($teaching_pattern)."', modified_on = '".date('Y-m-d H:i:s')."' where id = ".$this->fix_for_mysqli($id);
		$this->setQuery($q);
		if($this->runQuery($case)) {
			return true;
		} else {
			return false;
		}
	}

	public function deleteCourse($id)
	{
		$case = "update";
		$q = "update Courses set status = 2, modified_on = '".date('Y-m-d H:i:s')."' where id = ".$this->fix_for_mysqli($id);
		$this->setQuery($q);
		if($this->runQuery($case)) {
			return true;
		} else {
			return false;
		}
	}
}
?>