<?php

include_once("meta_model.php");

class Join extends metaModel {
	public function __construct() {
		parent::__construct();
	}

	public function getInstituateCourseListLocationId($CategoryId, $LocationId, $OffSet, $RecordPerPage)
	{
		$q = "SELECT I.*, C.*, G.url as i_image_url FROM Instituate as I left join Courses as C on (I.id = C.instituate_id and I.status = 1 and C.status = 1) left join Gallery as G on (I.id = G.instituate_id and G.featured_status = 1 and G.status = 1 and G.type = 1) where I.location_id = ".$this->fix_for_mysqli($LocationId)." and C.child_category_id = ".$this->fix_for_mysqli($CategoryId)." order by I.id desc limit ".$this->fix_for_mysqli($OffSet).", ".$this->fix_for_mysqli($RecordPerPage);
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getTotalRecordInArray();
			return $result;
		} else {
			return array();
		}
	}

	public function getCountOfInstituateLocationId($CategoryId, $LocationId)
	{
		$q = "SELECT count(I.id) as count FROM Instituate as I left join Courses as C on (I.id = C.instituate_id and I.status = 1 and C.status = 1) left join Gallery as G on (I.id = G.instituate_id and G.featured_status = 1 and G.status = 1 and G.type = 1) where I.location_id = ".$this->fix_for_mysqli($LocationId)." and C.child_category_id = ".$this->fix_for_mysqli($CategoryId);
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result['count'];
		} else {
			return 0;
		}
	}

	public function getInstituateCourseListCityId($CategoryId, $CityId, $OffSet, $RecordPerPage)
	{
		$q = "SELECT I.*, C.*, G.url as i_image_url FROM Instituate as I left join Courses as C on (I.id = C.instituate_id and I.status = 1 and C.status = 1) left join Gallery as G on (I.id = G.instituate_id and G.featured_status = 1 and G.status = 1 and G.type = 1) where I.city_id = ".$this->fix_for_mysqli($CityId)." and C.child_category_id = ".$this->fix_for_mysqli($CategoryId)." order by I.id desc limit ".$this->fix_for_mysqli($OffSet).", ".$this->fix_for_mysqli($RecordPerPage);
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getTotalRecordInArray();
			return $result;
		} else {
			return array();
		}
	}

	public function getCountOfInstituateCityId($CategoryId, $CityId)
	{
		$q = "SELECT count(I.id) as count FROM Instituate as I left join Courses as C on (I.id = C.instituate_id and I.status = 1 and C.status = 1) left join Gallery as G on (I.id = G.instituate_id and G.featured_status = 1 and G.status = 1 and G.type = 1) where I.city_id = ".$this->fix_for_mysqli($CityId)." and C.child_category_id = ".$this->fix_for_mysqli($CategoryId);
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result['count'];
		} else {
			return 0;
		}
	}

	public function getIdOfLocationCityFromUrl($Url, $CountryId)
	{
		$q = "select C.id as cid, C.name as cname, C.url as curl, L.id as lid, L.name as lname, L.url as lurl, L.pincode as lpincode from City_Master as C left join Location_Master as L on (C.id = L.city_id) where (C.url = '".$this->fix_for_mysqli($Url)."' or L.url = '".$this->fix_for_mysqli($Url)."') and C.country_id = ".$this->fix_for_mysqli($CountryId);
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getTotalRecordInArray();
			return $result;
		} else {
			return array();
		}
	}

	public function getExamandSubjectFullDetails($subjectId, $examId)
	{
		$qu = " ";
		if($subjectId) $qu = "and ET.subject_id = ".$this->fix_for_mysqli($subjectId);

		$q = "SELECT COUNT(DISTINCT ST.id) as taken_count, COUNT(DISTINCT ET.id) as t_count, COUNT(DISTINCT EQ.id) as q_count, COUNT(DISTINCT ES.id) as s_count FROM Exam_Test as ET left join Exam_Question as EQ on (ET.id = EQ.test_id and EQ.status = 1) left join Exam_Subject as ES on (ET.exam_id = ES.exam_id and ES.status = 1) left join Student_Test as ST on (ET.id = ST.test_id) where ET.exam_id = ".$this->fix_for_mysqli($examId)."".$qu." and ET.status = 1";
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