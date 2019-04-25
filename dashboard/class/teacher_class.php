<?php

include_once("meta_model.php");

class Teacher extends metaModel {
	public function __construct() {
		parent::__construct();
	}

	public function getLastInsertTeacherInTable()
	{
		$q = "SELECT * FROM Teacher order by id desc";
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result;
		} else {
			return array();
		}
	}

	public function getTeacherByInstituateId($InstituateId)
	{
		$q = "SELECT * FROM Teacher where instituate_id = ".$this->fix_for_mysqli($InstituateId)." and status = 1";
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getTotalRecordInArray();
			return $result;
		} else {
			return array();
		}
	}

	public function getCountTeacherByInstituateId($InstituateId)
	{
		$q = "SELECT count(*) as count FROM Teacher where instituate_id = ".$this->fix_for_mysqli($InstituateId)." and status = 1";
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result['count'];
		} else {
			return array();
		}
	}

	public function getTeacherDetail($InstituateId, $TeacherId)
	{
		$q = "SELECT * FROM Teacher where id = ".$this->fix_for_mysqli($TeacherId)." and instituate_id = ".$this->fix_for_mysqli($InstituateId)." and status = 1";
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result;
		} else {
			return array();
		}
	}

	public function insertTeacher($instituate_id, $designation, $first_name, $last_name, $experience, $qualtification, $age, $gender, $achivements, $subject, $fb_url, $linkedin_url, $yt_url, $unique_url)
	{
		$case = "insert";
		$q = "Insert into Teacher set instituate_id = '".$this->fix_for_mysqli($instituate_id)."', designation = '".$this->fix_for_mysqli($designation)."', first_name = '".$this->fix_for_mysqli($first_name)."', last_name = '".$this->fix_for_mysqli($last_name)."', experience = '".$this->fix_for_mysqli($experience)."', qualtification = '".$this->fix_for_mysqli($qualtification)."', age = '".$this->fix_for_mysqli($age)."', gender = '".$this->fix_for_mysqli($gender)."', achivements = '".$this->fix_for_mysqli($achivements)."', subject = '".$this->fix_for_mysqli($subject)."', fb_url = '".$this->fix_for_mysqli($fb_url)."', linkedin_url = '".$this->fix_for_mysqli($linkedin_url)."', yt_url = '".$this->fix_for_mysqli($yt_url)."', unique_url = '".$this->fix_for_mysqli($unique_url)."', status = 1, modified_on = '".date('Y-m-d H:i:s')."', created_on = '".date('Y-m-d H:i:s')."'";
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

	public function updateTeacher($id, $designation, $first_name, $last_name, $experience, $qualtification, $age, $gender, $achivements, $subject, $fb_url, $linkedin_url, $yt_url)
	{
		$case = "update";
		$q = "update Teacher set designation = '".$this->fix_for_mysqli($designation)."', first_name = '".$this->fix_for_mysqli($first_name)."', last_name = '".$this->fix_for_mysqli($last_name)."', experience = '".$this->fix_for_mysqli($experience)."', qualtification = '".$this->fix_for_mysqli($qualtification)."', age = '".$this->fix_for_mysqli($age)."', gender = '".$this->fix_for_mysqli($gender)."', achivements = '".$this->fix_for_mysqli($achivements)."', subject = '".$this->fix_for_mysqli($subject)."', fb_url = '".$this->fix_for_mysqli($fb_url)."', linkedin_url = '".$this->fix_for_mysqli($linkedin_url)."', yt_url = '".$this->fix_for_mysqli($yt_url)."', status = 1, modified_on = '".date('Y-m-d H:i:s')."' where id = ".$this->fix_for_mysqli($id);
		$this->setQuery($q);
		if($this->runQuery($case)) {
			return true;
		} else {
			return false;
		}
	}

	public function deleteTeacher($id)
	{
		$case = "update";
		$q = "update Teacher set status = 2, modified_on = '".date('Y-m-d H:i:s')."' where id = ".$this->fix_for_mysqli($id);
		$this->setQuery($q);
		if($this->runQuery($case)) {
			return true;
		} else {
			return false;
		}
	}
}
?>