<?php
session_start();
/*-------------------     Include File Start      ---------------*/

include_once("config.php");
include_once("global.php");
include_once("./class/blog_class.php");
include_once("./class/exam_test_class.php");
include_once("./class/city_master_class.php");
include_once("./class/student_test_class.php");

/*-------------------     Include File End      ---------------*/

/*-------------------     Class Object Start      ---------------*/

$BlogDBLink = BlogDBConnection();
$Blog = new Blog();


$ExamTest = new Exam_Test();
$cityMaster = new City_Master();
$StudentTest = new Student_Test();

/*-------------------     Class Object End      ---------------*/

$page = 0;
$TotalMarks = 0;
$q = trim($_GET['q']);
if ((strpos($q, "9643adf782gh882bhjh2st") !== false) && isset($_SESSION['test_student_id']) && !empty($_SESSION['test_student_id'])) {
    $qArray = explode('-', $q);
    $keyCount = count($qArray);
    $String = $qArray[$keyCount-1];
    $qArray = explode('9643adf782gh882bhjh2st', $String);
    $StudentTestId = str_rot13($qArray[1]);

    $test_student_id = $_SESSION['test_student_id'];
    $StudentTestArray = $StudentTest->getStudentTest($_SESSION['test_student_id'], $StudentTestId);
    unset($_SESSION['test_student_id']);
    if(is_array($StudentTestArray) && !empty($StudentTestArray) && ($qArray[0] == md5(strtotime($StudentTestArray['created_on'])))) {

        $page = 2;
        $testQuestionArray = $ExamTest->getTestAndQuestion($StudentTestArray['test_id']);
        $examTestArray = $ExamTest->getExamTestById($StudentTestArray['test_id']);
        $TotalMarks = $examTestArray['count']*4;

    } else {
        $url = ABS_URL.'/';
        header("Location: $url");
        die();
    }
} else {
    $page = 1;
    $examTestArray = $ExamTest->getExamTestByUrl($q);
    if(is_array($examTestArray) && !empty($examTestArray)) {
        $TotalMarks = $examTestArray['count']*4;
        $countStudent = $StudentTest->countStudentTest($examTestArray['id']) + rand(40, 100);
    } else {
        $url = ABS_URL.'/';
        header("Location: $url");
        die();
    }
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

<?php if($page == 1) { ?>
<section class="section">
    <div class="main__container" style="padding: 0 0 0 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="list-group list-group--block tasks-lists">
                    <div class="list-group-item">
                        <div class="checkbox">
                            <span class="tasks-list__info">
                                <center><h3><?=$examTestArray['name']?> #<?=$examTestArray['id']?></h3></center>
                            </span>
                        </div>

                        <div class="list-group__attrs" style="margin-left: 5%;margin-top: :20px;">
                            <div style="font-size:16px;"><b>Exam&nbsp;:</b>&nbsp;<?php if($examTestArray['exam']) echo $examTestArray['exam']; else echo 'N/A'; ?></div>
                            <div style="font-size:16px;"><b>Subject:</b>&nbsp;<?php if($examTestArray['subject']) echo $examTestArray['subject']; else echo 'N/A'; ?></div>
                            <div style="font-size:16px;"><b>No of Questions:</b>&nbsp;<?php if($examTestArray['count']) echo $examTestArray['count']; else echo 'N/A'; ?></div>
                            <div style="font-size:16px;"><b>Total Marks:</b>&nbsp;<?php if($TotalMarks) echo $TotalMarks; else echo 'N/A'; ?></div>
                            <div style="font-size:16px;"><b>Level:</b>&nbsp;<?php if($examTestArray['level']) echo $TEST_LEVEL[$examTestArray['level']]; else echo 'N/A'; ?></div>
                            <div style="font-size:16px;"><b>Test Taken by User:</b>&nbsp;<?php if($countStudent) echo $countStudent; ?></div>
                        </div>
                    </div>
                    <br />
                    <center><h2>Instructions for Test</h2></center><hr>
                    <div style="margin-left: 2%;">
                        <b>1. Each Question has four options out of which one is correct.</b><br/>
                        <b>2. Try not to guess the answer as there is negative marking.</b><br/>
                        <b>3. you will be awarded 4 marks for each correct answer and 1 mark will be deduct for each wrong answer.</b><br/>
                        <b>4. There is no penalty for the questions you have not attempt.</b><br/>
                        <b>5. Once you start the test you will not allowed to reattempt it. Make sure you complete the test before submit the test or close the browser or reload the browser.</b>
                    </div>
                    <br />
                    <center><h2>Fill these Information</h2></center><hr>
                    <form class="card new-contact" id="AddTestForm">
                        <input type="hidden" name="flowtype" id="flowtype" value="1">
                        <input type="hidden" name="test_id" id="test_id" value="<?=base64_encode($examTestArray['id'])?>">
                        <input type="hidden" name="url" id="url" value="<?=base64_encode($examTestArray['url'])?>">

                        <div class="card__body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group form-group--float">
                                        <input type="text" name="name" id="name" class="form-control">
                                        <label>Name:</label>
                                        <i class="form-group__bar"></i>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group form-group--float">
                                        <input type="text" name="email" id="email" class="form-control">
                                        <label>Email:</label>
                                        <i class="form-group__bar"></i>
                                    </div>
                                </div>
                            </div>
                            <p style="color:red;" id = "errorMsgD"></p>
                            <div class="clearfix"></div>
                            <div class="m-t-20">
                                <button type="submit" class="btn btn-primary submitBtn col-sm-12"><b>Start Test</b></button>
                            </div>
                        </div>
                    </form>
                    <br />
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    localStorage.setItem("time", 0);
    $(document).ready(function() {         

        var abs_url = '<?=ABS_URL?>';
        var regEx = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        $(document).on("submit", "form#AddTestForm", function() {
            $(".submitBtn").attr("disabled", "disabled");
            var flowtype = $('#flowtype').val();
            var email = $('#email').val();
            var name = $('#name').val();
            var test_id = $('#test_id').val();
            var url = $('#url').val();
            if(!name) {
                $('#errorMsgD').text('Please enter name');
                $('.submitBtn').removeAttr("disabled");
            } else if (!email) {
                $('#errorMsgD').text('Please enter email');
                $('.submitBtn').removeAttr("disabled");
            } else if (!regEx.test(email)) {
                $('#errorMsgD').text('Please enter valid email');
                $('.submitBtn').removeAttr("disabled");
            } else {
                $.post(abs_url+"/controller/onlinetest_controller.php", {flowtype:flowtype, name:name, email:email, test_id:test_id, url:url},function(data) {
                    var result = jQuery.parseJSON(data);
                    if(result.status == 'success') {
                        $('.submitBtn').removeAttr("disabled");
                        $('#errorMsgD').css('color', 'green').html('Redirecting to test page');
                        $("#errorMsgD").fadeOut(1000, function () {        
                            setTimeout(function(){ window.location.href = abs_url+'/online-test/'+result.url; }, 1500);     
                        });
                    } else {
                        $('#errorMsgD').text(result.msg);
                        $('.submitBtn').removeAttr("disabled");
                    }
                });
            }
            return false;
        });
    });
</script>

<?php } elseif ($page == 2) { ?>

<section class="section">
    <div class="main__container" style="padding: 0 0 0 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="tasks-lists">
                    <div class="list-group-item">
                        <div class="checkbox">
                            <span class="tasks-list__info">
                                <center><h3><?=$examTestArray['name']?> #<?=$examTestArray['id']?></h3></center>
                            </span>
                        </div>

                        <div class="list-group__attrs" style="margin-left: 5%;margin-top: :20px;">
                            <div style="font-size:16px;"><b>Exam&nbsp;:</b>&nbsp;<?php if($examTestArray['exam']) echo $examTestArray['exam']; else echo 'N/A'; ?></div>
                            <div style="font-size:16px;"><b>Subject:</b>&nbsp;<?php if($examTestArray['subject']) echo $examTestArray['subject']; else echo 'N/A'; ?></div>
                            <div style="font-size:16px;"><b>No of Questions:</b>&nbsp;<?php if($examTestArray['count']) echo $examTestArray['count']; else echo 'N/A'; ?></div>
                            <div style="font-size:16px;"><b>Total Marks:</b>&nbsp;<?php if($TotalMarks) echo $TotalMarks; else echo 'N/A'; ?></div>
                            <div style="font-size:16px;"><b>Level:</b>&nbsp;<?php if($examTestArray['level']) echo $TEST_LEVEL[$examTestArray['level']]; else echo 'N/A'; ?></div>
                            <div style="font-size:16px;"><b>Time:</b>&nbsp;<span id="hours">00</span>:<span id="minutes">00</span>:<span id="seconds">00</span> (HH:MM:SS)</div>
                        </div>
                    </div>
                </div>

                <form action="<?=ABS_URL?>/controller/onlinetest_controller.php" method="post" onsubmit="return confirm('Do you really want to Submit Test?');">
                    <input type="hidden" name="flowtype" id="flowtype" value="2">
                    <input type="hidden" name="time" id="time" value="1">
                    <input type="hidden" name="test_student_id" id="test_student_id" value="<?=base64_encode($test_student_id)?>">
                    <input type="hidden" name="string" id="string" value="<?=$String?>">
                    
                    <div class="list-group list-group--block tasks-lists">
                    <?php foreach ($testQuestionArray as $key => $value) { ?>
                        <div style="margin: 25px 25px 25px 25px;">
                            <h4><span><?php echo $key+1; ?>. <?=htmlspecialchars_decode($value['subject'])?></span></h4>
                            <div style="margin-left: 2%;">
                                <b> <input type="radio" name="q[<?=$value['id']?>]" value="1">&nbsp;&nbsp;1. <?=$value['op1']?></b><br/>
                                <b> <input type="radio" name="q[<?=$value['id']?>]" value="2">&nbsp;&nbsp;2. <?=$value['op2']?></b><br/>
                                <b> <input type="radio" name="q[<?=$value['id']?>]" value="3">&nbsp;&nbsp;3. <?=$value['op3']?></b><br/>
                                <b> <input type="radio" name="q[<?=$value['id']?>]" value="4">&nbsp;&nbsp;4. <?=$value['op4']?></b><br/>
                            </div>
                        </div><hr>
                    <?php } ?>
                        <div class="m-t-20">
                            <button type="submit" class="btn btn-primary col-sm-12"><b>Submit Test</b></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    var hoursLabel = document.getElementById("hours");
    var minutesLabel = document.getElementById("minutes");
    var secondsLabel = document.getElementById("seconds");
    var number = localStorage.getItem("time");
    if(number) {
        var Seconds = number;
        var totalSeconds = number;
    } else {
        var Seconds = 0;
        var totalSeconds = 0;
    }
    setInterval(setTime, 1000);

    function setTime()
    {
        ++Seconds;
        ++totalSeconds;
        secondsLabel.innerHTML = pad(totalSeconds%60);
        minutesLabel.innerHTML = pad(parseInt(totalSeconds/60));
        hoursLabel.innerHTML = pad(parseInt(totalSeconds/3600));
        document.getElementById("time").value = Seconds;
        localStorage.setItem("time", Seconds);
    }

    function pad(val) 
    {
        var valString = val + "";
        if(valString.length < 2) { 
            return "0" + valString;
        } else {
            return valString;
        }
    }
</script>

<?php } ?>
<?php include_once("layout/footer.php"); ?>