<?php
session_start();
/*-------------------     Include File Start      ---------------*/
include_once("config.php");
include_once("global.php");
include_once("./class/exam_class.php");
include_once("./class/exam_test_class.php");
include_once("./class/student_test_class.php");

/*-------------------     Include File End      ---------------*/

if(!isset($_SESSION['id']) || empty($_SESSION['id'])) {
    session_destroy();
    header("Location: ".LOGIN_URL);
    die();
}

/*-------------------     Class Object Start      ---------------*/

$Exam = new Exam();
$examTest = new Exam_Test();
$studentTest = new Student_Test();

/*-------------------     Class Object End      ---------------*/

$noOfTest = $accuracy = $noOfQuestion = $noOfUnattemptedQuestion = $noOfRightQuestion = $noOfWrongQuestion = $avgTimePerQuestion = $totalSecond = 0;
if((isset($_GET['q']) && !empty($_GET['q'])) && (isset($_GET['q1']) && !empty($_GET['q1']))) {
    $examArray = $Exam->getExamByUrlAndSubjectId($_GET['q'], $_GET['q1']);
    $testListArray = $examTest->getTestListOfStudent($examArray['exam_id'], $examArray['subject_id'], $_SESSION['id']);
    $previousTestListArray = $studentTest->getPreviousTestListOfStudent($_SESSION['id'], $examArray['exam_id'], $examArray['subject_id']);

    //echo '<pre>'; print_r($testListArray); print_r($examArray); print_r($previousTestListArray); die();
    foreach ($previousTestListArray as $key => $value) {
        $noOfTest = $noOfTest + 1;
        $totalSecond = $totalSecond + $value['time'];
        $noOfQuestion = $noOfQuestion + $value['t_q'];
        $noOfRightQuestion = $noOfRightQuestion + $value['r_q'];
        $noOfWrongQuestion = $noOfWrongQuestion + $value['w_q'];
        $noOfUnattemptedQuestion = $noOfUnattemptedQuestion + $value['un_q'];
    }

    if($noOfRightQuestion != 0 && $noOfWrongQuestion != 0) {
        $accuracy = $noOfRightQuestion*100/($noOfRightQuestion + $noOfWrongQuestion);
    }

    if($noOfQuestion != 0) {
        $avgTimePerQuestion = $totalSecond/$noOfQuestion;
    }
    
} else {
    $url = ABS_URL."/home";
    header("Location: ".$url);
    die();
}

/*-------------------     Include Header and Left Menu     ---------------*/

if(is_array($examArray) && empty($examArray)) {
	$url = ABS_URL."/home";
	header("Location: ".$url);
    die();
}

include_once("layout/dashboard-header.php");
include_once("layout/dashboard-left-menu.php");
?>
<!-- High Charts Libary -->
<script src="<?=ABS_JS_URL?>/highcharts.js"></script>

