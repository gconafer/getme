<?php

include_once("meta_model.php");

class Country_Master extends metaModel {
	public function __construct() {
		parent::__construct();
	}

	public function getListOfMasterCountry()
	{
		$q = "select * from Country_Master";
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