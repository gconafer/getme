<?php

include_once("meta_model.php");

class Location_Master extends metaModel {
	public function __construct(){
		parent::__construct();
	}

	public function getListOfCityLocation($cityId)
	{
		$q = "select * from Location_Master where city_id = ".$this->fix_for_mysqli($cityId);
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getTotalRecordInArray();
			return $result;
		} else {
			return array();
		}
	}

	public function getDetailOfLocationByCityId($Id, $cityId)
	{
		$q = "select * from Location_Master where id = ".$this->fix_for_mysqli($Id)." and city_id = ".$this->fix_for_mysqli($cityId);
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result;
		} else {
			return array();
		}
	}

	public function getDetailOfLocation($Id)
	{
		$q = "select * from Location_Master where id = ".$this->fix_for_mysqli($Id);
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result;
		} else {
			return array();
		}
	}

	public function getDetailOfLocationUrl($Url)
	{
		$q = "select * from Location_Master where url = '".$this->fix_for_mysqli($Url)."'";
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
