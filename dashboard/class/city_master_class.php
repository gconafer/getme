<?php

include_once("meta_model.php");

class City_Master extends metaModel {
	public function __construct() {
		parent::__construct();
	}

	public function getListOfCityByCountryId($CountryId)
	{
		$q = "select * from City_Master where country_id = ".$this->fix_for_mysqli($CountryId);
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