<?php 
include_once ("../config.php");
include_once ("../global.php");
include_once ("../class/test_class.php");

if((isset($_REQUEST['flowtype'])) && (isset($_POST)))
{
	$Test = new Test();
	$flowtype = $_REQUEST['flowtype'];

	if(isset($_POST) && $flowtype == 1)
	{

		$study_material = $test_series = $online_portal = $ac = $wifi = $pick_and_drop = $library = 0;
		if(isset($_POST['study_material']) & $_POST['study_material']) {
			$study_material = 1;
		}
		if(isset($_POST['test_series']) & $_POST['test_series']) {
			$test_series = 1;
		}
		if(isset($_POST['online_portal']) & $_POST['online_portal']) {
			$online_portal = 1;
		}
		if(isset($_POST['ac']) & $_POST['ac']) {
			$ac = 1;
		}
		if(isset($_POST['wifi']) & $_POST['wifi']) {
			$wifi = 1;
		}
		if(isset($_POST['pick_and_drop']) & $_POST['pick_and_drop']) {
			$pick_and_drop = 1;
		}
		if(isset($_POST['library']) & $_POST['library']) {
			$library = 1;
		}

		$l_unique_url = $Test->getLocationMasterId($_POST['location_id']);
		$unique_url = $Test->seofriendlyurl($_POST['name'])."-".$l_unique_url;
		$Id = $Test->insertInstitute($_POST['parent_id'], $_POST['name'], $_POST['description'], $_POST['founded'], $_POST['working_days'], $_POST['website_url'], $_POST['fb_page_url'], $_POST['country_id'], $_POST['city_id'], $_POST['location_id'], $_POST['pincode'], $unique_url, $_POST['latitude'], $_POST['longitude'], $_POST['contact_email'], $_POST['contact_no'], $_POST['address'], $_POST['map_address'], $_POST['avg_no_batches'], $_POST['no_of_teachers'], $_POST['ratio'], $_POST['avg_teacher_exp'], $_POST['avg_batch_size']);
		if($Id) {
			$email = $Id."@gmail.com";
			$password = "12345";
			$USid = $Test->insertUser($Id, $email, $password, "", "", 1, 1, 1);
			$Aid = $Test->insertAmenities($Id, $study_material, $test_series, $online_portal, $ac, $wifi, $pick_and_drop, $library);

			/*------------------------------ Gallery Upload Code ---------------------*/
			$valid_formats = array("jpg", "png", "jpeg", "PNG", "JPG", "JPEG","gif","GIF");

			if(!empty($_FILES['image1']['name']) && !empty($_FILES['image1']['type']) && $_FILES['image1']['size'] > 0) {
				$i   = strrpos($_FILES['image1']['name'], ".");
				$l   = strlen($_FILES['image1']['name']) - $i;
      			$ext = substr($_FILES['image1']['name'], $i+1, $l);
      			if(in_array($ext, $valid_formats) && $_FILES['image1']['size'] < (20*1024*1024)) {
      				$Gid = $Test->getLastGalleryId();
      				$nextGID = $Gid + 1;
      				$imageName = 'image_'.$nextGID.'.'.$ext;
      				if(move_uploaded_file($_FILES['image1']['tmp_name'], ABS_I_IMG_DIR.'/'.$imageName)) {
      					$GIid = $Test->insertGallery($Id, 0, 1, 1, $imageName);
        			} else {
        				die('Fail upload folder with read access Image1');
        			}
      			}
			}

			if(!empty($_FILES['image2']['name']) && !empty($_FILES['image2']['type']) && $_FILES['image2']['size'] > 0) {
				$i   = strrpos($_FILES['image2']['name'], ".");
				$l   = strlen($_FILES['image2']['name']) - $i;
      			$ext = substr($_FILES['image2']['name'], $i+1, $l);
      			if(in_array($ext, $valid_formats) && $_FILES['image2']['size'] < (20*1024*1024)) {
      				$Gid = $Test->getLastGalleryId();
      				$nextGID = $Gid + 1;
      				$imageName = 'image_'.$nextGID.'.'.$ext;
      				if(move_uploaded_file($_FILES['image2']['tmp_name'], ABS_I_IMG_DIR.'/'.$imageName)) {
      					$GIid = $Test->insertGallery($Id, 0, 1, 0, $imageName);
        			} else {
        				die('Fail upload folder with read access Image2');
        			}
      			}
			}

			if(!empty($_FILES['image3']['name']) && !empty($_FILES['image3']['type']) && $_FILES['image3']['size'] > 0) {
				$i   = strrpos($_FILES['image3']['name'], ".");
				$l   = strlen($_FILES['image3']['name']) - $i;
      			$ext = substr($_FILES['image3']['name'], $i+1, $l);
      			if(in_array($ext, $valid_formats) && $_FILES['image3']['size'] < (20*1024*1024)) {
      				$Gid = $Test->getLastGalleryId();
      				$nextGID = $Gid + 1;
      				$imageName = 'image_'.$nextGID.'.'.$ext;
      				if(move_uploaded_file($_FILES['image3']['tmp_name'], ABS_I_IMG_DIR.'/'.$imageName)) {
      					$GIid = $Test->insertGallery($Id, 0, 1, 0, $imageName);
        			} else {
        				die('Fail upload folder with read access Image3');
        			}
      			}
			}

			if(!empty($_FILES['image4']['name']) && !empty($_FILES['image4']['type']) && $_FILES['image4']['size'] > 0) {
				$i   = strrpos($_FILES['image4']['name'], ".");
				$l   = strlen($_FILES['image4']['name']) - $i;
      			$ext = substr($_FILES['image4']['name'], $i+1, $l);
      			if(in_array($ext, $valid_formats) && $_FILES['image4']['size'] < (20*1024*1024)) {
      				$Gid = $Test->getLastGalleryId();
      				$nextGID = $Gid + 1;
      				$imageName = 'image_'.$nextGID.'.'.$ext;
      				if(move_uploaded_file($_FILES['image4']['tmp_name'], ABS_I_IMG_DIR.'/'.$imageName)) {
      					$GIid = $Test->insertGallery($Id, 0, 1, 0, $imageName);
        			} else {
        				die('Fail upload folder with read access Image4');
        			}
      			}
			}

			if(!empty($_FILES['image5']['name']) && !empty($_FILES['image5']['type']) && $_FILES['image5']['size'] > 0) {
				$i   = strrpos($_FILES['image5']['name'], ".");
				$l   = strlen($_FILES['image5']['name']) - $i;
      			$ext = substr($_FILES['image5']['name'], $i+1, $l);
      			if(in_array($ext, $valid_formats) && $_FILES['image5']['size'] < (20*1024*1024)) {
      				$Gid = $Test->getLastGalleryId();
      				$nextGID = $Gid + 1;
      				$imageName = 'image_'.$nextGID.'.'.$ext;
      				if(move_uploaded_file($_FILES['image5']['tmp_name'], ABS_I_IMG_DIR.'/'.$imageName)) {
      					$GIid = $Test->insertGallery($Id, 0, 1, 0, $imageName);
        			} else {
        				die('Fail upload folder with read access Image5');
        			}
      			}
			}

			if(!empty($_FILES['image6']['name']) && !empty($_FILES['image6']['type']) && $_FILES['image6']['size'] > 0) {
				$i   = strrpos($_FILES['image6']['name'], ".");
				$l   = strlen($_FILES['image6']['name']) - $i;
      			$ext = substr($_FILES['image6']['name'], $i+1, $l);
      			if(in_array($ext, $valid_formats) && $_FILES['image6']['size'] < (20*1024*1024)) {
      				$Gid = $Test->getLastGalleryId();
      				$nextGID = $Gid + 1;
      				$imageName = 'image_'.$nextGID.'.'.$ext;
      				if(move_uploaded_file($_FILES['image6']['tmp_name'], ABS_I_IMG_DIR.'/'.$imageName)) {
      					$GIid = $Test->insertGallery($Id, 0, 1, 0, $imageName);
        			} else {
        				die('Fail upload folder with read access Image6');
        			}
      			}
			}

			die('Instituate Inserted Successfully with Id: '.$Id.'& Amenities with Id: '.$Aid);
		
		} else {
			
			die('Error while Inserted Instituate.');
		
		}


	} elseif (isset($_POST) && $flowtype == 2) {

		$master_category_id = $Test->MasterCategoryId($_POST['child_category_id']);
		$Cid = $Test->insertCourse($master_category_id, $_POST['child_category_id'], $_POST['instituate_id'], $_POST['price'], $_POST['duration'], $_POST['avg_no_student'], $_POST['description'], $_POST['teaching_pattern']);
		if($Cid) {
			die('Course Inserted Successfully with Id: '.$Cid);
		} else {
			die('Error while Inserted Instituate.');
		}




	} elseif (isset($_POST) && $flowtype == 3) {

		$lastInsertTeacherDetail = $Test->getLastInsertTeacherInTable();
		preg_match('!\d+!', $lastInsertTeacherDetail['unique_url'], $getUrlId);
		$Id = intval($getUrlId[0]) + 1;
		$uniqueUrl = $Test->seofriendlyurl($_POST['first_name']).'-'.$Test->seofriendlyurl($_POST['last_name']).'-'.$Id;
		$Tid = $Test->insertTeacher($_POST['instituate_id'], $_POST['designation'], $_POST['first_name'], $_POST['last_name'], $_POST['experience'], $_POST['qualtification'], $_POST['age'], $_POST['gender'], $_POST['achivements'], $_POST['subject'], $_POST['fb_url'], $_POST['linkedin_url'], $_POST['yt_url'], $uniqueUrl);
		if($Tid) {
			die('Teacher Inserted Successfully with Id: '.$Tid);
		} else {
			die('Error while Inserted Instituate.');
		}


	} elseif (isset($_POST) && $flowtype == 4) {
		if(!empty($_POST['city'])) {
			$city = $Test->seofriendlyurl($_POST['city']);
			$cityArray = $Test->getCityMasterUrl($city);
			if(is_array($cityArray) && empty($cityArray)) {
				$Cid = $Test->insertCityMaster($_POST['country'], strtolower($_POST['city']), $city);
				if($Cid) {
					die('City Inserted Successfully with Id: '.$Cid);
				} else {
					die('Error while Inserted Instituate.');
				}
			} else {
				die('City already Exist.');
			}
		} else {
			die('City Empty.');
		}

	} elseif (isset($_POST) && $flowtype == 5) {
		if(!empty($_POST['location'])) {
			$cityArray = $Test->getCityUrl($_POST['city']);
			if(is_array($cityArray) && !empty($cityArray)) {
				$city = $cityArray['url'];
				$location = $Test->seofriendlyurl($_POST['location']);
				$l_url = $location."-".$city;
				$locationArray = $Test->getLocationMasterUrl($l_url);
				if(is_array($locationArray) && empty($locationArray)) {
					$Lid = $Test->insertLocationMaster($_POST['city'], $_POST['pincode'], strtolower($_POST['location']), $l_url);
					if($Lid) {
						die('Location Inserted Successfully with Id: '.$Lid);
					} else {
						die('Error while Inserted Instituate.');
					}
				} else {
					die('Location already Exist.');
				}
			} else {
				die('City Not Selected.');
			}
		} else {
			die('Location Empty');
		}
	}

} else {
	die('ASD');
}
        


