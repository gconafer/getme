<?php
define('COUNTRY_ID', 1);
if(isset($_COOKIE['city_id'])) {
	$POP_UP = 0;
	$cityId = base64_decode($_COOKIE['city_id']);
	define('CITY_ID', $cityId);
} else {
	$POP_UP = 1;
	define('CITY_ID', 1);
}

define('MAIN_URL', ABS_URL.'/coaching-institutes');
define('ABS_JS_URL', ABS_URL.'/assets/js');
define('ABS_CSS_URL', ABS_URL.'/assets/css');
define('ABS_IMG_URL', ABS_URL.'/assets/img');
define('ABS_ICON_URL', ABS_URL.'/assets/img/icon');
define('ABS_C_IMG_URL', DASH_URL.'/assets/img/courses_image');
define('ABS_T_IMG_URL', DASH_URL.'/assets/img/teacher_image');
define('ABS_I_IMG_URL', DASH_URL.'/assets/img/instituate_image');
define('URL_DEFINE', '-coaching');
define('RECORD_PER_PAGE', 10);
define('BLOG_URL', ABS_URL.'/blog');
define('LOGIN_URL', ABS_URL);

// SMTP Credential
define('SMTP_PORT', 465);
define('SMTP_HOST', 'tls://email-smtp.us-west-2.amazonaws.com');
define('SMTP_USERNAME', 'AKIAJOYKO3E6TGPKPWCA');
define('SMTP_PASSWORD', 'Ar53Fh15H9ts2wgtGh14/XEzv7xmSO73GvIEuU5uanLj');

$AVTAR_IMG_Array = array('red', 'orange', 'teal', 'pink', 'blue', 'amber', 'light-blue', 'light-green', 'brown', 'blue-grey');
$TEST_LEVEL = array(1 => 'Easy', 2 => 'Medium', 3 => 'Hard');
$VALID_FORMATS = array("jpg", "jpeg", "JPG", "JPEG","gif","GIF");
?>