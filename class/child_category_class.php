<?php

include_once("meta_model.php");

class Child_Category extends metaModel {
	public function __construct(){
		parent::__construct();
	}

	public function getListOfChildCategory($CountryId)
	{
		$q = "select * from Child_Category where id IN (1,3,10,16,17,23,37,41,51,52,53,54,55,56,57,58,59,60,68,69,70,71,72,73,74,75,76,77) and country_id = ".$this->fix_for_mysqli($CountryId)." order by name asc";
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

	public function getParentandChildCourses($CategoryId, $ParentId)
	{
		if($ParentId) $q = "and (parent_id = ".$this->fix_for_mysqli($ParentId)." or id = ".$this->fix_for_mysqli($ParentId).") ";
		$q = "select * from Child_Category where category_id = ".$CategoryId." ".$q."order by parent_id asc, name asc";
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
