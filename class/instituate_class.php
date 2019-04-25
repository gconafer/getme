<?php

include_once("meta_model.php");

class Instituate extends metaModel {
	public function __construct() {
		parent::__construct();
	}

	public function getAllInstituate()
	{
		$q = "SELECT * FROM Instituate where status = 1";
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getTotalRecordInArray();
			return $result;
		} else {
			return array();
		}
	}

	public function getInstituateByPincode($CategoryId, $Pincode, $LocationId, $CountryId)
	{
		$q = "SELECT I.*, C.*, G.url as i_image_url FROM Instituate as I left join Courses as C on (I.id = C.instituate_id and I.status = 1 and C.status = 1) left join Gallery as G on (I.id = G.instituate_id and G.featured_status = 1 and G.status = 1 and G.type = 1) where C.child_category_id = ".$this->fix_for_mysqli($CategoryId)." and I.pincode = ".$this->fix_for_mysqli($Pincode)." and I.country_id = ".$this->fix_for_mysqli($CountryId)." order by I.id desc limit 0, 5";
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getTotalRecordInArray();
			return $result;
		} else {
			return array();
		}
	}

	public function getInstituateByCity($CategoryId, $CityId, $CountryId)
	{
		$q = "SELECT I.*, C.*, G.url as i_image_url FROM Instituate as I left join Courses as C on (I.id = C.instituate_id and I.status = 1 and C.status = 1) left join Gallery as G on (I.id = G.instituate_id and G.featured_status = 1 and G.status = 1 and G.type = 1) where C.child_category_id = ".$this->fix_for_mysqli($CategoryId)." and I.city_id = ".$this->fix_for_mysqli($CityId)." and I.country_id = ".$this->fix_for_mysqli($CountryId)." order by I.id desc limit 0, 5";
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getTotalRecordInArray();
			return $result;
		} else {
			return array();
		}
	}

	public function getInstituateCourses($type, $value)
	{
		if($type == 1) {
			$q = "I.unique_url = '".$this->fix_for_mysqli($value)."'";
		} elseif ($type == 2) {
			$q = "I.id = ".$this->fix_for_mysqli($value);
		}

		$q = "SELECT I.id as Iid, I.*, A.*, GROUP_CONCAT(CC.name SEPARATOR ', ') as cname, GROUP_CONCAT(CC.id SEPARATOR ', ') as cid, CM.name as city, LM.name as location FROM Instituate as I left join Courses as C on (I.id = C.instituate_id and I.status = 1 and C.status = 1) left join Child_Category as CC on (C.child_category_id = CC.id) left join Amenities as A on (I.id = A.instituate_id) left join City_Master as CM on (I.city_id = CM.id) left join Location_Master as LM on (I.location_id = LM.id) where ".$q;
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result;
		} else {
			return array();
		}
	}

	public function getSimilarInstituate($InstituateId, $Pincode, $CategoryId, $CountryId)
	{
		$q = "select I.*, C.*, G.url as i_image_url from Instituate as I left join Courses as C on (I.id = C.instituate_id and I.status = 1 and C.status = 1) left join Gallery as G on (I.id = G.instituate_id and G.featured_status = 1 and G.status = 1 and G.type = 1) where I.id != ".$this->fix_for_mysqli($InstituateId)." and I.pincode = '".$this->fix_for_mysqli($Pincode)."' and C.child_category_id IN (".$this->fix_for_mysqli($CategoryId).") and I.country_id = ".$this->fix_for_mysqli($CountryId).' group by I.id desc limit 0, 7';
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getTotalRecordInArray();
			return $result;
		} else {
			return array();
		}
	}

	public function getPopularInstituate($CityId)
	{
		$q = "select I.*, G.url as i_image_url from Instituate as I left join Gallery as G on (I.id = G.instituate_id and G.featured_status = 1 and G.status = 1 and G.type = 1) where I.city_id = ".$this->fix_for_mysqli($CityId)." and G.url is not NULL ORDER BY RAND() limit 0, 8";
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getTotalRecordInArray();
			return $result;
		} else {
			return array();
		}
	}

	public function getNearByLocation($Pincode, $Id)
	{
		$q = "select count(I.id) as count, LM.name, LM.url from Instituate as I left join Location_Master as LM on (I.location_id = LM.id) where LM.pincode = '".$this->fix_for_mysqli($Pincode)."' and LM.id != ".$this->fix_for_mysqli($Id)." and I.status = 1 group by I.location_id having count > 0 order by count desc";
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