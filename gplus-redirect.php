<?php
session_start();
include_once("config.php");
include_once("global.php");
include_once("./class/common_class.php");
include_once("./class/student_class.php");
require_once (ABS_DIR."/vendor/Google/autoload.php");

$client = new Google_Client();
$client->setClientId(GOOGLE_CLIENT_ID);
$client->setClientSecret(GOOGLE_SECRET);
$client->setRedirectUri(GPLUS_REDIRECT_URL);
$client->addScope("email");
$client->addScope("profile");

$service = new Google_Service_Oauth2($client);
$Common = new Common();
$Student = new Student();

if (isset($_GET['code']) && !empty($_GET['code'])) {
	$client->authenticate($_GET['code']);
    $access_token = $client->getAccessToken();
    $client->setAccessToken($access_token);

    $userArray = $service->userinfo->get();
	$userName = $userArray->name;
	$userEmail = $userArray->email;
	$userGender = $userArray->gender;
	$googlePlusLink = $userArray->link;
	$image = $userArray->picture;
	if($userGender == "male") $gender = 1; elseif ($userGender == "female") $gender = 2; else $gender = 0;

	$Id = 0;
	if(!empty($userEmail)) {
	    $studentArray = $Student->getStudentByEmail($userEmail);
	    if(is_array($studentArray) && !empty($studentArray)) {
	    	$Id = $studentArray['id'];
	        if(!empty($studentArray['image'])) $image = NULL;
	        if(!empty($studentArray['gender'])) $gender = NULL;  
	        $Student->updateStudent(NULL, NULL, NULL, NULL, NULL, $image, $gender, NULL, $googlePlusLink, 4, 1, $studentArray['id']);
	    } else {
	        $password = rand(10000, 100000);
	        $Id = $Student->insertStudent($userName, $userEmail, $password, 1, '', $image, $gender, '', $googlePlusLink, 4, 1);
	    }

	    if($Id > 0) {
		    $studentArray = $Student->getStudentById($Id);
			$_SESSION['id'] = $studentArray['id'];
			$_SESSION['email'] = $studentArray['email'];
			$_SESSION['name'] = $studentArray['name'];
			$_SESSION['type'] = $studentArray['type'];
			$_SESSION['email_status'] = $studentArray['email_status'];
			$_SESSION['status'] = $studentArray['status'];
			$url = ABS_URL.'/home';
	    	header("Location: $url");
	    	die();
	    } else {
	    	$url = ABS_URL.'/?error=1';
    		header("Location: $url");
    		die();
	    }
	}
} else {
    $url = ABS_URL.'/?error=1';
    header("Location: $url");
    die();
}



?>

