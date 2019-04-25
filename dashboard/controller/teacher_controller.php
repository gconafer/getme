<?php 
session_start();
include_once ("../config.php");
include_once("../global.php");
include_once("../class/common_class.php");
include_once("../class/teacher_class.php");

if((isset($_REQUEST['flowtype'])) && (isset($_POST)) && (isset($_SESSION['id'])) && (isset($_SESSION['instituate_id'])))
{
	$flowtype = $_REQUEST['flowtype'];

	if(isset($_POST) && $flowtype == 1)
	{

		$Teacher = new Teacher();
		$Common = new Common();
		if(isset($_POST['type']) && ($_POST['type'] == 'add' || $_POST['type'] == 'edit')) {
			$TeacherId = base64_decode(trim($_POST['teacher_id']));
			if($TeacherId) {
				$TeacherDetailArray = $Teacher->getTeacherDetail($_SESSION['instituate_id'], $TeacherId);
				if(is_array($TeacherDetailArray) && !empty($TeacherDetailArray)) {
					$Tid = $Teacher->updateTeacher($TeacherDetailArray['id'], $_POST['designation'], $_POST['first_name'], $_POST['last_name'], $_POST['experience'], $_POST['qualtification'], $_POST['age'], $_POST['gender'], $_POST['achivements'], $_POST['subject'], $_POST['fb_url'], $_POST['linkedin_url'], $_POST['yt_url']);
					if($Tid) {
						$array = array('status' => 'success');
					} else {
						$array = array('status' => 'error');
					}
				} else {
					$array = array('status' => 'error');
				}
			} else {
				$lastInsertTeacherDetail = $Teacher->getLastInsertTeacherInTable();
				preg_match('!\d+!', $lastInsertTeacherDetail['unique_url'], $getUrlId);
				$Id = intval($getUrlId[0]) + 1;
				$uniqueUrl = $Common->seofriendlyurl($_POST['first_name']).'-'.$Common->seofriendlyurl($_POST['last_name']).'-'.$Id;
				$Tid = $Teacher->insertTeacher($_SESSION['instituate_id'], $_POST['designation'], $_POST['first_name'], $_POST['last_name'], $_POST['experience'], $_POST['qualtification'], $_POST['age'], $_POST['gender'], $_POST['achivements'], $_POST['subject'], $_POST['fb_url'], $_POST['linkedin_url'], $_POST['yt_url'], $uniqueUrl);
				if($Tid) {
					$array = array('status' => 'success');
				} else {
					$array = array('status' => 'error');
				}
			}
		} else {
			$array = array('status' => 'error');
		}
		echo json_encode($array);
	} else if(isset($_POST) && $flowtype == 2) {

		$Teacher = new Teacher();
		if(isset($_POST['teacher_id']) && !empty($_POST['teacher_id'])) {
			$TeacherId = base64_decode(trim($_POST['teacher_id']));
			$TeacherDetailArray = $Teacher->getTeacherDetail($_SESSION['instituate_id'], $TeacherId);
			if($TeacherId && is_array($TeacherDetailArray) && !empty($TeacherDetailArray)) {
				$Tid = $Teacher->deleteTeacher($TeacherDetailArray['id']);
				if($Tid) {
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
	}

} else {
	header("location:".DASH_URL);
	die();
}
        


