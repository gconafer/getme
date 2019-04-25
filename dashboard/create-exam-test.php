<?php
session_start();
/*-------------------     Include File Start      ---------------*/
include_once("config.php");
include_once("global.php");
include_once("./class/exam_test_class.php");
include_once("./class/exam_question_class.php");

/*-------------------     Include File End      ---------------*/

if(!isset($_SESSION['id']) && empty($_SESSION['id'])) {
    header("Location: ".DASH_URL);
    die();  
}

/*-------------------     Class Object Start      ---------------*/

$ExamTest = new Exam_Test();
$ExamQuestion = new Exam_Question();

/*-------------------     Class Object End      ---------------*/

$quesNo = $_GET['q'];
$questionCount = $ExamQuestion->getExamTotalQuesCount($_GET['id']);
if(isset($_GET['q']) && !empty($_GET['q']) && isset($_GET['id']) && !empty($_GET['id']) && isset($_SESSION['test_id']) && ($_GET['id'] == base64_decode($_SESSION['test_id']))) {
    
    if (($quesNo > 0) && ($quesNo <= $questionCount+1)) {
        $questionArray = $ExamQuestion->getExamQuesByQuesNumber($_GET['id'], $_GET['q']);
        $examTestArray = $ExamTest->getExamTestById($_GET['id']);
    } else {
        $url = DASH_URL."/create-exam-test?id=".$_GET['id']."&q=1";
        header("Location: ".$url);
        die();
    }

} else {
    header("Location: ".DASH_URL);
    die();
}

/*-------------------     Include Header and Left Menu     ---------------*/
include_once("layout/header.php");
include_once("layout/left-menu.php");
//echo $questionCount; echo '<pre>'; print_R($questionArray); die('aaa');
?>

<title>Add Exam Test | Ecoaching.guru | Your Online Coaching Guru</title>
<section id="main__content">

    <div class="main__container" style="padding: 30px 10px 30px 10px;">
        <div class="submit-property">
            <ul class="submit-property__steps">
            <?php 
            for ($i=1; $i <= $questionCount+1; $i++) { 
                if($i == $_GET['q']) $active = "class='active'"; else $active = "";
                echo "<li ".$active."><a href='".DASH_URL."/create-exam-test?id=".$_GET['id']."&q=".$i."'>".$i."</a></li>";
            } ?>
                <li class="submit-property__caret"></li>
            </ul>
        </div>
        <br /><br /><br />
        

        <form class="card new-contact" id="AddQuesForm">
            <input type="hidden" name="flowtype" id="flowtype" value="4">
            <input type="hidden" name="q_id" id="q_id" value="<?=base64_encode($questionArray['id'])?>">
            <input type="hidden" name="test_id" id="test_id" value="<?=base64_encode($examTestArray['id'])?>">
            <div class="card__body">
                <div class="row">
                <h4><?=$examTestArray['name']?> #<?=$examTestArray['id']?> (Question No. <?=$quesNo?>)</h4><hr>
                    <div class="col-sm-12">
                        <div class="form-group form-group--float">
                            <label><h5>Enter Question Statement:</h5></label><br /><br />
                            <textarea name="q" id="q" class="form-control textarea-autoheight ckeditor"><?php if(!empty(trim($questionArray['subject']))) echo $questionArray['subject']; ?></textarea>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group form-group--float">
                            <input type="text" name="a" id="a" class="form-control" value="<?=$questionArray['op1']?>">
                            <label>Enter option 1</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group form-group--float">
                            <input type="text" name="b" id="b" class="form-control" value="<?=$questionArray['op2']?>">
                            <label>Enter option 2</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group form-group--float">
                            <input type="text" name="c" id="c" class="form-control" value="<?=$questionArray['op3']?>">
                            <label>Enter option 3</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group form-group--float">
                            <input type="text" name="d" id="d" class="form-control" value="<?=$questionArray['op4']?>">
                            <label>Enter option 4</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group form-group--float">
                            <input type="number" name="r" id="r" class="form-control" max="4" min="1" value="<?=$questionArray['answer']?>">
                            <label>Enter Right Answer option No. (eg. 1, 2, 3, 4)</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group form-group--float">
                            <label><h5>Enter Description If Any:</h5></label><br /><br />
                            <textarea name="desc" id="desc" class="form-control textarea-autoheight ckeditor"><?php if(!empty(trim($questionArray['descr']))) echo $questionArray['descr']; ?></textarea>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group form-group--float">
                            <label><h5>Enter Solution:</h5></label><br /><br />
                            <textarea name="s" id="s" class="form-control textarea-autoheight ckeditor"><?php if(!empty(trim($questionArray['solution']))) echo $questionArray['solution']; ?></textarea>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                </div>
                <p style="color:red;" id = "errorMsgD"></p>
                <div class="clearfix"></div>
                <div class="m-t-20">
                <?php if($_GET['q'] > 1) { ?>
                    <a class="btn btn-link" href="<?=DASH_URL?>/create-exam-test?id=<?=$_GET['id']?>&q=<?=$quesNo-1;?>">Previous Question</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <?php } ?>
                    <button type="submit" class="btn btn-lg btn-primary submitBtn" title="Click here to Add Question into this Test and Proceed for next Question">&nbsp;&nbsp;&nbsp;&nbsp;Add Question&nbsp;&nbsp;&nbsp;&nbsp;</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="<?=DASH_URL?>/exam-question-list?id=<?=base64_encode($_GET['id'])?>" title="Click here to Review and Submit Test" class="btn btn-lg btn-primary" data-demo-action="delete-listing">&nbsp;&nbsp;&nbsp;&nbsp;Review Test&nbsp;&nbsp;&nbsp;&nbsp;</a>
                </div>
            </div>
        </form>
      

    </div>
