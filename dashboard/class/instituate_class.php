<?php

include_once("meta_model.php");

class Instituate extends metaModel {
	public function __construct() {
		parent::__construct();
	}

	public function getInstituateById($Id)
	{
		$q = "SELECT * FROM Instituate where id = '".$this->fix_for_mysqli($Id)."'";
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result;
		} else {
			return array();
		}
	}

	public function updateInstitute($id, $name, $description, $founded, $working_days, $country_id, $city_id, $location_id, $pincode, $contact_email, $contact_no, $address, $website_url, $fb_page_url, $avg_no_batches, $no_of_teachers, $avg_teacher_exp, $avg_batch_size)
	{
		$case = "update";
		$q = "Update Instituate set name = '".$this->fix_for_mysqli($name)."', description = '".$this->fix_for_mysqli($description)."', founded = '".$this->fix_for_mysqli($founded)."', working_days = '".$this->fix_for_mysqli($working_days)."', website_url = '".$this->fix_for_mysqli($website_url)."', fb_page_url = '".$this->fix_for_mysqli($fb_page_url)."', country_id = '".$this->fix_for_mysqli($country_id)."', city_id = '".$this->fix_for_mysqli($city_id)."', location_id = '".$this->fix_for_mysqli($location_id)."', pincode = '".$this->fix_for_mysqli($pincode)."', contact_email = '".$this->fix_for_mysqli($contact_email)."', contact_no = '".$this->fix_for_mysqli($contact_no)."', address = '".$this->fix_for_mysqli($address)."', avg_no_batches = '".$this->fix_for_mysqli($avg_no_batches)."', no_of_teachers = '".$this->fix_for_mysqli($no_of_teachers)."', avg_teacher_exp = '".$this->fix_for_mysqli($avg_teacher_exp)."', avg_batch_size = '".$this->fix_for_mysqli($avg_batch_size)."', modified_on = '".date('Y-m-d H:i:s')."' where id = ".$this->fix_for_mysqli($id);
		$this->setQuery($q);
		if($this->runQuery($case)) {
			return true;
		} else {
			return false;
		}
	}

	public function updateInstituteLatLong($id, $lat, $long)
	{
		$case = "update";
		$q = "Update Instituate set latitude = '".$this->fix_for_mysqli($lat)."', longitude = '".$this->fix_for_mysqli($long)."', modified_on = '".date('Y-m-d H:i:s')."' where id = ".$this->fix_for_mysqli($id);
		$this->setQuery($q);
		if($this->runQuery($case)) {
			return true;
		} else {
			return false;
		}
	}

}
?>