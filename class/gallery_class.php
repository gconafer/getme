<?php

include_once("meta_model.php");

class Gallery extends metaModel {
	public function __construct() {
		parent::__construct();
	}

	public function getGalleryByInstituateId($InstituateId)
	{
		$q = "SELECT * FROM Gallery where instituate_id = ".$this->fix_for_mysqli($InstituateId)." and status = 1 order by featured_status desc";
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