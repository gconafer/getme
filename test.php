<?php
// session_start();
// /*-------------------     Include File Start      ---------------*/
// include_once("config.php");
// include_once("global.php");
// include_once("./class/student_test_class.php");
// include_once("./class/exam_question_class.php");

// /*-------------------     Include File End      ---------------*/
// /*
// if(!isset($_SESSION['id']) || empty($_SESSION['id'])) {
//     session_destroy();
//     header("Location: ".LOGIN_URL);
//     die();
// }
// */
// /*-------------------     Class Object Start      ---------------*/

// $studentTest = new Student_Test();
// $examQuestion = new Exam_Question();

// /*-------------------     Class Object End      ---------------*/

// $questionArray = $examQuestion->getQuestionListOfTestWithAnswer($_SESSION['id'], $studentTestArray['test_id']);
/*
$noOfTest = $accuracy = $noOfQuestion = $noOfUnattemptedQuestion = $noOfRightQuestion = $noOfWrongQuestion = $avgTimePerQuestion = $totalSecond = 0;
$examArray = $Exam->getExamByUrlAndSubjectId($_GET['q'], $_GET['q1']);
$testListArray = $examTest->getTestListOfStudent($examArray['exam_id'], $examArray['subject_id'], $_SESSION['id']);
$previousTestListArray = $studentTest->getPreviousTestListOfStudent($_SESSION['id'], $examArray['exam_id'], $examArray['subject_id']);

echo '<pre>'; print_r($testListArray); print_r($examArray);
echo '<pre>'; print_r($previousTestListArray); die();
foreach ($previousTestListArray as $key => $value) {
    $noOfTest = $noOfTest + 1;
    $totalSecond = $totalSecond + $value['time'];
    $noOfQuestion = $noOfQuestion + $value['t_q'];
    $noOfRightQuestion = $noOfRightQuestion + $value['r_q'];
    $noOfWrongQuestion = $noOfWrongQuestion + $value['w_q'];
    $noOfUnattemptedQuestion = $noOfUnattemptedQuestion + $value['un_q'];
}

$accuracy = $noOfRightQuestion*100/($noOfRightQuestion + $noOfWrongQuestion);
$avgTimePerQuestion = $totalSecond/$noOfQuestion;
*/

/*-------------------     Include Header and Left Menu     ---------------*/


include_once("layout/dashboard-header.php");
 include_once("layout/dashboard-left-menu.php");
?>
<style type="text/css">
    .listings-grid__favorite{position:absolute;z-index:1;bottom:6px;right:10px}
.actions>div{padding-top:5px}
.actions>div,.actions>div>a{display:inline-block;vertical-align:top;width:30px;height:30px;text-align:center}
.actions__toggle{cursor:pointer;position:relative}
.actions__toggle input[type=checkbox]{position:absolute;left:0;top:0;width:100%;height:100%;z-index:11;opacity:0;filter:alpha(opacity=0)}
</style>
<!-- High Charts Libary -->
<script src="<?=ABS_JS_URL?>/highcharts.js"></script>

<section id="main__content">
    <div class="main__container">
        <ul class="card breadcrumb">
            <li><a href="<?=ABS_URL?>/home">Home</a></li>
            <li>Pictures</li>
        </ul>
        <header class="main__title">
            <div class="row">
                <div class="col-sm-6">
                    <h2>QUANT</h2>
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
                        <h1>Test Analysis</h1>
                        <small>Quick stats ot Test</small>
                    </div>

                    <div class="card__body">
                        <div class="card__sub row rmd-stats">
                            <div class="col-xs-6">
                                <div class="rmd-stats__item mdc-bg-red-400">
                                    <h2>374</h2>
                                    <small>Score</small>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="rmd-stats__item mdc-bg-blue-400">
                                    <h2>374</h2>
                                    <small>No. of questions attempted</small>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="rmd-stats__item mdc-bg-grey-400">
                                    <h2>374</h2>
                                    <small>Avg. time/question</small>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="rmd-stats__item mdc-bg-green-400">
                                    <h2>374</h2>
                                    <small>Accuracy</small>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="rmd-stats__item mdc-bg-yellow-400">
                                    <h2>374</h2>
                                    <small>Rank</small>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="rmd-stats__item mdc-bg-red-400">
                                    <h2>374</h2>
                                    <small>Percentile</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card__header">
                        <h2>Answer Key</h2>
                        <small>Test taken by you</small>
                    </div>

                    <div class="list-group tasks-lists">
                        <div class="actions listings-grid__favorite">
                            <div class="actions__toggle">
                                <input type="checkbox" tabindex="0">
                                <i class="zmdi zmdi-favorite-outline"></i>
                                <i class="zmdi zmdi-favorite"></i>
                            </div>
                        </div>
                        <div class="list-group list-group--block tasks-lists">
                            <div style="margin: 25px 25px 25px 25px;">
                                <h4><span>1. Test</span></h4>
                                <div style="margin-left: 2%;">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <b> <input type="radio" name="q[<?=$value['id']?>]" value="1">&nbsp;&nbsp;1. <?=$value['op1']?></b><br/>
                                            <b> <input type="radio" name="q[<?=$value['id']?>]" value="3">&nbsp;&nbsp;3. <?=$value['op3']?></b>
                                        </div>
                                        <div class="col-md-6">
                                            <b> <input type="radio" name="q[<?=$value['id']?>]" value="2">&nbsp;&nbsp;2. <?=$value['op2']?></b><br/>
                                            <b> <input type="radio" name="q[<?=$value['id']?>]" value="4">&nbsp;&nbsp;4. <?=$value['op4']?></b>
                                        </div>
                                    </div>
                                </div>
                            </div><hr>
                        </div>

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
        text: 'Browser market shares at a specific website, 2014'
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
        name: 'Brands',
        data: [
            { name: 'Microsoft Internet Explorer', y: 56.33 },
            { name: 'Chrome', y: 24.03 },
            { name: 'Firefox', y: 10.38 }
        ]
    }]
});
</script>

<?php include_once("layout/dashboard-footer.php"); ?>