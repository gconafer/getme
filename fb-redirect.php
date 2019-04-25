<?php
session_start();
include_once("config.php");
include_once("global.php");
include_once("./class/common_class.php");
include_once("./class/student_class.php");
require_once(ABS_DIR."/vendor/facebook-sdk-v5/autoload.php");

$fb = new Facebook\Facebook([
  'app_id' => FB_APP_ID,
  'app_secret' => FB_APP_SECRET,
  'default_graph_version' => 'v2.5',
]);

$helper = $fb->getRedirectLoginHelper();
$Common = new Common();
$Student = new Student();

if(isset($_GET['code'])) {

    try {
        $accessToken = $helper->getAccessToken();
        $response = $fb->get('/me?fields=id,name,email,gender,link,picture', $accessToken);
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
        $url = ABS_URL.'/?error=2';
        header("Location: $url");
        die();
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
        $url = ABS_URL.'/?error=2';
        header("Location: $url");
        die();
    }
     
    $user = $response->getGraphUser();
    $userName = $user['name'];
    $userEmail = $user['email'];
    $userGender = $user['gender'];
    $fbLink = $user['link'];
    $image = $user['picture']['url'];
    if($userGender == "male") $gender = 1; elseif ($userGender == "female") $gender = 2; else $gender = 0;

    $Id = 0;
    if(!empty($userEmail)) {
        $studentArray = $Student->getStudentByEmail($userEmail);
        if(is_array($studentArray) && !empty($studentArray)) {
            $Id = $studentArray['id'];
            if(!empty($studentArray['image'])) $image = NULL;
            if(!empty($studentArray['gender'])) $gender = NULL;  
            $Student->updateStudent(NULL, NULL, NULL, NULL, NULL, $image, $gender, $fbLink, '', 3, 1, $studentArray['id']);
        } else {
            $password = rand(10000, 100000);
            $Id = $Student->insertStudent($userName, $userEmail, $password, 1, '', $image, $gender, $fbLink, '', 3, 1);
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
            $url = ABS_URL.'/?error=2';
            header("Location: $url");
            die();
        }
    }
} else {
    $url = ABS_URL.'/?error=2';
    header("Location: $url");
    die();
}
?>

