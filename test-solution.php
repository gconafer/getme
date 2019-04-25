<?php
session_start();
/*-------------------     Include File Start      ---------------*/

include_once("config.php");
include_once("global.php");
include_once("./class/blog_class.php");
include_once("./class/exam_test_class.php");
include_once("./class/city_master_class.php");
include_once("./class/student_test_class.php");
include_once("./class/student_question_class.php");

/*-------------------     Include File End      ---------------*/

/*-------------------     Class Object Start      ---------------*/

$BlogDBLink = BlogDBConnection();
$Blog = new Blog();

$ExamTest = new Exam_Test();
$cityMaster = new City_Master();
$StudentTest = new Student_Test();
$StudentQuestion = new Student_Question();

/*-------------------     Class Object End      ---------------*/

$q = trim($_GET['q']);
if ((strpos($q, "9643adf782gh882bhjh2st") !== false) && isset($_SESSION['solution_test']) && ($_SESSION['solution_test'] == 1)) {
    $qArray = explode('-', $q);
    $keyCount = count($qArray);
    $String = $qArray[$keyCount-1];
    $qArray = explode('9643adf782gh882bhjh2st', $String);
    $StudentTestId = str_rot13($qArray[1]);

    $StudentTestArray = $StudentTest->getStudentTestById($StudentTestId);
    if(is_array($StudentTestArray) && !empty($StudentTestArray) && ($qArray[0] == md5(strtotime($StudentTestArray['created_on'])))) {

        //unset($_SESSION['solution_test']);
        $examQuestionArray = $StudentQuestion->getExamTestQuestionById($StudentTestArray['student_id'], $StudentTestArray['test_id']);
        $examTestArray = $ExamTest->getExamTestById($StudentTestArray['test_id']);
        $popularExamArray = $ExamTest->getPopularExamTest($examTestArray['exam_id']);

    } else {
        $url = ABS_URL.'/';
        header("Location: $url");
        die();
    }
} else {
    $url = ABS_URL.'/';
    header("Location: $url");
    die();
}

$cityDetailArray = $cityMaster->getDetailOfCity(CITY_ID);
$cityUrl = $cityDetailArray['url'];
$cityName = ucwords($cityDetailArray['name']);
?>

<?php include_once("layout/header.php"); ?>
</header>

<section class="section">
    <div class="main__container" style="padding: 0 0 0 0;">
        <div class="row">
            <div class="col-md-9">
                <div class="list-group list-group--block tasks-lists">
                    <div class="list-group-item">
                        <div class="checkbox">
                            <span class="tasks-list__info">
                                <center><h3><?=$examTestArray['name']?> #<?=$examTestArray['id']?> (Solution)</h3></center>
                            </span>
                        </div>
                    </div>
                    <?php foreach ($examQuestionArray as $key => $value) { ?>
                        <div class="list-group-item media">
                            <div class="media-body list-group__text">
                                <h4><span><?php echo $key+1; ?>. <?=htmlspecialchars_decode($value['subject'])?></span></h4>
                                <small>1. <?=$value['op1']?></small>
                                <small>2. <?=$value['op2']?></small>
                                <small>3. <?=$value['op3']?></small>
                                <small>4. <?=$value['op4']?></small>
                                <h5>Solution: <?=htmlspecialchars_decode($value['solution'])?></h5>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card hidden-xs hidden-sm hidden-print">
                    <div class="card__header">
                        <h2>You may also like...</h2>
                        <small>Popular <b><?=$examTestArray['exam']?></b> Test</small>                     
                    </div>
                    <div class="list-group">
                    <?php foreach ($popularExamArray as $key => $value) { ?>
                        <a href="<?=ABS_URL?>/online-test/<?=$value['url']?>" class="list-group-item media">
                            <div class="media-body list-group__text">
                                <strong><?=$value['name']?> #<?=$value['id']?></strong>
                                <small>No. of questions: <?=$value['count']?>, Level: <?=$TEST_LEVEL[$examTestArray['level']];?></small>
                            </div>
                        </a>
                    <?php } ?>

                        <div class="p-10"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    localStorage.setItem("time", 0);
</script>
<?php include_once("layout/footer.php"); ?>