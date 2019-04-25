<?php
session_start();
/*-------------------     Include File Start      ---------------*/
include_once("config.php");
include_once("global.php");
include_once("./class/exam_class.php");

/*-------------------     Include File End      ---------------*/

if(!isset($_SESSION['id']) && empty($_SESSION['id'])) {
    header("Location: ".DASH_URL);
    die();  
}

/*-------------------     Class Object Start      ---------------*/

$Exam = new Exam();

/*-------------------     Class Object End      ---------------*/

if(isset($_GET['type']) && (($_GET['type'] == 'add') || ($_GET['type'] == 'edit' && isset($_GET['id']) && !empty($_GET['id'])))) {
    $examArray = $Exam->getExamList();

} else {
    header("Location: ".DASH_URL.'');
    die();
}

/*-------------------     Include Header and Left Menu     ---------------*/
include_once("layout/header.php");
include_once("layout/left-menu.php");
?>

<title>Add Exam Test | Ecoaching.guru | Your Online Coaching Guru</title>
<section id="main__content">
    <div class="action-header-alt">
        <a class="action-header__item action-header__back" href="<?=DASH_URL?>/exam-test-list">
            <i class="zmdi zmdi-long-arrow-left"></i> Back to Exam Test list
        </a>
    </div>

    <div class="main__container">
        <header class="main__title" style="padding:0px;">
            <h2>Add New Exam Test</h2>
        </header>

        <form class="card new-contact" id="AddTestForm">
            <input type="hidden" name="flowtype" id="flowtype" value="3">

            <div class="card__body">
                <div class="row">

                    <div class="col-sm-6">
                        <div class="form-group">
                            <select name="exam" id="exam" class="select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                            <option value="0">Select Exam</option>
                            <?php foreach ($examArray as $key => $value) {
                                echo '<option value="'.$value['id'].'">'.ucwords($value['name']).'</option>';
                            }
                            ?>
                            </select>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <select name="subject" id="subject" class="select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                            <option value="0">Select Subject</option>
                            </select>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <select name="chapter" id="chapter" class="select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                            <option value="0">Select Chapter</option>
                            </select>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <select name="level" id="level" class="select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                <option value="0">Select Test Level</option>
                                <option value="1">Easy</option>
                                <option value="2">Medium</option>
                                <option value="3">Hard</option>
                            </select>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group form-group--float">
                            <input type="text" name="name" id="name" class="form-control">
                            <label>Test Name</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group form-group--float">
                            <label><h5>Instruction for Test:</h5></label><br /><br />
                            <textarea name="instruction" id="instruction" class="form-control textarea-autoheight ckeditor"></textarea>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                </div>
                <p style="color:red;" id = "errorMsgD"></p>
                <div class="clearfix"></div>
                <div class="m-t-20">
                    <button type="submit" class="btn btn-primary submitBtn">Add Test</button>
                    <a class="btn btn-link" href="<?=DASH_URL?>/exam-test-list">Cancel</a>
                </div>
            </div>
        </form>

    </div>
</section>

<script type="text/javascript" src="<?php echo DASH_URL;?>/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {         

        var dash_url = '<?=DASH_URL?>';
        $(document).on("change", "select#exam", function() {
            var exam_id = this.value;
            var flowtype = 1;
            $.post(dash_url+"/controller/exam_test_controller.php", {flowtype:flowtype, exam_id:exam_id},function(jsonData) {
                var result = jQuery.parseJSON(jsonData);
                if(result.status == 'success') {
                    $('select#subject').empty();
                    $('select#subject').append(
                        $("<option></option>").text("Select Subject").val(0)
                    );
                    $.each(jQuery.parseJSON(result.json), function() {
                        $('select#subject').append(
                            $("<option></option>").text(this.name).val(this.id)
                        );
                    })
                } else {
                    alert('Something went wrong. Please try again.');
                }
            });
        });

        $(document).on("change", "select#subject", function() {
            var subject_id = this.value;
            var flowtype = 2;
            $.post(dash_url+"/controller/exam_test_controller.php", {flowtype:flowtype, subject_id:subject_id},function(jsonData) {
                var result = jQuery.parseJSON(jsonData);
                if(result.status == 'success') {
                    $('select#chapter').empty();
                    $('select#chapter').append(
                        $("<option></option>").text("Select Chapter").val(0)
                    );
                    $.each(jQuery.parseJSON(result.json), function() {
                        $('select#chapter').append(
                            $("<option></option>").text(this.name).val(this.id)
                        );
                    })
                } else {
                    alert('Something went wrong. Please try again.');
                }
            });
        });

        $(document).on("submit", "form#AddTestForm", function() {
            $(".submitBtn").attr("disabled", "disabled");
            var flowtype = $('#flowtype').val();
            var exam_id = $('#exam').val();
            var subject_id = $('#subject').val();
            var chapter_id = $('#chapter').val();
            var level = $('#level').val();
            var name = $('#name').val();
            var instruction = CKEDITOR.instances.instruction.getData();
            if(!name) {
                $('#errorMsgD').text('Please enter test name');
                $('.submitBtn').removeAttr("disabled");
            } else if (exam_id <= 0) {
                $('#errorMsgD').text('Please select exam');
                $('.submitBtn').removeAttr("disabled");
            } else if (level <= 0) {
                $('#errorMsgD').text('Please select exam level');
                $('.submitBtn').removeAttr("disabled");
            } else {
                $.post(dash_url+"/controller/exam_test_controller.php", {flowtype:flowtype, exam_id:exam_id, subject_id:subject_id, chapter_id:chapter_id, level:level, name:name, instruction:instruction},function(data) {
                    var result = jQuery.parseJSON(data);
                    if(result.status == 'success') {
                        $('.submitBtn').removeAttr("disabled");
                        $('#errorMsgD').css('color', 'green').html('Test Created Successfully');
                        $("#errorMsgD").fadeOut(1000, function () {        
                            setTimeout(function(){ window.location.href = dash_url+'/create-exam-test?id='+result.id+'&q=1'; }, 1500);     
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