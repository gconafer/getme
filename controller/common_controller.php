<?php 
session_start();
include_once ("../config.php");
include_once("../global.php");
include_once("../class/common_class.php");
include_once("../class/student_class.php");
include_once ("../class/enquiry_class.php");
include_once ("../class/send_email_class.php");
include_once ("../class/email_template_class.php");
include_once ("../class/forget_password_class.php");

if((isset($_REQUEST['flowtype'])) && (isset($_POST)))
{
	$flowtype = $_REQUEST['flowtype'];

	if(isset($_POST) && $flowtype == 1)
	{
		
		$Enquiry = new Enquiry();
		if(isset($_POST) && !empty($_POST) && isset($_POST['type']) && $_POST['type'] && isset($_POST['flowtype']) && $_POST['flowtype']) {
        	$status = $Enquiry->insertEnquiry($_POST['name'], $_POST['email'], $_POST['contact_no'], $_POST['flowtype'], $_POST['type'], $_POST['instituate_id'], $_POST['category_id'], $_POST['location_id'], $_POST['value1'], $_POST['value2'], $_POST['value3']);
        	$array = array('status' => 'success');
		} else {
			$array = array('status' => 'error');
		}
		echo json_encode($array);
	} elseif (isset($_POST) && $flowtype == 2) {
		if(isset($_POST['city_id']) && !empty($_POST['city_id'])) {
			setcookie("city_id", $_POST['city_id'], time() + (86400 * 30), "/");
			$array = array('status' => 'success');
		} else {
			$array = array('status' => 'error');
		}
		echo json_encode($array);
	} elseif (isset($_POST) && $flowtype == 3) {
		$Student = new Student();
		$Common = new Common();
		if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password'])) {
			if($Common->isValidEmail($_POST['email'])) {
				$studentArray = $Student->getStudentByEmailAndPassword($_POST['email'], $_POST['password'], $_POST['type']);
				if(is_array($studentArray) && !empty($studentArray)) {
					$_SESSION['id'] = $studentArray['id'];
					$_SESSION['email'] = $studentArray['email'];
					$_SESSION['name'] = $studentArray['firstName'];
					$_SESSION['type'] = $_POST['type'];
					$array = array('status' => 'success', 'msg' => 'Login Successfully');
				} else {
					$array = array('status' => 'error', 'msg' => 'Email and Password does not match');
				}
			} else {
				$array = array('status' => 'error', 'msg' => 'Please enter valid email');
			}
		} else {
			$array = array('status' => 'error', 'msg' => 'Please enter valid email/password');
		}
		echo json_encode($array);
	} elseif (isset($_POST) && $flowtype == 4) {
		$Student = new Student();
		$Common = new Common();
		if(isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['cpassword']) && !empty($_POST['cpassword'])) {
			if(trim($_POST['password']) == trim($_POST['cpassword'])) {
				if($Common->isValidEmail($_POST['email'])) {
					$studentArray = $Student->getStudentByEmail($_POST['email'], $_POST['type']);
					if(is_array($studentArray) && empty($studentArray)) {
						$Id = $Student->insertStudent($_POST['name'], $_POST['email'], trim($_POST['password']), $_POST['type']);
						if($Id > 0) {
							$studentArray = $Student->getStudentById($Id, $_POST['type']);
							$_SESSION['id'] = $studentArray['id'];
							$_SESSION['email'] = $studentArray['email'];
							$_SESSION['name'] = $studentArray['name'];
							$_SESSION['type'] = $_POST['type'];
							$array = array('status' => 'success', 'msg' => 'Register Successfully!');
						} else {
							$array = array('status' => 'error', 'msg' => 'Something went wrong. please try again!');
						}
					} else {
						$array = array('status' => 'error', 'msg' => 'Already registered! Forgot Password?');
					}
				} else {
					$array = array('status' => 'error', 'msg' => 'Please enter valid email');
				}
			} else {
				$array = array('status' => 'error', 'msg' => 'Password and confirm password does not match');
			}
		} else {
			$array = array('status' => 'error', 'msg' => 'Please enter name or email/password');
		}
		echo json_encode($array);
	} elseif (isset($_POST) && $flowtype == 5) {
		$Common = new Common();
		$Student = new Student();
		$emailTemplate = new Email_Template();
		$forgetPassword = new Forget_Password();
		$sendEmail = new Send_Email();
		if(isset($_POST['email']) && !empty($_POST['email'])) {
			if($Common->isValidEmail($_POST['email'])) {
				$studentArray = $Student->getStudentByEmail($_POST['email']);
				if(is_array($studentArray) && !empty($studentArray)) {
					$forgetPasswordArray = $forgetPassword->insertForgetPassword($studentArray['id'], 1, 0);
					if(is_array($forgetPasswordArray) && !empty($forgetPasswordArray)) {
						$key = md5($forgetPasswordArray['id']."@".$studentArray['id']."@".$forgetPasswordArray['time']);
						$link = ABS_URL."/resetpassword?id=".base64_encode($forgetPasswordArray['id'])."&key=".$key;
						$forgetPasswordHtml = $emailTemplate->getForgotPasswordHtml($studentArray['name'], $studentArray['email'], $link);
						// Send Mail
						$sendEmail->isSMTP();
						$sendEmail->From = 'prashant@ecoaching.guru';
						$sendEmail->FromName = 'Prashant';
						$sendEmail->addAddress($studentArray['email'], $studentArray['name']);
						$sendEmail->Subject = 'Ecoaching.guru: Reset Your Password';
						$sendEmail->Body = $forgetPasswordHtml;
						$sendEmail->IsHTML(true);
						if($sendEmail->send()) {
							$array = array('status' => 'success', 'msg' => 'A link to reset password has been sent to '.$_POST['email'].'. Please check your inbox.');
						} else {
							$array = array('status' => 'error', 'msg' => 'Something went wrong. please try again.');
						}
					} else {
						$array = array('status' => 'error', 'msg' => 'Something went wrong. please try again.');
					}
				} else {
					$array = array('status' => 'error', 'msg' => 'This email is not registered with us. Please recheck or create a new account.');
				}
			} else {
				$array = array('status' => 'error', 'msg' => 'Please enter valid email');
			}
		} else {
			$array = array('status' => 'error', 'msg' => 'Please enter email');
		}
		echo json_encode($array);
	} elseif (isset($_POST) && $flowtype == 6) {
		$Student = new Student();
		$forgetPassword = new Forget_Password();
		if(isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['cpassword']) && !empty($_POST['cpassword'])) {
			if(trim($_POST['password']) == trim($_POST['cpassword'])) {
				if(isset($_POST['id']) && !empty($_POST['id']) && isset($_POST['key']) && !empty($_POST['key'])) {
					$forgetPasswordArray = $forgetPassword->getForgetPasswordById(base64_decode($_POST['id']));
					$key = md5($forgetPasswordArray['id']."@".$forgetPasswordArray['student_id']."@".$forgetPasswordArray['created_on']);
					if(is_array($forgetPasswordArray) && !empty($forgetPasswordArray) && ($key == $_POST['key'])) {
						$updatePasswordStatus = $Student->updateStudentPassword(trim($_POST['password']), $forgetPasswordArray['student_id']);
						if($updatePasswordStatus) {
							$forgetPassword->updateForgetPassword(1, base64_decode($_POST['id']));
							$array = array('status' => 'success', 'msg' => 'Password changed Successfully. login to dashboard');
						} else {
							$array = array('status' => 'error', 'msg' => 'Something went wrong. please try again!');
						}
					} else {
						$array = array('status' => 'error', 'msg' => 'Something went wrong. please try again!');
					}
				} else {
					$array = array('status' => 'error', 'msg' => 'Something went wrong. please try again!');
				}
			} else {
				$array = array('status' => 'error', 'msg' => 'Password and confirm password does not match');
			}
		} else {
			$array = array('status' => 'error', 'msg' => 'Please enter password or confirm password');
		}
		echo json_encode($array);
	} elseif (isset($_POST) && $flowtype == 7) {
		$Student = new Student();
		$update = $Student->formOne($_SESSION['id'], $_POST['pphone'],  $_POST['sname'], $_POST['website'], $_POST['cofounder'], $_POST['member']);
		if ($update) {
			$array = array('status' => 'success');
		} else {
			$array = array('status' => 'error');
		}
		echo json_encode($array);
	}

} else {
	header("location:".ABS_URL."/");
	die();
}
        


