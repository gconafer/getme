<?php 
include_once ("../config.php");
include_once("../global.php");
include_once("../class/child_category_class.php");
include_once ("../class/location_master_class.php");

if((isset($_REQUEST['flowtype'])) && (isset($_POST)))
{
	$flowtype = $_REQUEST['flowtype'];

	if(isset($_POST) && $flowtype == 1)
	{

		$childCategory = new Child_Category();
		$locationMaster = new Location_Master();
		$category_id = $_POST['category_id'];
		$location_id = $_POST['location_id'];

		if(isset($location_id) && isset($category_id) && $location_id && $category_id)
		{
			$categoryArray = $childCategory->getDetailOfCategory($category_id);
			$locationArray = $locationMaster->getDetailOfLocation($location_id);
			if(!empty($categoryArray) && !empty($locationArray)) 
			{
				$url = MAIN_URL.'/'.$categoryArray['url'].URL_DEFINE.'-in-'.$locationArray['url'];
			} else {
				$url = ABS_URL;	
			}
		} else {
			$url = ABS_URL;
		}
		header("Location: $url");
		die();
	}

} else {
	header("location:".ABS_URL);
	die();
}
        


