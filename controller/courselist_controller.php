<?php 
include_once ("../config.php");

if(isset($_REQUEST['flowtype']))
{
	$flowtype = $_REQUEST['flowtype'];
	if(isset($_POST) && $flowtype==1){
		$email=$_POST['email'];
		$password=$_POST['password'];
		$cpassword=$_POST['cpassword'];
		if(isValidEmail($email)){
			if($password==$cpassword){
				$userStatus=$userObj->checkEmailExits($email);
				if(!$userStatus){
					$userAddStatus=$userObj->addNewUser($email,$password);
					if($userAddStatus){
						$html=getWelcomeMailHtml($email,$password);
						$subject="Welcome to vidooly";
						sendMailByManDrill($email,'', $subject, $html,$html);
						$url=ABS_URL.'/dashboard';
						header("Location: $url");
						die();
					}
				}else{
					$url=ABS_URL.'/register?error=2';
					header("Location: $url");
					die();
				}
			}else{
				$url=ABS_URL.'/register?error=4';
				header("Location: $url");
				die();
			}

		}else{
			$url=ABS_URL.'/register?error=3';
			header("Location: $url");
			die();
		}
		$url=ABS_URL.'/register?error=1';
		header("Location: $url");
		die();

	}

} else {
	header("location:".ABS_URL."/");
	die();
}
        


