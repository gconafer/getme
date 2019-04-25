<?php
session_start();
/*-------------------     Include File Start      ---------------*/
include_once("config.php");
include_once("global.php");
include_once("./class/batch_class.php");
include_once("./class/courses_class.php");

/*-------------------     Include File End      ---------------*/

if(!isset($_SESSION['id']) && empty($_SESSION['id'])) {
    header("Location: ".DASH_URL);
    die();  
}

/*-------------------     Class Object Start      ---------------*/

$Batch = new Batch();
$Courses = new Courses();

/*-------------------     Class Object End      ---------------*/

$BatchId = 0; $btn = "Add";
$BatchDetailArray = array();
$BatchDetailArray['description'] = '';
$BatchDetailArray['start_date'] = date('m/d/Y');
if(isset($_GET['type']) && (($_GET['type'] == 'add') || ($_GET['type'] == 'edit' && isset($_GET['id']) && !empty($_GET['id'])))) {
    if($_GET['type'] == 'edit') {
        $btn = "Save";
        $BatchId = base64_decode(trim($_GET['id']));
        $BatchDetailArray = $Batch->getBatchDetail($_SESSION['instituate_id'], $BatchId);
        if(is_array($BatchDetailArray) && empty($BatchDetailArray)) {
            header("Location: ".DASH_URL.'');
            die();
        }
    }

    $CoursesArray = $Courses->getCoursesByInstituateId($_SESSION['instituate_id']);

} else {
    header("Location: ".DASH_URL.'');
    die();
}

/*-------------------     Include Header and Left Menu     ---------------*/
include_once("layout/header.php");
include_once("layout/left-menu.php");
?>

<title><?=$_GET['type']?> Batch | Ecoaching.guru | Your Online Coaching Guru</title>
<link rel="stylesheet" href="<?=ABS_CSS_URL?>/jquery-datepicker-min.css">

<section id="main__content">
    <div class="action-header-alt">
        <a class="action-header__item action-header__back" href="<?=DASH_URL?>/batch-list">
            <i class="zmdi zmdi-long-arrow-left"></i> Back to Batch list
        </a>
    </div>

    <div class="main__container main__container-sm">
        <header class="main__title" style="padding:0px;">
            <h2><?=$_GET['type']?> Batch</h2>
        </header>

        <form class="card new-contact" id="AddBatchForm">
            <input type="hidden" name="flowtype" id="flowtype" value="1">
            <input type="hidden" name="batch_id" id="batch_id" value="<?=base64_encode($BatchId)?>">
            <input type="hidden" name="type" id="type" value="<?=trim($_GET['type'])?>">

            <div class="card__body">
                <div class="row">

                    <div class="col-sm-12">
                        <div class="form-group">
                            <select name="course_id" id="course_id" class="select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                            <option value="0">Search Course</option>
                            <?php foreach ($CoursesArray as $key => $value) {
                                if($value['id'] == $BatchDetailArray['course_id']) $select = "selected"; else $select = "";
                                echo '<option value="'.$value['id'].'" '.$select.'>'.ucfirst($value['cname']).'</option>';
                            }
                            ?>
                            </select>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group form-group--float">
                            <input type="text" name="start_date" id="start_date" class="form-control" value="<?=date('m/d/Y', strtotime($BatchDetailArray['start_date']))?>">
                            <label class="asterikCls">Batch Start Date</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <select name="timing" id="timing" class="select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                <option value="0">Select Batch Timing</option>
                                <option value="1" <?php if($BatchDetailArray['timing'] == 1) echo 'selected'; ?>>Morning</option>
                                <option value="2" <?php if($BatchDetailArray['timing'] == 2) echo 'selected'; ?>>Afternoon</option>
                                <option value="2" <?php if($BatchDetailArray['timing'] == 3) echo 'selected'; ?>>Evening</option>
                                <option value="2" <?php if($BatchDetailArray['timing'] == 4) echo 'selected'; ?>>Night</option>
                            </select>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group form-group--float">
                            <input type="number" name="class_duration" id="class_duration" min="1" class="form-control" value="<?=$BatchDetailArray['class_duration']?>">
                            <label>Class Duration (In Hrs)</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group form-group--float">
                            <input type="number" name="duration" id="duration" min="1" class="form-control" value="<?=$BatchDetailArray['duration']?>">
                            <label class="asterikCls">Batch Duration (In Weeks)</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group form-group--float">
                            <textarea name="description" id="description" class="form-control textarea-autoheight" style="overflow: hidden; overflow-wrap: break-word; height: 44px;">
                                <?=$BatchDetailArray['description']?>
                            </textarea>
                            <label>Description</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>
                </div>
                <p style="color:red;" id = "errorMsgD"></p>
                <div class="clearfix"></div>
                <div class="m-t-20">
                    <button type="submit" class="btn btn-primary submitBtn"><?=$btn?> Batch</button>
                    <a class="btn btn-link" href="<?=DASH_URL?>/batch-list">Cancel</a>
                </div>
            </div>
        </form>

    </div>
</section>

<script src="<?=ABS_JS_URL?>/jquery-datepicker-min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {         

        var dash_url = '<?=DASH_URL?>';
        $('#start_date').datepicker();

        $(document).on("submit", "form#AddBatchForm", function() {
            $(".submitBtn").attr("disabled", "disabled");
            var type = $('#type').val();
            var flowtype = $('#flowtype').val();
            var batch_id = $('#batch_id').val();
            var course_id = $('#course_id').val();
            var start_date = $('#start_date').datepicker("getDate");
            var timing = $('#timing').val();
            var class_duration = $('#class_duration').val();
            var duration = $('#duration').val();
            var description = $('#description').val();
            if(!course_id || course_id == 0) {
                $('#errorMsgD').text('Please select course');
                $('.submitBtn').removeAttr("disabled");
            } else if (!start_date) {
                $('#errorMsgD').text('Please enter Batch start date');
                $('.submitBtn').removeAttr("disabled");
            } else if (!timing || timing == 0) {
                $('#errorMsgD').text('Please enter batch timing');
                $('.submitBtn').removeAttr("disabled");
            } else if (!duration || duration == 0) {
                $('#errorMsgD').text('Please enter batch duration');
                $('.submitBtn').removeAttr("disabled");
            } else {
                $.post(dash_url+"/controller/batch_controller.php", {type:type, flowtype:flowtype, batch_id:batch_id, course_id:course_id, start_date:start_date, timing:timing, class_duration:class_duration, duration:duration, description:description},function(data) {
                    var result = jQuery.parseJSON(data);
                    if(result.status == 'success') {
                        $('.submitBtn').removeAttr("disabled");
                        $('#errorMsgD').css('color', 'green').html('Update Successfully');
                        $("#errorMsgD").fadeOut(1000, function () {        
                            setTimeout(function(){ window.location.href = dash_url+'/batch-list'; }, 1500);     
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