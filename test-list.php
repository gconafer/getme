<?php
/*-------------------     Include File Start      ---------------*/

include_once("config.php");
include_once("global.php");
include_once("./class/blog_class.php");
include_once("./class/exam_class.php");
include_once("./class/city_master_class.php");
include_once("./class/student_test_class.php");

/*-------------------     Include File End      ---------------*/

/*-------------------     Class Object Start      ---------------*/

$BlogDBLink = BlogDBConnection();
$Blog = new Blog();

$Exam = new Exam();
$cityMaster = new City_Master();
$StudentTest = new Student_Test();

/*-------------------     Class Object End      ---------------*/

$q1 = "";
$q = trim($_GET['q']);
if(isset($_GET['q1']) && !empty($_GET['q1'])) $q1 = trim($_GET['q1']);
$examArray = $Exam->getExambyUrl($q, $q1);
if(is_array($examArray) && !empty($examArray)) {

    $countTest = count($examArray);
    $examSubjectArray = $Exam->getSubjectWiseExam($q);

} else {
    $url = ABS_URL.'/';
    header("Location: $url");
    die();
}

$cityDetailArray = $cityMaster->getDetailOfCity(CITY_ID);
$cityUrl = $cityDetailArray['url'];
$cityName = ucwords($cityDetailArray['name']);
$pageTitle = "Online Test Series - IBPS, SBI, SSC, RRB, RBI | Ecoaching.guru";
$pageDesc = "Hand-crafted Pratice Test for various Exam. Free Mock Tests - Bank PO, Clerk, SSC CGL, CHSL, JE, GATE, Insurance, Railways, IBPS RRB, SBI, RBI, IPPB, BSNL TTA";
$ogTitle = "Ecoaching.guru";
$ogType = "website";
$ogUrl = ABS_URL;
$ogSiteName = "Ecoaching.guru";
$ogDesc = $pageDesc;
$ogImage = ABS_IMG_URL."/logo.png";
$ogImageHeight = 200;
$ogImageWidth = 150;

?>

<?php include_once("layout/header.php"); ?>
</header>

<section class="section">

    <div class="main__container" style="padding: 0 0 0 0;">
        <header class="main__title" style="padding: 0 0 0 0;">
            <h2><?=$examArray[0]['exam']?> Pratice Test <?php if(!empty($q1)) echo "(".$examArray[0]['subject'].")";?></h2>
            <small><?=$countTest?> Total Test</small>
        </header>

        <div class="row">
            <div class="col-md-8">
                <div class="list-group list-group--block tasks-lists">

                <?php foreach ($examArray as $key => $value) { 
                            $countStudent = $StudentTest->countStudentTest($value['id']) + rand(40, 100);
                ?>
                    <div class="list-group-item">
                        <div class="checkbox">
                            <span class="tasks-list__info">
                                <a style="font-size: 16px;" href="<?=ABS_URL?>/online-test/<?=$value['url']?>"><?=$value['name']?> #<?=$value['id']?></a>
                            </span>
                        </div>

                        <div class="list-group__attrs" style="padding: 10px 0 0 0;">
                            <div><b>Exam&nbsp;:</b>&nbsp;<?php if($value['exam']) echo $value['exam']; else echo 'N/A'; ?></div>
                            <div><b>Subject:</b>&nbsp;<?php if($value['subject']) echo $value['subject']; else echo 'N/A'; ?></div>
                            <div><b>No of Questions:</b>&nbsp;<?php if($value['count']) echo $value['count']; else echo 'N/A'; ?></div>
                            <div><b>Level:</b>&nbsp;<?php if($value['level']) echo $TEST_LEVEL[$value['level']]; else echo 'N/A'; ?></div>
                            <div><b>Test Taken by User:</b>&nbsp;<?php if($countStudent) echo $countStudent; ?></div>
                        </div>
                    </div>
                <?php } ?>

                </div>

            </div>

            <aside class="col-sm-4 hidden-xs">
                <div class="card hidden-xs hidden-sm hidden-print">
                    <div class="card__header"><h2><?=$examSubjectArray[0]['exam']?> Subject Wise Test...</h2></div>
                    <div class="list-group">
                        <?php foreach ($examSubjectArray as $key => $value) { ?>
                            <ul>
                                <li><a style="display:block;" href="<?=ABS_URL?>/<?=$value['exam_url']?>/<?=$value['subject_url']?>"><?=$value['subject']?> (<?=$value['count']?>)</a></li>
                            </ul>
                        <?php } ?>
                    </div>
                    <br />
                </div>
            </aside>
        </div>
    </div>
</section>

<?php include_once("layout/footer.php"); ?>