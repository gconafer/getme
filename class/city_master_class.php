<?php

include_once("meta_model.php");

class City_Master extends metaModel {
	public function __construct(){
		parent::__construct();
	}

	public function getDetailOfCity($Id)
	{
		$q = "select * from City_Master where id = ".$this->fix_for_mysqli($Id);
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result;
		} else {
			return array();
		}
	}

	public function getCityByCountry($countryId)
	{
		$q = "select * from City_Master where country_id = ".$this->fix_for_mysqli($countryId);
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getTotalRecordInArray();
			return $result;
		} else {
			return array();
		}
	}

	public function getAllCityCategoryUrl()
	{
		$q = "select CM.url as city_url, CC.url as category_url from City_Master as CM left join Child_Category as CC on (CM.country_id = CC.country_id)";
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
