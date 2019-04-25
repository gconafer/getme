<?php

include_once("meta_model.php");

class Category_Master extends metaModel {
	public function __construct(){
		parent::__construct();
	}

	public function getListOfMasterCategory($CountryId)
	{
		$q = "select * from Category_Master where country_id = ".$this->fix_for_mysqli($CountryId);
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
		$q = "select * from Category_Master where id = ".$this->fix_for_mysqli($Id);
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
		$q = "select * from Category_Master where url = '".$this->fix_for_mysqli($Url)."' and country_id = ".$this->fix_for_mysqli($CountryId);
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
