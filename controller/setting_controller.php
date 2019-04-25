<?php 
session_start();
include_once ("../config.php");
include_once("../global.php");
include_once("../class/student_class.php");

if((isset($_REQUEST['flowtype'])) && (isset($_POST)) && (isset($_SESSION['id'])))
{
	$flowtype = $_REQUEST['flowtype'];

	if(isset($_POST) && $flowtype == 1)
	{
		$Student = new Student();
		if(isset($_POST['old_password']) && isset($_POST['new_password']) && isset($_POST['c_password']) && !empty($_POST['old_password']) && !empty($_POST['new_password']) && !empty($_POST['c_password'])) {
			if(trim($_POST['new_password']) == trim($_POST['c_password'])) {
				$passArray = $Student->checkOldPassword($_SESSION['id'], trim($_POST['old_password']));
				if(is_array($passArray) && !empty($passArray)) {
					$passStatus = $Student->updateUserPassword($_SESSION['id'], trim($_POST['new_password']));
					if($passStatus) {
						$array = array('status' => 'success', 'msg' => 'Password update successfully');
					} else {
						$array = array('status' => 'error', 'msg' => 'Something Went Wrong. Please try again');
					}
				} else {
					$array = array('status' => 'error', 'msg' => 'Old Password does not match');
				}
			} else {
				$array = array('status' => 'error', 'msg' => 'New password and Confirm password does not match');
			}
		} else {
			$array = array('status' => 'error', 'msg' => 'Something Went Wrong. Please try again');
		}
		echo json_encode($array);

	}

} else {
	header("location:".DASH_URL);
	die();
}
        


