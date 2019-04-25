<?php

include_once("meta_model.php");

class Join extends metaModel {
	public function __construct() {
		parent::__construct();
	}

	public function getInstituateCourseListLocationId($CategoryId, $LocationId)
	{
		$q = "SELECT * FROM Instituate as I left join Courses as C on (I.id = C.instituate_id and I.status = 1 and C.status = 1) where I.location_id = ".$this->fix_for_mysqli($LocationId)." and C.master_category_id = ".$this->fix_for_mysqli($CategoryId);
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getTotalRecordInArray();
			return $result;
		} else {
			return array();
		}
	}

	public function getInstituateCourseListCityId($CategoryId, $CityId)
	{
		$q = "SELECT * FROM Instituate as I left join Courses as C on (I.id = C.instituate_id and I.status = 1 and C.status = 1) where I.city_id = ".$this->fix_for_mysqli($CityId)." and C.master_category_id = ".$this->fix_for_mysqli($CategoryId);
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getTotalRecordInArray();
			return $result;
		} else {
			return array();
		}
	}

	public function getIdOfLocationCityFromUrl($Url, $CountryId)
	{
		$q = "select C.id as cid, C.name as cname, C.url as curl, L.id as lid, L.name as lname, L.url as lurl, L.pincode as lpincode from City_Master as C left join Location_Master as L on (C.id = L.city_id) where (C.url = '".$this->fix_for_mysqli($Url)."' or L.url = '".$this->fix_for_mysqli($Url)."') and C.country_id = ".$this->fix_for_mysqli($CountryId);
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