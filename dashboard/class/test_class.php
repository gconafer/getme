<?php

include_once("meta_model.php");

class Test extends metaModel {
	public function __construct() {
		parent::__construct();
	}

	public function seofriendlyurl($title) 
	{
		$title = preg_replace("!\s+!", " ", $title);
		$title = str_replace(" ","-",strtolower($title));
	    $title = str_replace('"','',strtolower($title));
	    $title = str_replace("'","",strtolower($title));
	    $title = str_replace("&","and",strtolower($title));
	    $title = str_replace(" ? ","-",strtolower($title));
	    $title = str_replace("?","-",strtolower($title));
	    $title = str_replace(":","",strtolower($title));
	    $title = str_replace(",","",strtolower($title));
	    $title = str_replace(";","",strtolower($title));
	    $title = str_replace(".","",strtolower($title));
	    $title = str_replace("(","",strtolower($title));
	    $title = str_replace(")","",strtolower($title));
	    $title = preg_replace("/-+/", "-", $title);
	    return $title;
	}



	public function getCountryList()
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

	public function getAllInstRecord()
	{
		$q = "select I.id, I.unique_url, LM.url from Instituate as I left join Location_Master as LM on (I.location_id = LM.id) where I.id > 41";
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getTotalRecordInArray();
			return $result;
		} else {
			return array();
		}
	}

	public function getAllImageRecord()
	{
		$q = "select I.id, I.image_url from Instituate as I left join Gallery as g on (I.id = g.instituate_id) where I.image_url != '' and g.id is null";
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getTotalRecordInArray();
			return $result;
		} else {
			return array();
		}
	}

	public function checkGallery($id)
	{
		$q = "select id from Gallery where type = 1 and featured_status = 1 and instituate_id = ".$this->fix_for_mysqli($id);
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result['id'];
		} else {
			return 0;
		}
	}

	public function getCityList()
	{
		$q = "select * from City_Master order by id desc";
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getTotalRecordInArray();
			return $result;
		} else {
			return array();
		}
	}


	public function getLocationList()
	{
		$q = "select LM.id, LM.name, LM.pincode, CM.name as cname from Location_Master as LM left join City_Master as CM on (LM.city_id = CM.id) order by id desc";
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getTotalRecordInArray();
			return $result;
		} else {
			return array();
		}
	}

	public function getCategoryMasterList()
	{
		$q = "select * from Category_Master";
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getTotalRecordInArray();
			return $result;
		} else {
			return array();
		}
	}

	public function getChildCategoryList()
	{
		$q = "select * from Child_Category";
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getTotalRecordInArray();
			return $result;
		} else {
			return array();
		}
	}

	public function getLastInstituteId()
	{
		$q = "select id from Instituate order by id desc limit 1";
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result['id'];
		} else {
			return array();
		}
	}

	public function MasterCategoryId($id)
	{
		$q = "select category_id from Child_Category where id = ".$this->fix_for_mysqli($id);
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result['category_id'];
		} else {
			return array();
		}
	}

	public function getLocationMasterId($id)
	{
		$q = "select url from Location_Master where id = ".$this->fix_for_mysqli($id);
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result['url'];
		} else {
			return array();
		}
	}

	public function getLastGalleryId()
	{
		$q = "select id from Gallery order by id desc limit 1";
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result['id'];
		} else {
			return array();
		}
	}

	public function getLastInsertTeacherInTable()
	{
		$q = "SELECT * FROM Teacher order by id desc";
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result;
		} else {
			return array();
		}
	}

	public function getlocationId($l_unique_url, $city_id)
	{
		$q = "SELECT * FROM Location_Master where url = '".$this->fix_for_mysqli($l_unique_url)."' and city_id = ".$this->fix_for_mysqli($city_id);
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result;
		} else {
			return array();
		}
	}

	public function checkUniqueUrl($l_unique_url)
	{
		$q = "SELECT * FROM Instituate where unique_url = '".$this->fix_for_mysqli($l_unique_url)."'";
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result;
		} else {
			return array();
		}
	}

	public function getCityUrl($city_id)
	{
		$q = "SELECT * FROM City_Master where id = '".$this->fix_for_mysqli($city_id)."'";
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result;
		} else {
			return array();
		}
	}


	public function checkCourseExist($instituate_id, $child_category_id)
	{
		$q = "SELECT * FROM Courses where instituate_id = '".$this->fix_for_mysqli($instituate_id)."' and child_category_id = ".$this->fix_for_mysqli($child_category_id);
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result['id'];
		} else {
			return 0;
		}
	}

	public function getInstituateList()
	{
		$q = "SELECT * FROM Instituate order by id desc";
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getTotalRecordInArray();
			return $result;
		} else {
			return array();
		}
	}



	public function insertInstitute($parent_id, $name, $description, $founded, $working_days, $website_url, $fb_page_url, $country_id, $city_id, $location_id, $pincode, $unique_url, $latitude, $longitude, $contact_email, $contact_no, $address, $map_address, $avg_no_batches, $no_of_teachers, $ratio, $avg_teacher_exp, $avg_batch_size, $logo=NULL, $test=NULL)
	{
		$case = "insert";
		$q = "Insert into Instituate set parent_id = '".$this->fix_for_mysqli($parent_id)."', name = '".$this->fix_for_mysqli($name)."', description = '".$this->fix_for_mysqli($description)."', founded = '".$this->fix_for_mysqli($founded)."', working_days = '".$this->fix_for_mysqli($working_days)."', website_url = '".$this->fix_for_mysqli($website_url)."', fb_page_url = '".$this->fix_for_mysqli($fb_page_url)."', country_id = '".$this->fix_for_mysqli($country_id)."', city_id = '".$this->fix_for_mysqli($city_id)."', location_id = '".$this->fix_for_mysqli($location_id)."', pincode = '".$this->fix_for_mysqli($pincode)."', unique_url = '".$this->fix_for_mysqli($unique_url)."', latitude = '".$this->fix_for_mysqli($latitude)."', longitude = '".$this->fix_for_mysqli($longitude)."', contact_email = '".$this->fix_for_mysqli($contact_email)."', contact_no = '".$this->fix_for_mysqli($contact_no)."', address = '".$this->fix_for_mysqli($address)."', map_address = '".$this->fix_for_mysqli($map_address)."', avg_no_batches = '".$this->fix_for_mysqli($avg_no_batches)."', no_of_teachers = '".$this->fix_for_mysqli($no_of_teachers)."', ratio = '".$this->fix_for_mysqli($ratio)."', avg_teacher_exp = '".$this->fix_for_mysqli($avg_teacher_exp)."', avg_batch_size = '".$this->fix_for_mysqli($avg_batch_size)."', status = 1, modified_on = '".date('Y-m-d H:i:s')."', created_on = '".date('Y-m-d H:i:s')."', image_url = '".$this->fix_for_mysqli($logo)."', test = '".$this->fix_for_mysqli($test)."'";
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

	public function insertUser($instituate_id, $email, $password, $first_name, $last_name, $type, $country_id, $status)
	{
		$case = "insert";
		$q = "Insert into User set instituate_id = '".$this->fix_for_mysqli($instituate_id)."', email = '".$this->fix_for_mysqli($email)."', password = '".$this->fix_for_mysqli($password)."', first_name = '".$this->fix_for_mysqli($first_name)."', last_name = '".$this->fix_for_mysqli($last_name)."', type = '".$this->fix_for_mysqli($type)."', country_id = '".$this->fix_for_mysqli($country_id)."', status = '".$this->fix_for_mysqli($status)."', modified_on = '".date('Y-m-d H:i:s')."', created_on = '".date('Y-m-d H:i:s')."'";
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

	public function insertAmenities($instituate_id, $study_material, $test_series, $online_portal, $ac, $wifi, $pick_and_drop, $library)
	{
		$case = "insert";
		$q = "Insert into Amenities set instituate_id = '".$this->fix_for_mysqli($instituate_id)."', study_material = '".$this->fix_for_mysqli($study_material)."', test_series = '".$this->fix_for_mysqli($test_series)."', online_portal = '".$this->fix_for_mysqli($online_portal)."', ac = '".$this->fix_for_mysqli($ac)."', wifi = '".$this->fix_for_mysqli($wifi)."', pick_and_drop = '".$this->fix_for_mysqli($pick_and_drop)."', library = '".$this->fix_for_mysqli($library)."', modified_on = '".date('Y-m-d H:i:s')."', created_on = '".date('Y-m-d H:i:s')."'";
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

	public function insertCourse($master_category_id, $child_category_id, $instituate_id, $price, $duration, $avg_no_student, $description, $teaching_pattern)
	{
		$case = "insert";
		$q = "Insert into Courses set master_category_id = '".$this->fix_for_mysqli($master_category_id)."', child_category_id = '".$this->fix_for_mysqli($child_category_id)."', instituate_id = '".$this->fix_for_mysqli($instituate_id)."', price = '".$this->fix_for_mysqli($price)."', duration = '".$this->fix_for_mysqli($duration)."', avg_no_student = '".$this->fix_for_mysqli($avg_no_student)."', description = '".$this->fix_for_mysqli($description)."', teaching_pattern = '".$this->fix_for_mysqli($teaching_pattern)."', status = 1, modified_on = '".date('Y-m-d H:i:s')."', created_on = '".date('Y-m-d H:i:s')."'";
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

	public function insertTeacher($instituate_id, $designation, $first_name, $last_name, $experience, $qualtification, $age, $gender, $achivements, $subject, $fb_url, $linkedin_url, $yt_url, $unique_url)
	{
		$case = "insert";
		$q = "Insert into Teacher set instituate_id = '".$this->fix_for_mysqli($instituate_id)."', designation = '".$this->fix_for_mysqli($designation)."', first_name = '".$this->fix_for_mysqli($first_name)."', last_name = '".$this->fix_for_mysqli($last_name)."', experience = '".$this->fix_for_mysqli($experience)."', qualtification = '".$this->fix_for_mysqli($qualtification)."', age = '".$this->fix_for_mysqli($age)."', gender = '".$this->fix_for_mysqli($gender)."', achivements = '".$this->fix_for_mysqli($achivements)."', subject = '".$this->fix_for_mysqli($subject)."', fb_url = '".$this->fix_for_mysqli($fb_url)."', linkedin_url = '".$this->fix_for_mysqli($linkedin_url)."', yt_url = '".$this->fix_for_mysqli($yt_url)."', unique_url = '".$this->fix_for_mysqli($unique_url)."', status = 1, modified_on = '".date('Y-m-d H:i:s')."', created_on = '".date('Y-m-d H:i:s')."'";
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

	public function insertGallery($instituate_id, $course_id, $type, $featured_status, $url)
	{
		$case = "insert";
		$q = "Insert into Gallery set instituate_id = '".$this->fix_for_mysqli($instituate_id)."', course_id = '".$this->fix_for_mysqli($course_id)."', type = '".$this->fix_for_mysqli($type)."', featured_status = '".$this->fix_for_mysqli($featured_status)."', url = '".$this->fix_for_mysqli($url)."', status = 1, modified_on = '".date('Y-m-d H:i:s')."', created_on = '".date('Y-m-d H:i:s')."'";
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

	public function insertLocationMaster($e_city_id, $pincode, $locality, $l_unique_url)
	{
		$case = "insert";
		$q = "Insert into Location_Master set country_id = 1, city_id = '".$this->fix_for_mysqli($e_city_id)."', pincode = '".$this->fix_for_mysqli($pincode)."', name = '".$this->fix_for_mysqli($locality)."', url = '".$this->fix_for_mysqli($l_unique_url)."'";
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

	public function updateInstitute($id, $unique_url)
	{
		$case = "update";
		$q = "Update Instituate set unique_url = '".$this->fix_for_mysqli($unique_url)."' where id = ".$this->fix_for_mysqli($id);
		$this->setQuery($q);
		if($this->runQuery($case)) {
			return true;
		} else {
			return false;
		}
	}

	public function insertCityMaster($country_id, $name, $url)
	{
		$case = "insert";
		$q = "Insert into City_Master set country_id = '".$this->fix_for_mysqli($country_id)."', name = '".$this->fix_for_mysqli($name)."', url = '".$this->fix_for_mysqli($url)."'";
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

	public function getCityMasterUrl($url)
	{
		$q = "SELECT * FROM City_Master where url = '".$this->fix_for_mysqli($url)."'";
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result;
		} else {
			return array();
		}
	}

	public function getLocationMasterUrl($url)
	{
		$q = "SELECT * FROM Location_Master where url = '".$this->fix_for_mysqli($url)."'";
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result;
		} else {
			return array();
		}
	}

	public function getDuplicateUrl() {
		$q = "SELECT count(id) as count, url FROM Location_Master group by url having count > 1";
		$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getTotalRecordInArray();
			return $result;
		} else {
			return array();
		}

	}

	public function getOtherValue($url) {
		$q = "SELECT LM.id, LM.url as lurl, CM.url as curl FROM Location_Master as LM left join City_Master as CM on (LM.city_id = CM.id) where LM.url = '".$this->fix_for_mysqli($url)."' limit 1, 20";
		$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getTotalRecordInArray();
			return $result;
		} else {
			return array();
		}

	}

	public function updateLMUrl($id, $url)
	{
		$case = "update";
		$q = "Update Location_Master set url = '".$this->fix_for_mysqli($url)."' where id = ".$this->fix_for_mysqli($id);
		$this->setQuery($q);
		if($this->runQuery($case)) {
			return true;
		} else {
			return false;
		}
	}


}
?>