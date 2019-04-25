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

$TotalMarks = $Marks = $NumQ = $RightQ = $WrongQ = $UnattempQ = 0;
$q = trim($_GET['q']);
if ((strpos($q, "9643adf782gh882bhjh2st") !== false) && isset($_SESSION['result_test']) && ($_SESSION['result_test'] == 1)) {
    $qArray = explode('-', $q);
    $keyCount = count($qArray);
    $String = $qArray[$keyCount-1];
    $qArray = explode('9643adf782gh882bhjh2st', $String);
    $StudentTestId = str_rot13($qArray[1]);

    $StudentTestArray = $StudentTest->getStudentTestById($StudentTestId);
    $timeTaken = gmdate("H:i:s", $StudentTestArray['time']);
    if(is_array($StudentTestArray) && !empty($StudentTestArray) && ($qArray[0] == md5(strtotime($StudentTestArray['created_on'])))) {

        //unset($_SESSION['result_test']);
        $_SESSION['solution_test'] = 1;
        $testResultArray = $StudentTest->getExamTestStats($StudentTestArray['test_id']);
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
            <div class="col-md-8">
                <div class="list-group list-group--block tasks-lists">
                    <div class="list-group-item">
                        <div class="checkbox">
                            <span class="tasks-list__info">
                                <center><h3><?=$examTestArray['name']?> #<?=$examTestArray['id']?> (Result)</h3></center>
                            </span>
                        </div>

                        <div class="list-group__attrs" style="margin-top: 20px;margin-left: 10%;">
                            <div style="font-size:16px;"><b>Exam&nbsp;:</b>&nbsp;<?php if($examTestArray['exam']) echo $examTestArray['exam']; else echo 'N/A'; ?></div>
                            <div style="font-size:16px;"><b>Subject:</b>&nbsp;<?php if($examTestArray['subject']) echo $examTestArray['subject']; else echo 'N/A'; ?></div>
                            <div style="font-size:16px;"><b>Level:</b>&nbsp;<?php if($examTestArray['level']) echo $TEST_LEVEL[$examTestArray['level']]; else echo 'N/A'; ?></div>
                        </div>
                    </div>
                    <center><h3>Your Score: <?=$StudentTestArray['marks']?></h3></center><hr>
                    <center><h3><div class="row"><div class="col-md-4">Best Score: <?=$testResultArray['max']?></div><div class="col-md-4">Avg. Score: <?=number_format($testResultArray['avg'], 2)?></div><div class="col-md-4">Avg Time: <?=gmdate("H:i:s", $testResultArray['time']);?></div></div></h3></center><hr>
                    <div style="margin-left: 2%;">
                        <h4>1. Total Marks: <b><?=$StudentTestArray['t_q']*4;?></b></h4>
                        <h4>2. No. of Question: <b><?=$StudentTestArray['t_q']?></b></h4>
                        <h4>3. Right Questions: <b><?=$StudentTestArray['r_q']?></b></h4>
                        <h4>4. Wrong Questions: <b><?=$StudentTestArray['w_q']?></b></h4>
                        <h4>5. Unattempted Questions: <b><?=$StudentTestArray['un_q']?></b></h4>
                        <h4>6. Time Taken: <b><?=$timeTaken?></b> (HH:MM:SS)</h4><br />
                        <font color="red">*</font><b> 4 marks for each correct answer and -1 mark for each wrong answer.</b><br/>
                    </div>
                    <br />
                    <div class="m-t-20">
                        <a class="btn btn-primary col-sm-12" href="<?=ABS_URL?>/online-test-solution/<?=$q?>">Test Solutions</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
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