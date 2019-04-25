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

$examTestArray = $ExamTest->getExamTestList($_SESSION['instituate_id']);
$CountExamTest = count($examTestArray);

/*-------------------     Include Header and Left Menu     ---------------*/
include_once("layout/header.php");
include_once("layout/left-menu.php");
?>

<title>Test List| Ecoaching.guru | Your Online Coaching Guru</title>
<section id="main__content">
    <div class="action-header-alt">
        <div class="action-header__item action-header__add">
            <a href="<?=DASH_URL?>/exam-test?type=add" class="btn btn-danger btn-sm">Add New Test</a>
        </div>
    </div>

    <div class="main__container">
        <header class="main__title" style="padding:0px;">
            <h2>Test List: </h2>
        </header>

        <div class="row">
            <div class="col-md-12">
                <div class="list-group list-group--block contact-lists">
                    <?php if(is_array($examTestArray) && !empty($examTestArray)) { ?>
                    <div class="list-group__header text-left">
                        <?=$CountExamTest?> Total Test
                    </div>
                    <?php foreach ($examTestArray as $key => $value) { ?>
                        <div class="list-group-item media">
                            <div class="media-body list-group__text">
                                <strong><a style="font-size:16px;" href="<?=DASH_URL?>/exam-question-list?id=<?=base64_encode($value['id'])?>"><?=ucwords($value['name'])." #".$value['id']?></a></strong>
                                <div class="list-group__attrs">
                                    <div><b>Exam&nbsp;:</b>&nbsp;<?php if($value['exam']) echo $value['exam']; else echo 'N/A'; ?></div>
                                    <div><b>Subject:</b>&nbsp;<?php if($value['subject']) echo $value['subject']; else echo 'N/A'; ?></div>
                                    <div><b>Chapter:</b>&nbsp;<?php if($value['chapter']) echo $value['chapter']; else echo 'N/A'; ?></div>
                                    <div><b>No of Questions:</b>&nbsp;<?php if($value['count']) echo $value['count']; else echo 'N/A'; ?></div>
                                    <div><b>Level:</b>&nbsp;<?php if($value['level']) echo $TEST_LEVEL[$value['level']]; else echo 'N/A'; ?></div>
                                </div>
                            </div>
                        
                            <div class="list-group__label">
                            <?php if ($value['status'] == 1) { 
                                echo '<span class="mdc-bg-green-400"><i class="zmdi zmdi-check-all hidden-xs"></i> Submitted</span>'; 
                            } else if ($value['status'] == 0) {
                                echo '<span class="mdc-bg-orange-400"><i class="zmdi zmdi-minus-circle-outline hidden-xs"></i> Not Submitted</span>'; 
                            } ?>    
                            &nbsp;&nbsp;<a class="mdc-bg-blue-400" href="<?=DASH_URL?>/exam-question-list?id=<?=base64_encode($value['id'])?>">View Question</a>
                            <a class="btn btn-link" id="<?=base64_encode($value['id'])?>####<?php echo $value['name']." #".$value['id']?>" data-demo-action="delete-listing">Delete Test</a>
                            </div>
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
        if($('[data-demo-action="delete-listing"]')[0]) {
            $('[data-demo-action="delete-listing"]').click(function (e) {
                e.preventDefault();
                var Id = $(this).attr('id').split('####');
                swal({
                    title: 'Are you sure?',
                    text: "You want to Delete <b>"+Id[1]+"</b> Test.",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    showLoaderOnConfirm: true,
                    preConfirm: function() {
                        return new Promise(function(resolve) {
                            setTimeout(function() {
                                $.ajax({
                                    url: dash_url+"/controller/exam_test_controller.php",
                                    type: "POST",
                                    data: {test_id: Id[0], flowtype:6},
                                    dataType: "json",
                                    success: function (response) {
                                        if(response.status == 'success') {
                                            swal('Done!','Test has been Successfully Deleted.','success').then(function() { window.location = dash_url+"/exam-test-list"; });
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