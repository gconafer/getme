<?php

include_once("meta_model.php");

class Amenities extends metaModel {
	public function __construct() {
		parent::__construct();
	}

	public function getListOfAmenities($InstituateId)
	{
		$q = "select * from Amenities where instituate_id = ".$this->fix_for_mysqli($InstituateId);
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result;
		} else {
			return array();
		}
	}

	public function insertAmenities($instituate_id, $study_material, $test_series, $online_portal, $ac, $wifi, $pick_and_drop, $library)
	{
		$case = "insert";
		$q = "Insert into Amenities set instituate_id = '".$this->fix_for_mysqli($instituate_id)."', study_material = '".$this->fix_for_mysqli($study_material)."', test_series = '".$this->fix_for_mysqli($test_series)."', online_portal = '".$this->fix_for_mysqli($online_portal)."', ac = '".$this->fix_for_mysqli($ac)."', wifi = '".$this->fix_for_mysqli($wifi)."', pick_and_drop = '".$this->fix_for_mysqli($pick_and_drop)."', library = '".$this->fix_for_mysqli($library)."', modified_on = '".date('Y-m-d H:i:s')."', created_on = '".date('Y-m-d H:i:s')."'";
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

	public function updateAmenities($instituate_id, $study_material, $test_series, $online_portal, $ac, $wifi, $pick_and_drop, $library)
	{
		$case = "update";
		$q = "Update Amenities set study_material = '".$this->fix_for_mysqli($study_material)."', test_series = '".$this->fix_for_mysqli($test_series)."', online_portal = '".$this->fix_for_mysqli($online_portal)."', ac = '".$this->fix_for_mysqli($ac)."', wifi = '".$this->fix_for_mysqli($wifi)."', pick_and_drop = '".$this->fix_for_mysqli($pick_and_drop)."', library = '".$this->fix_for_mysqli($library)."', modified_on = '".date('Y-m-d H:i:s')."' where instituate_id = ".$this->fix_for_mysqli($instituate_id);
		$this->setQuery($q);
		if($this->runQuery($case)) {
			return true;
		} else {
			return false;
		}
	}

}
?>