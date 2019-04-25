<?php
session_start();
/*-------------------     Include File Start      ---------------*/
include_once("config.php");
include_once("global.php");
include_once("./class/exam_test_class.php");

/*-------------------     Include File End      ---------------*/

if(!isset($_SESSION['id']) && empty($_SESSION['id'])) {
    header("Location: ".DASH_URL);
    die();  
}

/*-------------------     Class Object Start      ---------------*/

$ExamTest = new Exam_Test();

/*-------------------     Class Object End      ---------------*/

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $examQuestionArray = $ExamTest->getExamTestQuestionById(base64_decode($_GET['id']));
    $countQuestion = count($examQuestionArray);
} else {
    $url = DASH_URL.'/exam-test-list';
    header("Location: $url");
    die();
}

/*-------------------     Include Header and Left Menu     ---------------*/
include_once("layout/header.php");
include_once("layout/left-menu.php");
?>

<title>Exam Test Question List| Ecoaching.guru | Your Online Coaching Guru</title>
<section id="main__content">
    <div class="action-header-alt">
        <a class="action-header__item action-header__back" href="<?=DASH_URL?>/exam-test-list">
            <i class="zmdi zmdi-long-arrow-left"></i> Back to Test list
        </a>
    </div>
    <br />
    <div class="main__container" style="padding: 50px 10px 30px 10px;">
        <header class="main__title" style="padding:0px;">
            <h2><?=ucwords($examQuestionArray[0]['name'])." #".$examQuestionArray[0]['tid']?></h2>
        </header>

        <div class="row">
            <div class="col-md-12">
                <div class="list-group list-group--block contact-lists">
                <?php if(is_array($examQuestionArray) && !empty($examQuestionArray)) { ?>
                    <div class="list-group__header text-left">
                        <div class="list-group__label">
                            <?=$countQuestion?> Questions
                            <?php if(!$examQuestionArray[0]['tstatus']) { ?>
                                <a href="#" class="btn btn-primary pull-right" id="<?=base64_encode($examQuestionArray[0]['tid'])?>####<?php echo $examQuestionArray[0]['name']." #".$examQuestionArray[0]['tid']?>" data-demo-action="delete-listing">&nbsp;&nbsp;&nbsp;&nbsp;Submit Test&nbsp;&nbsp;&nbsp;&nbsp;</a>
                            <?php } else { ?>
                                <span class="mdc-bg-green-400 pull-right">Test Submitted</span>
                            <?php } ?>
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
                                <h5>Right Answer: <?=$value['op'.$value['answer']]?> (Option No. <?=$value['answer']?>)</h5>
                            </div>
                            
                            <?php if(!$value['tstatus']) { ?>
                            <div class="list-group__label">
                                <a class="mdc-bg-blue-400 editQuestion" id = "<?=$value['tid']?>####<?=$key+1?>" href="#">Edit Question</a>
                            </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <?php if(!$value['tstatus']) { ?>
                        <div class="clearfix"></div>
                        <div class="m-t-20">
                            <a href="#" title="Click here to Submit Test and make it live" class="btn btn-lg btn-primary" style="width: 100%;" id="<?=base64_encode($examQuestionArray[0]['tid'])?>####<?php echo $examQuestionArray[0]['name']." #".$examQuestionArray[0]['tid']?>" data-demo-action="delete-listing">&nbsp;&nbsp;&nbsp;&nbsp;Submit Test&nbsp;&nbsp;&nbsp;&nbsp;</a>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <div class="load-more"><a href="#"> No Record Found!</a></div>
                <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    $(document).ready(function() {         

        var dash_url = '<?=DASH_URL?>';
        $(document).on("click", ".editQuestion", function(e) {
            e.preventDefault();
            var Id = $(this).attr('id').split('####');
            var test_id = Id[0];
            if(!Id[0] && !Id[1]) {
                alert('Something went wrong. Please try again.');
            } else {
                $.post(dash_url+"/controller/exam_test_controller.php", {flowtype:7, test_id:test_id},function(data) {
                    var result = jQuery.parseJSON(data);
                    if(result.status == 'success') {
                        window.location.href = dash_url+'/create-exam-test?id='+Id[0]+'&q='+Id[1];
                    } else {
                        alert('Something went wrong. Please try again.');
                    }
                });
            }
            return false;
        });

        if($('[data-demo-action="delete-listing"]')[0]) {
            $('[data-demo-action="delete-listing"]').click(function (e) {
                e.preventDefault();
                var Id = $(this).attr('id').split('####');
                swal({
                    title: 'Are you sure?',
                    text: "You want to Submit <b>"+Id[1]+"</b> Test.",
                    type: "info",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    showLoaderOnConfirm: true,
                    preConfirm: function() {
                        return new Promise(function(resolve) {
                            setTimeout(function() {
                                $.ajax({
                                    url: dash_url+"/controller/exam_test_controller.php",
                                    type: "POST",
                                    data: {test_id: Id[0], flowtype:5},
                                    dataType: "json",
                                    success: function (response) {
                                        if(response.status == 'success') {
                                            swal('Done!','Test has been submitted Successfully.','success').then(function() { window.location = dash_url+"/exam-test-list"; });
                                        } else {
                                            swal("Cancelled", "Something went wrong. Please try again.", "error");
                                        }
                                    },
                                    error: function(response) {
                                        swal("Cancelled", "Something went wrong. Please try again.", "error");
                                    }
                                });
                            }, 2000);
                        });
                    }
                })
            });
        }

    });
</script>

<?php include_once("layout/footer.php"); ?>