</section>

<script type="text/javascript" src="<?php echo DASH_URL;?>/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {         

        var dash_url = '<?=DASH_URL?>';
        $(document).on("submit", "form#AddQuesForm", function() {
            $(".submitBtn").attr("disabled", "disabled");
            var flowtype = $('#flowtype').val();
            var test_id = $('#test_id').val();
            var q_id = $('#q_id').val();
            var q = CKEDITOR.instances.q.getData();
            var a = $('#a').val();
            var b = $('#b').val();
            var c = $('#c').val();
            var d = $('#d').val();
            var r = $('#r').val();
            var s = CKEDITOR.instances.s.getData();
            var desc = CKEDITOR.instances.desc.getData();
            if(!q) {
                $('#errorMsgD').text('Please enter question');
                $('.submitBtn').removeAttr("disabled");
            } else if (!a) {
                $('#errorMsgD').text('Please enter option value 1');
                $('.submitBtn').removeAttr("disabled");
            } else if (!b) {
                $('#errorMsgD').text('Please enter option value 2');
                $('.submitBtn').removeAttr("disabled");
            } else if (!c) {
                $('#errorMsgD').text('Please enter option value 3');
                $('.submitBtn').removeAttr("disabled");
            } else if (!d) {
                $('#errorMsgD').text('Please enter option value 4');
                $('.submitBtn').removeAttr("disabled");
            } else if (!r && r <= 0 && r > 4) {
                $('#errorMsgD').text('Please select right answer');
                $('.submitBtn').removeAttr("disabled");
            } else {
                $.post(dash_url+"/controller/exam_test_controller.php", {flowtype:flowtype, test_id:test_id, q_id:q_id, q:q, a:a, b:b, c:c, d:d, r:r, s:s, desc:desc},function(data) {
                    var result = jQuery.parseJSON(data);
                    if(result.status == 'success') {
                        $('.submitBtn').removeAttr("disabled");
                        $('#errorMsgD').css('color', 'green').html('Updated Successfully');
                        $("#errorMsgD").fadeOut(1000, function () {        
                            setTimeout(function(){ window.location.href = dash_url+'/create-exam-test?id='+result.id+'&q='+result.count; }, 1500);     
                        });
                    } else {
                        $('#errorMsgD').text('Something went wrong. Please try again.');
                        $('.submitBtn').removeAttr("disabled");
                    }
                });
            }
            return false;
        });
    });
</script>
<?php include_once("layout/footer.php"); ?>