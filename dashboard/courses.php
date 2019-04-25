<?php
session_start();
/*-------------------     Include File Start      ---------------*/
include_once("config.php");
include_once("global.php");
include_once("./class/courses_class.php");
include_once("./class/child_category_class.php");

/*-------------------     Include File End      ---------------*/

if(!isset($_SESSION['id']) && empty($_SESSION['id'])) {
    header("Location: ".DASH_URL);
    die();  
}

/*-------------------     Class Object Start      ---------------*/

$Courses = new Courses();
$childCategory = new Child_Category();

/*-------------------     Class Object End      ---------------*/

$CourseId = 0; $btn = "Add";
$CourseDetailArray = array();
if(isset($_GET['type']) && (($_GET['type'] == 'add') || ($_GET['type'] == 'edit' && isset($_GET['id']) && !empty($_GET['id'])))) {
    if($_GET['type'] == 'edit') {
        $btn = "Save";
        $CourseId = base64_decode(trim($_GET['id']));
        $CourseDetailArray = $Courses->getCourseDetail($_SESSION['instituate_id'], $CourseId);
        if(is_array($CourseDetailArray) && empty($CourseDetailArray)) {
            header("Location: ".DASH_URL.'');
            die();
        }
    }
    
    $ChildCategoryArray = $childCategory->getListOfChildCategory($_SESSION['country_id']);

} else {
    header("Location: ".DASH_URL.'');
    die();
}

/*-------------------     Include Header and Left Menu     ---------------*/
include_once("layout/header.php");
include_once("layout/left-menu.php");
?>

<title><?=$_GET['type']?> Course | Ecoaching.guru | Your Online Coaching Guru</title>
<section id="main__content">
    <div class="action-header-alt">
        <a class="action-header__item action-header__back" href="<?=DASH_URL?>/courses-list">
            <i class="zmdi zmdi-long-arrow-left"></i> Back to Courses list
        </a>
    </div>

    <div class="main__container main__container-sm">
        <header class="main__title" style="padding:0px;">
            <h2><?=$_GET['type']?> New Course</h2>
        </header>

        <form class="card new-contact" id="AddCourseForm">
            <input type="hidden" name="flowtype" id="flowtype" value="1">
            <input type="hidden" name="course_id" id="course_id" value="<?=base64_encode($CourseId)?>">
            <input type="hidden" name="type" id="type" value="<?=trim($_GET['type'])?>">

            <div class="card__body">
                <div class="row">

                    <div class="col-sm-6">
                        <div class="form-group">
                            <select name="child_category_id" id="child_category_id" class="select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                            <option value="0">Search Course</option>
                            <?php foreach ($ChildCategoryArray as $key => $value) {
                                if($value['id'] == $CourseDetailArray['child_category_id']) $select = "selected"; else $select = "";
                                echo '<option value="'.$value['id'].'" '.$select.'>'.$value['name'].'</option>';
                            }
                            ?>
                            </select>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group form-group--float">
                            <input type="number" name="duration" id="duration" min="1" class="form-control" value="<?=$CourseDetailArray['duration']?>">
                            <label class="asterikCls">Duration (In Weeks)</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group form-group--float">
                            <input type="number" name="price" id="price" min="1" class="form-control" value="<?=$CourseDetailArray['price']?>">
                            <label>Price</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group form-group--float">
                            <input type="number" name="avg_no_student" id="avg_no_student" min="1" class="form-control" value="<?=$CourseDetailArray['avg_no_student']?>">
                            <label>Batch Size</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group form-group--float">
                            <input type="text" name="description" id="description" class="form-control" value="<?=$CourseDetailArray['description']?>">
                            <label>Course Description</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group form-group--float">
                            <input type="text" name="teaching_pattern" id="teaching_pattern" class="form-control" value="<?=$CourseDetailArray['teaching_pattern']?>">
                            <label>Teaching Pattern(eg. Test series, Monthly quiz)</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                </div>
                <p style="color:red;" id = "errorMsgD"></p>
                <div class="clearfix"></div>
                <div class="m-t-20">
                    <button type="submit" class="btn btn-primary submitBtn"><?=$btn?> Course</button>
                    <a class="btn btn-link" href="<?=DASH_URL?>/courses-list">Cancel</a>
                </div>
            </div>
        </form>

    </div>
</section>

<script type="text/javascript">
    $(document).ready(function() {         

        var dash_url = '<?=DASH_URL?>';
        $(document).on("submit", "form#AddCourseForm", function() {
            $(".submitBtn").attr("disabled", "disabled");
            var type = $('#type').val();
            var flowtype = $('#flowtype').val();
            var course_id = $('#course_id').val();
            var child_category_id = $('#child_category_id').val();
            var price = $('#price').val();
            var duration = $('#duration').val();
            var avg_no_student = $('#avg_no_student').val();
            var description = $('#description').val();
            var teaching_pattern = $('#teaching_pattern').val();
            if(!child_category_id || child_category_id == 0) {
                $('#errorMsgD').text('Please enter course');
                $('.submitBtn').removeAttr("disabled");
            } else if (!duration || duration == 0) {
                $('#errorMsgD').text('Please enter duration');
                $('.submitBtn').removeAttr("disabled");
            } else if (!price || price == 0) {
                $('#errorMsgD').text('Please enter price');
                $('.submitBtn').removeAttr("disabled");
            } else if (!avg_no_student || avg_no_student == 0) {
                $('#errorMsgD').text('Please enter batch size');
                $('.submitBtn').removeAttr("disabled");
            } else {
                $.post(dash_url+"/controller/courses_controller.php", {type:type, flowtype:flowtype, course_id:course_id, child_category_id:child_category_id, price:price, duration:duration, avg_no_student:avg_no_student, description:description, teaching_pattern:teaching_pattern},function(data) {
                    var result = jQuery.parseJSON(data);
                    if(result.status == 'success') {
                        $('.submitBtn').removeAttr("disabled");
                        $('#errorMsgD').css('color', 'green').html('Update Successfully');
                        $("#errorMsgD").fadeOut(1000, function () {        
                            setTimeout(function(){ window.location.href = dash_url+'/courses-list'; }, 1500);     
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