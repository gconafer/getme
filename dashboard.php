<?php
session_start();
/*-------------------     Include File Start      ---------------*/
include_once("config.php");
include_once("global.php");
include_once("./class/join_class.php");
include_once("./class/exam_class.php");
include_once("./class/exam_subject_class.php");
include_once("./class/courses_enroll_class.php");

/*-------------------     Include File End      ---------------*/

if(!isset($_SESSION['id']) || empty($_SESSION['id'])) {
    session_destroy();
    header("Location: ".LOGIN_URL);
    die();
}

/*-------------------     Class Object Start      ---------------*/

$Join = new Join();
$Exam = new Exam();
$examSubject = new Exam_Subject();
$coursesEnroll = new Courses_Enroll();

/*-------------------     Class Object End      ---------------*/

if(isset($_GET['q']) && !empty($_GET['q'])) {
    $coursesEnrollArray = $Exam->getExamDetailByUrl(trim($_GET['q']));
} else {
    $coursesEnrollArray = $coursesEnroll->getCoursesEnrollByStudent($_SESSION['id']);
}

$examDetailArray = $Join->getExamandSubjectFullDetails(0, $coursesEnrollArray['id']);
$examSubjectArray = $examSubject->getSubjectByExamId($coursesEnrollArray['id']);
$examListByEnrolled = $Exam->getExamListByEnrolledStudentId($_SESSION['id']);

/*-------------------     Include Header and Left Menu     ---------------*/

if(is_array($coursesEnrollArray) && empty($coursesEnrollArray)) {
	$url = ABS_URL."/courses-enroll";
	header("Location: ".$url);
    die();
}

include_once("layout/dashboard-header.php");
include_once("layout/dashboard-left-menu.php");
?>

<section id="main__content">
	<div class="main__container">
		<ul class="card breadcrumb">
  			<li><a href="<?=ABS_URL?>/home">Home</a></li>
  			<li><?=ucwords($coursesEnrollArray['name'])?></li>
		</ul>
		<br />
	    <header class="main__title">
	        <h2><?=ucwords($coursesEnrollArray['name'])?></h2>
	        <small><?=ucwords($coursesEnrollArray['title'])?></small>
	    </header>

    	<div class="card__sub row rmd-stats">
       		<div class="col-xs-3">
        		<div class="rmd-stats__item mdc-bg-red-400">
                    <h2><?=$examDetailArray['t_count']?></h2>
                    <small>Total Test</small>
                </div>
            </div>
            <div class="col-xs-3">
        		<div class="rmd-stats__item mdc-bg-green-400">
                    <h2><?=$examDetailArray['q_count']?></h2>
                    <small>Total Questions</small>
                </div>
            </div>
            <div class="col-xs-3">
        		<div class="rmd-stats__item mdc-bg-teal-400">
                    <h2><?=$examDetailArray['taken_count']?></h2>
                    <small>Test Taken</small>
                </div>
            </div>
            <div class="col-xs-3">
        		<div class="rmd-stats__item mdc-bg-blue-400">
                    <h2><?=$examDetailArray['s_count']?></h2>
                    <small>Total Subject</small>
                </div>
            </div>
        </div>

        <div class="row">
        	<div class="col-sm-6">
                <div class="card">
                    <div class="card__header">
                        <h2>Subject List</h2>
                        <small><?=ucwords($coursesEnrollArray['name'])?> Course</small>
                    </div>

                    <div class="list-group list-group--block">
                    <?php foreach ($examSubjectArray as $key => $value) { ?>
                        <div class="list-group-item media">
                            <div class="media-body list-group__text">
                                <strong><h3><?=ucwords($value['name'])?></h3></strong>
                                <div class="list-group__label list-group__label--float">
                                    <a href="<?=ABS_URL?>/home/<?=$coursesEnrollArray['url']?>/<?=$value['id']?>" class="btn btn-danger btn-lg pull-right">
                                        Take Test&nbsp;&nbsp;<i class="zmdi zmdi-caret-right zmdi-hc-lg"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card">
                    <div class="card__header">
                        <h2>Course List</h2>
                    </div>

                    <div class="list-group">
                    <?php foreach ($examListByEnrolled as $key => $value) { 
                            if($value['status'] == 1) { 
                                $string = "Click here to Enroll into course"; $class = " "; $q = "<i class='zmdi zmdi-check-all'></i>Enrolled"; 
                            } else { 
                                $string = "Enrolled"; $class = "enrollCls "; $q = "Enroll"; 
                            } 
                    ?>
                        <div class="list-group-item media">
                            <div class="media-body list-group__text">
                                <strong><h3><?=ucwords($value['name'])?></h3></strong>
                                <div class="list-group__label list-group__label--float">
                                    <a id="<?=base64_encode($value['id'])?>" href="#" class="<?=$class?>btn btn-lg btn-info" data-toggle="tooltip" data-title="<?=$string?>"><?=$q?></a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    </div>
                </div>
            </div>
        </div>

 	</div>
</section>

<script type="text/javascript">

$(document).ready(function() {

    var abs_url = '<?=ABS_URL?>';
    $(document).on("click", ".enrollCls", function() {
        var thisObj = $(this);
        var flowtype = 1;
        var id = thisObj.attr('id');
        if(!id) {
            alert("Something went wrong. Please try again.");
        } else {
            $.post(abs_url+"/controller/dashboard_controller.php", {id:id, flowtype:flowtype},function(data) {
                var result = jQuery.parseJSON(data);
                if(result.status == 'success') {
                    thisObj.removeClass("enrollCls");
                    thisObj.html("<i class='zmdi zmdi-check-all'></i>Enrolled");
                } else {
                    alert("Something went wrong. Please try again.");
                }
            });
        }
        return false;
    });
});    

</script>
            
<?php include_once("layout/dashboard-footer.php"); ?>