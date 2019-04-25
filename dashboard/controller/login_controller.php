<?php
session_start();
include_once ("../config.php");
include_once("../global.php");
include_once("../class/user_class.php");
include_once("../class/login_class.php");
include_once("../class/common_class.php");
include_once ("../class/send_email_class.php");
include_once ("../class/email_template_class.php");
include_once ("../class/forget_password_class.php");

if(isset($_REQUEST['flowtype']))
{
	$flowtype = $_REQUEST['flowtype'];

	if(isset($_POST) && $flowtype == 1)
	{

		$Login = new Login();
		if(isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])) {
			$userLogin = $Login->userLogin($_POST['email'], $_POST['password']);
			if(is_array($userLogin) && !empty($userLogin)) {
				$_SESSION["id"] = $userLogin['id'];
				$_SESSION["email"] = $userLogin['email'];
				$_SESSION["instituate_id"] = $userLogin['instituate_id'];
				$_SESSION["first_name"] = $userLogin['first_name'];
				$_SESSION["last_name"] = $userLogin['last_name'];
				$_SESSION["type"] = $userLogin['type'];
				$_SESSION["country_id"] = $userLogin['country_id'];
				$array = array('status' => 'success');
			} else {
				$array = array('status' => 'error');
			}
		} else {
			$array = array('status' => 'error');
		}
		echo json_encode($array);

	} elseif ($flowtype == 2) {
		session_destroy();
		header("location:".DASH_URL);
		die();
	} elseif (isset($_POST) && $flowtype == 3) {
		$User = new User();
		$Common = new Common();
		$emailTemplate = new Email_Template();
		$forgetPassword = new Forget_Password();
		$sendEmail = new Send_Email();
		if(isset($_POST['email']) && !empty($_POST['email'])) {
			if($Common->isValidEmail($_POST['email'])) {
				$userArray = $User->getUserByEmail($_POST['email']);
				if(is_array($userArray) && !empty($userArray)) {
					$forgetPasswordArray = $forgetPassword->insertForgetPassword($userArray['id'], 2, 0);
					if(is_array($forgetPasswordArray) && !empty($forgetPasswordArray)) {
						$key = md5($forgetPasswordArray['id']."@".$userArray['id']."@".$forgetPasswordArray['time']);
						$link = DASH_URL."/resetpassword?id=".base64_encode($forgetPasswordArray['id'])."&key=".$key;
						$forgetPasswordHtml = $emailTemplate->getForgotPasswordHtml($userArray['first_name'], $userArray['email'], $link);
						// Send Mail
						$sendEmail->isSMTP();
						$sendEmail->From = 'prashant@ecoaching.guru';
						$sendEmail->FromName = 'Prashant';
						$sendEmail->addAddress($userArray['email'], $userArray['first_name']);
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
	} elseif (isset($_POST) && $flowtype == 4) {
		$User = new User();
		$forgetPassword = new Forget_Password();
		if(isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['cpassword']) && !empty($_POST['cpassword'])) {
			if(trim($_POST['password']) == trim($_POST['cpassword'])) {
				if(isset($_POST['id']) && !empty($_POST['id']) && isset($_POST['key']) && !empty($_POST['key'])) {
					$forgetPasswordArray = $forgetPassword->getForgetPasswordById(base64_decode($_POST['id']));
					$key = md5($forgetPasswordArray['id']."@".$forgetPasswordArray['student_id']."@".$forgetPasswordArray['created_on']);
					if(is_array($forgetPasswordArray) && !empty($forgetPasswordArray) && ($key == $_POST['key'])) {
						$updatePasswordStatus = $User->updateUserPassword($forgetPasswordArray['student_id'], trim($_POST['password']));
						if($updatePasswordStatus) {
							$forgetPassword->updateForgetPassword(1, base64_decode($_POST['id']));
							$array = array('status' => 'success', 'msg' => 'Password changed Successfully. login to dashboard');
						} else {
							$array = array('status' => 'error', 'msg' => 'Something went wrong. please try again!');
						}
					} else {
						$array = array('status' => 'error', 'msg' => 'This url has been expire. please try again!');
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
	}

} else {
	header("location:".DASH_URL);
	die();
}
        


