<?php

include_once("meta_model.php");

class Login extends metaModel {
	public function __construct() {
		parent::__construct();
	}

	public function userLogin($Email, $Password)
	{
		$q = "SELECT * FROM User where email = '".$this->fix_for_mysqli($Email)."' and password = '".$this->fix_for_mysqli($Password)."' and status = 1";
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
?>