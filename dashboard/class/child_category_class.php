<?php

include_once("meta_model.php");

class Child_Category extends metaModel {
	public function __construct(){
		parent::__construct();
	}

	public function getListOfChildCategory($CountryId)
	{
		$q = "select * from Child_Category where country_id = ".$this->fix_for_mysqli($CountryId);
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getTotalRecordInArray();
			return $result;
		} else {
			return array();
		}
	}

	public function getDetailOfCategory($Id)
	{
		$q = "select * from Child_Category where id = ".$this->fix_for_mysqli($Id);
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result;
		} else {
			return array();
		}
	}

	public function getDetailOfCategoryUrl($Url, $CountryId)
	{
		$q = "select * from Child_Category where url = '".$this->fix_for_mysqli($Url)."' and country_id = ".$this->fix_for_mysqli($CountryId);
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
