<?php 
session_start();
include_once ("../config.php");
include_once("../global.php");
include_once("../class/courses_class.php");
include_once("../class/child_category_class.php");

if((isset($_REQUEST['flowtype'])) && (isset($_POST)) && (isset($_SESSION['id'])) && (isset($_SESSION['instituate_id'])))
{
	$Courses = new Courses();
	$flowtype = $_REQUEST['flowtype'];

	if(isset($_POST) && $flowtype == 1)
	{
		$childCategory = new Child_Category();
		if(isset($_POST['type']) && ($_POST['type'] == 'add' || $_POST['type'] == 'edit')) {
			$CourseId = base64_decode(trim($_POST['course_id']));
			$ChildCategoryArray = $childCategory->getDetailOfCategory($_POST['child_category_id']);
			if(is_array($ChildCategoryArray) && !empty($ChildCategoryArray)) {
				if($CourseId) {
					$CourseDetailArray = $Courses->getCourseDetail($_SESSION['instituate_id'], $CourseId);
					if(is_array($CourseDetailArray) && !empty($CourseDetailArray)) {
						$Cid = $Courses->updateCourse($CourseDetailArray['id'], $ChildCategoryArray['category_id'], $_POST['child_category_id'], $_POST['price'], $_POST['duration'], $_POST['avg_no_student'], $_POST['description'], $_POST['teaching_pattern']);
						if($Cid) {
							$array = array('status' => 'success');
						} else {
							$array = array('status' => 'error');
						}
					} else {
						$array = array('status' => 'error');
					}
				} else {
					$Cid = $Courses->insertCourse($ChildCategoryArray['category_id'], $_POST['child_category_id'], $_SESSION['instituate_id'], $_POST['price'], $_POST['duration'], $_POST['avg_no_student'], $_POST['description'], $_POST['teaching_pattern']);
					if($Cid) {
						$array = array('status' => 'success');
					} else {
						$array = array('status' => 'error');
					}
				}
			} else {
				$array = array('status' => 'error');
			}
		} else {
			$array = array('status' => 'error');
		}
		echo json_encode($array);
	} else if(isset($_POST) && $flowtype == 2) {

		if(isset($_POST['course_id']) && !empty($_POST['course_id'])) {
			$CourseId = base64_decode(trim($_POST['course_id']));
			$CourseDetailArray = $Courses->getCourseDetail($_SESSION['instituate_id'], $CourseId);
			if($CourseId && is_array($CourseDetailArray) && !empty($CourseDetailArray)) {
				$Cid = $Courses->deleteCourse($CourseDetailArray['id']);
				if($Cid) {
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
        


