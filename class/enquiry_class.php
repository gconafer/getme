<?php

include_once("meta_model.php");

class Enquiry extends metaModel {
	public function __construct() {
		parent::__construct();
	}

	public function insertEnquiry($Name, $Email, $ContactNo, $Flowtype, $Type, $InstituateId, $CategoryId, $LocationId, $Value1, $Value2, $Value3)
	{
		$case = "insert";
		if(empty($LocationId)) $LocationId = 0;
		if(empty($CategoryId)) $CategoryId = 0;
		if(empty($InstituateId)) $InstituateId = 0;
		$q = "Insert into Enquiry set name = '".$this->fix_for_mysqli($Name)."', email = '".$this->fix_for_mysqli($Email)."', contact_no = '".$this->fix_for_mysqli($ContactNo)."', flowtype = '".$this->fix_for_mysqli($Flowtype)."', type = '".$this->fix_for_mysqli($Type)."', instituate_id = '".$this->fix_for_mysqli($InstituateId)."', category_id = '".$this->fix_for_mysqli($CategoryId)."', location_id = '".$this->fix_for_mysqli($LocationId)."', value1 = '".$this->fix_for_mysqli($Value1)."', value2 = '".$this->fix_for_mysqli($Value2)."', value3 = '".$this->fix_for_mysqli($Value3)."', modified_on = '".date('Y-m-d H:i:s')."', created_on = '".date('Y-m-d H:i:s')."'";
		$this->setQuery($q);
		if($this->runQuery($case)) {
			$Id = $this->getLastInsertId();
			if($Id > 0) {
				return $Id;
			} else {
				return 0;
			}
		}
	}

}
?>