<section id="main__content">
    <div class="main__container">
        <ul class="card breadcrumb">
            <li><a href="<?=ABS_URL?>/home">Home</a></li>
            <li><a href="<?=ABS_URL?>/home/<?=$examArray['exam_url']?>"><?=ucwords($examArray['exam_name'])?></a></li>
            <li><?=ucwords($examArray['subject_name'])?></li>
        </ul>
        <header class="main__title">
            <div class="row">
                <div class="col-sm-6">
                    <h2><?=ucwords($examArray['subject_name'])?></h2>
                </div>
                <div class="col-sm-6">
                    <a href="#" class="btn btn-danger btn-lg pull-right">Take a new test&nbsp;&nbsp;<i class="zmdi zmdi-caret-right zmdi-hc-lg"></i></a>
                </div>
            </div>
        </header>

        <div class="card" style="font-size:16px;padding: 10px 10px 10px 10px;">
            <span><i class="zmdi zmdi-notifications-active animated infinite pulse  zmdi-hc-x"></i>&nbsp;The key to mastering a subject is to take as much tests as possible.</span>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card__body">
                        <div id="pie-chart"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card__header">
                        <h1>Subject Analysis</h1>
                        <small>Quick stats of <?=ucwords($examArray['subject_name'])?> for <?=ucwords($examArray['exam_name'])?> Course</small>
                    </div>

                    <div class="card__body">
                        <div class="card__sub row rmd-stats">
                            <div class="col-xs-6">
                                <div class="rmd-stats__item mdc-bg-red-400">
                                    <h2><?=$noOfTest?></h2>
                                    <small>Total Test Taken</small>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="rmd-stats__item mdc-bg-blue-400">
                                    <h2><?=$accuracy?></h2>
                                    <small>Accuracy</small>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="rmd-stats__item mdc-bg-grey-400">
                                    <h2><?=$noOfQuestion?></h2>
                                    <small>No. of questions</small>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="rmd-stats__item mdc-bg-green-400">
                                    <h2><?=$avgTimePerQuestion?></h2>
                                    <small>Avg. time/question</small>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="rmd-stats__item mdc-bg-yellow-400">
                                    <h2><?=$noOfRightQuestion+$noOfWrongQuestion?></h2>
                                    <small>Question Attempted</small>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="rmd-stats__item mdc-bg-red-400">
                                    <h2><?=$noOfRightQuestion?></h2>
                                    <small>Right Questions</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card__header">
                        <h2>Previous Tests</h2>
                        <small>Test taken by you</small>
                    </div>

                    <div class="list-group tasks-lists">
                    <?php foreach ($previousTestListArray as $key => $value) { ?>
                        <div class="list-group-item">
                            <div class="pull-left">
                                <div class="leads-status-alt mdc-bg-green-400">
                                    <i class="zmdi zmdi-check-all"></i>
                                </div>
                            </div>
                            <div class="checkbox checkbox--char">
                                <label>
                                    <span class="tasks-list__info">
                                        <?=$value['name']?>
                                        <small class="text-muted">Taken Today at 8.30 AM</small>
                                    </span>
                                </label>
                            </div>

                            <div class="list-group__attrs">
                                <div><b>Score</b>: <?=$value['marks']?></div>
                                <div><a href="<?=ABS_URL?>/home/test-result/<?=$value['url']?>"><i class="zmdi zmdi-trending-up zmdi-hc-lg"></i></a></div>
                            </div>
                        </div>
                    <?php } ?>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card">
                    <div class="card__header">
                        <h2>Test List</h2>
                        <small>Test related to <?=ucwords($examArray['subject_name'])?></small>
                    </div>

                    <div class="list-group tasks-lists">
                    <?php foreach ($testListArray as $key => $value) { ?>
                        <div class="list-group-item">
                            <div class="pull-left">
                                <div class="leads-status-alt mdc-bg-green-400">
                                    <?=$key+1?>
                                </div>
                            </div>
                            <div class="checkbox checkbox--char">
                                <label>
                                    <span class="tasks-list__info">
                                        <a href="<?=ABS_URL?>/home/test/<?=$value['url']?>"><?=$value['name']?></a>
                                    </span>
                                </label>
                            </div>

                            <div class="list-group__attrs">
                                <div>No. of Question: <?=$value['count']?></div>
                                <div>Level: <?=$TEST_LEVEL[$value['level']]?></div>
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
// Make monochrome colors and set them as default for all pies
Highcharts.getOptions().plotOptions.pie.colors = (function () {
    var colors = ['#F44336', '#8BC34A', '#009688'],
        base = Highcharts.getOptions().colors[0],
        i;

    for (i = 0; i < 10; i += 1) {
        colors.push(Highcharts.Color(base).brighten((i - 3) / 7).get());
    }
    return colors;
}());

// Build the chart
Highcharts.chart('pie-chart', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Distribution'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    credits: {
        enabled: false
    },
    plotOptions: {
        pie: {
            size:'70%',
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    series: [{
        name: 'Distribution',
        data: [
            { name: 'Right Questions', y: <?=$noOfRightQuestion?> },
            { name: 'Wrong Questions', y: <?=$noOfWrongQuestion?> },
            { name: 'Unattempted Questions', y: <?=$noOfUnattemptedQuestion?> }
        ]
    }]
});
</script>

<?php include_once("layout/dashboard-footer.php"); ?>