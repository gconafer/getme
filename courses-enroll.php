<?php
session_start();
/*-------------------     Include File Start      ---------------*/
include_once("config.php");
include_once("global.php");
include_once("./class/exam_class.php");
include_once("./class/courses_enroll_class.php");

/*-------------------     Include File End      ---------------*/

if(!isset($_SESSION['id']) || empty($_SESSION['id'])) {
    session_destroy();
    header("Location: ".LOGIN_URL);
    die();
}

/*-------------------     Class Object Start      ---------------*/

$Exam = new Exam();
$coursesEnroll = new Courses_Enroll();

/*-------------------     Class Object End      ---------------*/

$examArray = $Exam->getExamList();
$coursesEnrollArray = $coursesEnroll->getCoursesEnrollByStudent($_SESSION['id']);

/*-------------------     Include Header and Left Menu     ---------------*/

if(is_array($coursesEnrollArray) && !empty($coursesEnrollArray)) {
    $url = ABS_URL."/home";
    header("Location: ".$url);
    die();
}

?>

<!DOCTYPE html>
<html lang="en">
<!--[if IE 9 ]><html lang="en" class="ie9"><![endif]-->
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?=ABS_IMG_URL?>/favicon.ico?v=2" type="image/x-icon" />
    <!-- Material design colors -->
    <link href="<?=ABS_CSS_URL?>/material-design-iconic-font-min.css" rel="stylesheet">
    <!-- CSS animations -->
    <link rel="stylesheet" href="<?=ABS_CSS_URL?>/animate-min.css">
    <!-- Site -->
    <link rel="stylesheet" href="<?=ABS_CSS_URL?>/dashboard-app1-min.css">
    <link rel="stylesheet" href="<?=ABS_CSS_URL?>/dashboard-app2-min.css">
    <!-- jQuery -->
    <script src="<?=ABS_JS_URL?>/jquery-min.js"></script>
    <!-- Bootstrap -->
    <script src="<?=ABS_JS_URL?>/bootstrap-min.js"></script>


    <body>
        <header id="header-alt">
            <a href="#" class="header-alt__logo hidden-xs">Dashboard</a>
            <ul class="header-alt__menu">
                <li class="header-alt__profile dropdown">
                    <a href="#" data-toggle="dropdown">
                        <i class="zmdi zmdi-settings"></i>
                    </a>

                    <ul class="dropdown-menu pull-right">
                        <li><a href="<?=DASH_URL?>/controller/login_controller.php?flowtype=2">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </header>

		<main id="main" style="padding-top: 70px; padding-left: 0%;">
			<section id="main__content">
                <div class="main__container">
                	<header class="main__title">
                        <div class="row">
                            <div class="col-sm-6">
                                <h2>Enroll Into Courses</h2>
                                <small>Enroll into atleast into one course</small>
                            </div>
                            <div class="col-sm-6">
                                <a id="btnC" href="#" class="btn btn-danger btn-lg pull-right" disabled="disabled">
                                    Continue&nbsp;&nbsp;<i class="zmdi zmdi-caret-right zmdi-hc-lg"></i>
                                </a>
                            </div>
                        </div>
                    </header>
                    <br />
                    <br />
                    <div class="list-group list-group--block">
                    <?php foreach ($examArray as $key => $value) { ?>
                        <div class="list-group-item media">
                            <div class="media-body list-group__text">
                                <strong><h3><?=strtoupper($value['name'])?></h3></strong>
                                <div class="list-group__label list-group__label--float">
                                    <a id="<?=base64_encode($value['id'])?>" href="#" class="enrollCls btn btn-lg btn-info" data-toggle="tooltip" data-title="Click here to Enroll into course">Enroll</a>
                                </div>
                            </div>
                        </div>
                       <?php } ?>

                    </div>
                </div>
            </section>
            <footer style="padding: 25px 25px 5px 40%;text-align: left; border-top: 1px solid #eaeaea; color:#a2a2a2;"> Copyright © Ecoaching.guru</footer>
        </main>
        <script src="<?=ABS_JS_URL?>/dashboard-app-min.js"></script>
    
    </body>
    <div id="filter" style="opacity: 0; display: block;"></div>
</html>

<script type="text/javascript">

$(document).ready(function() {

    var abs_url = '<?=ABS_URL?>';
    $(document).on("click", ".enrollCls", function() {
        var thisObj = $(this);
    	var flowtype = 1;
        var id = thisObj.attr('id');
        if(!id) {
        	alert("Please choose atleast one course.");
        } else {
            $.post(abs_url+"/controller/dashboard_controller.php", {id:id, flowtype:flowtype},function(data) {
                var result = jQuery.parseJSON(data);
                if(result.status == 'success') {
                    thisObj.removeClass("enrollCls");
                    $("#btnC").removeAttr("disabled");
                    thisObj.html("<i class='zmdi zmdi-check-all'></i>Enrolled");
                    $("#btnC").attr("href", abs_url+"/home");
                } else {
                    alert("Something went wrong.");
                }
            });
        }
        return false;
    });
});    

</script>