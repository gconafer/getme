<?php 
session_start();
include_once ("../config.php");
include_once("../global.php");
include_once("../class/courses_enroll_class.php");

if((isset($_REQUEST['flowtype'])) && (isset($_POST)) && (isset($_SESSION['id'])))
{
	$flowtype = $_REQUEST['flowtype'];

	if(isset($_POST) && $flowtype == 1)
	{
		
		$Id = 0;
		$coursesEnroll = new Courses_Enroll();
		if(isset($_POST['id']) && $_POST['id']) {
			$courseEnrollArray = $coursesEnroll->getCoursesEnrollByStudent($_SESSION['id']);
			if(is_array($courseEnrollArray) && !empty($courseEnrollArray)) {
				$Id = $coursesEnroll->insertCourseEnroll($_SESSION['id'], base64_decode($_POST['id']), 0, 1);
			} else {
				$Id = $coursesEnroll->insertCourseEnroll($_SESSION['id'], base64_decode($_POST['id']), 1, 1);
			}

			if($Id) {
				$array = array('status' => 'success');
			} else {
				$array = array('status' => 'error1');
			}
		} else {
			$array = array('status' => 'error2');
		}
		echo json_encode($array);
	}

} else {
	header("location:".ABS_URL."/");
	die();
}
        


