<?php

include_once("meta_model.php");

class Gallery extends metaModel {
	public function __construct() {
		parent::__construct();
	}

	public function getInstituteFeatureGallery($instituate_id, $type)
	{
		$q = "select * from Gallery where instituate_id = ".$instituate_id." and type = ".$type." and featured_status = 1 and status = 1";
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result;
		} else {
			return array();
		}
	}

	public function getInstituteGalleryList($instituate_id)
	{
		$q = "select * from Gallery where instituate_id = ".$instituate_id." and status = 1 order by featured_status desc, id desc";
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getTotalRecordInArray();
			return $result;
		} else {
			return array();
		}
	}

	public function getGalleryDetail($instituate_id, $gallery_id, $type)
	{
		$q = "SELECT * FROM Gallery where id = ".$this->fix_for_mysqli($gallery_id)." and instituate_id = ".$this->fix_for_mysqli($instituate_id)." and type = ".$this->fix_for_mysqli($type)." and featured_status != 1 and status = 1";
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result;
		} else {
			return array();
		}
	}

	public function insertGallery($instituate_id, $course_id, $type, $featured_status, $url)
	{
		$case = "insert";
		$q = "Insert into Gallery set instituate_id = '".$this->fix_for_mysqli($instituate_id)."', course_id = '".$this->fix_for_mysqli($course_id)."', type = '".$this->fix_for_mysqli($type)."', featured_status = '".$this->fix_for_mysqli($featured_status)."', url = '".$this->fix_for_mysqli($url)."', status = 1, modified_on = '".date('Y-m-d H:i:s')."', created_on = '".date('Y-m-d H:i:s')."'";
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

	public function deleteGallery($id)
	{
		$case = "update";
		$q = "update Gallery set status = 0, modified_on = '".date('Y-m-d H:i:s')."' where id = ".$this->fix_for_mysqli($id);
		$this->setQuery($q);
		if($this->runQuery($case)) {
			return true;
		} else {
			return false;
		}
	}

}
?>