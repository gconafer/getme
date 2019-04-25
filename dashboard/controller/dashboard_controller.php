<?php 
session_start();
include_once ("../config.php");
include_once("../global.php");
include_once("../class/amenities_class.php");
include_once("../class/instituate_class.php");
include_once("../class/location_master_class.php");

if((isset($_REQUEST['flowtype'])) && (isset($_POST)) && (isset($_SESSION['id'])) && (isset($_SESSION['instituate_id'])))
{

	$Instituate = new Instituate();
	$flowtype = $_REQUEST['flowtype'];

	if(isset($_POST) && $flowtype == 1)
	{
		$LocationMaster = new Location_Master();
		$Amenities = new Amenities();
		if(!empty(trim($_POST['name'])) && !empty(trim($_POST['contact_email'])) && !empty(trim($_POST['contact_no'])) && $_POST['country_id'] && $_POST['city_id'] && $_POST['location_id']) {
			$LocationArray = $LocationMaster->getDetailOfLocationByCityId($_POST['location_id'], $_POST['city_id']);
			if(is_array($LocationArray) && !empty($LocationArray)) {
				$Iid = $Instituate->updateInstitute($_SESSION['instituate_id'], $_POST['name'], $_POST['description'], $_POST['founded'], $_POST['working_days'], $_POST['country_id'], $_POST['city_id'], $_POST['location_id'], $LocationArray['pincode'], $_POST['contact_email'], $_POST['contact_no'], $_POST['address'], $_POST['website_url'], $_POST['fb_page_url'], $_POST['avg_no_batches'], $_POST['no_of_teachers'], $_POST['avg_teacher_exp'], $_POST['avg_batch_size']);
				$AmenitiesArray = $Amenities->getListOfAmenities($_SESSION['instituate_id']);
				if(is_array($AmenitiesArray) && !empty($AmenitiesArray)) {
					$Aid = $Amenities->updateAmenities($_SESSION['instituate_id'], $_POST['study_material'], $_POST['test_series'], $_POST['online_portal'], $_POST['ac'], $_POST['wifi'], $_POST['pick_and_drop'], $_POST['library']);
				} else {
					$Aid = $Amenities->insertAmenities($_SESSION['instituate_id'], $_POST['study_material'], $_POST['test_series'], $_POST['online_portal'], $_POST['ac'], $_POST['wifi'], $_POST['pick_and_drop'], $_POST['library']);
				}

				if($Iid && $Aid) {
					$array = array('status' => 'success');
				} else {
					$array = array('status' => 'error');
				}
			} else {
				$array = array('status' => 'error');
			}
		} else {
			$array = array('status' => 'error');
		}
		echo json_encode($array);

	} elseif (isset($_POST) && $flowtype == 2) {
		$LocationMaster = new Location_Master();
		if(isset($_POST['city_id']) && $_POST['city_id']) {
			$LocationArray = $LocationMaster->getListOfCityLocation($_POST['city_id']);
			if(is_array($LocationArray) && !empty($LocationArray)) {
				$array = array('status' => 'success', 'json' => json_encode($LocationArray));
			} else {
				$array = array('status' => 'error');
			}
		} else {
			$array = array('status' => 'error');
		}
		echo json_encode($array);

	} elseif (isset($_POST) && $flowtype == 3) {
		if(isset($_POST['lat']) && !empty($_POST['lat']) && isset($_POST['long']) && !empty($_POST['long'])) {
			$status = $Instituate->updateInstituteLatLong($_SESSION['instituate_id'], $_POST['lat'], $_POST['long']);
			if($status) {
				$array = array('status' => 'success');
			} else {
				$array = array('status' => 'error');
			}
		} else {
			$array = array('status' => 'error');
		}
		echo json_encode($array);

	}

} else {
	header("location:".DASH_URL);
	die();
}
        


