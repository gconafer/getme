<?php
session_start();
/*-------------------     Include File Start      ---------------*/
include_once("config.php");
include_once("global.php");
include_once("./class/teacher_class.php");

/*-------------------     Include File End      ---------------*/

if(!isset($_SESSION['id']) && empty($_SESSION['id'])) {
    header("Location: ".DASH_URL);
    die();  
}

/*-------------------     Class Object Start      ---------------*/

$Teacher = new Teacher();

/*-------------------     Class Object End      ---------------*/

$TeacherId = 0; $btn = "Add";
$TeacherDetailArray = array();
if(isset($_GET['type']) && (($_GET['type'] == 'add') || ($_GET['type'] == 'edit' && isset($_GET['id']) && !empty($_GET['id'])))) {
    if($_GET['type'] == 'edit') {
        $btn = "Save";
        $TeacherId = base64_decode(trim($_GET['id']));
        $TeacherDetailArray = $Teacher->getTeacherDetail($_SESSION['instituate_id'], $TeacherId);
        if(is_array($TeacherDetailArray) && empty($TeacherDetailArray)) {
            header("Location: ".DASH_URL.'');
            die();
        }
    }
} else {
    header("Location: ".DASH_URL.'');
    die();
}

/*-------------------     Include Header and Left Menu     ---------------*/
include_once("layout/header.php");
include_once("layout/left-menu.php");
?>

<title><?=$_GET['type']?> Teacher | Ecoaching.guru | Your Online Coaching Guru</title>
<section id="main__content">
    <div class="action-header-alt">
        <a class="action-header__item action-header__back" href="<?=DASH_URL?>/teacher-list">
            <i class="zmdi zmdi-long-arrow-left"></i> Back to Teacher list
        </a>
    </div>

    <div class="main__container main__container-sm">
        <header class="main__title" style="padding:0px;">
            <h2><?=$_GET['type']?> New Teacher</h2>
        </header>

        <form class="card new-contact" id="AddTeacherForm">
            <input type="hidden" name="flowtype" id="flowtype" value="1">
            <input type="hidden" name="teacher_id" id="teacher_id" value="<?=base64_encode($TeacherId)?>">
            <input type="hidden" name="type" id="type" value="<?=trim($_GET['type'])?>">
            <div class="new-contact__img hide">
                <img src="./Roost - Material Design Real Estate_add_contact_files/user_empty.png" alt="">
                <i class="new-contact__upload zmdi zmdi-camera"></i>
            </div>

            <div class="card__body">
                <div class="row">

                    <div class="col-sm-2">
                        <div class="form-group form-group--float">
                            <input type="text" name="designation" id="designation" class="form-control" value="<?=$TeacherDetailArray['designation']?>">
                            <label>Designation</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    <div class="col-sm-5">
                        <div class="form-group form-group--float">
                            <input type="text" name="first_name" id="first_name" class="form-control" value="<?=$TeacherDetailArray['first_name']?>">
                            <label class="asterikCls">First Name</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    <div class="col-sm-5">
                        <div class="form-group form-group--float">
                            <input type="text" name="last_name" id="last_name" class="form-control" value="<?=$TeacherDetailArray['last_name']?>">
                            <label>Last Name</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group form-group--float">
                            <input type="text" name="qualtification" id="qualtification" class="form-control" value="<?=$TeacherDetailArray['qualtification']?>">
                            <label>Qualtification</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group form-group--float">
                            <input type="number" name="experience" id="experience" min="1" class="form-control" value="<?=$TeacherDetailArray['experience']?>">
                            <label class="asterikCls">Experience (in years)</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <select name="gender" id="gender" class="select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                <option value="0">Select Gender</option>
                                <option value="1" <?php if($TeacherDetailArray['gender'] == 1) echo 'selected'; ?>>Male</option>
                                <option value="2" <?php if($TeacherDetailArray['gender'] == 2) echo 'selected'; ?>>Female</option>
                            </select>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <select name="age" id="age" class="select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                <option value="0">Select Birth Year (for age)</option>
                                <?php
                                for ($i=2018; $i>1950; $i--) { 
                                    if($TeacherDetailArray['age'] == $i) $select = "selected"; else $select = "";
                                    echo "<option value='".$i."' ".$select.">".$i."</option>";
                                }
                                ?>
                            </select>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    
                    <div class="col-sm-12">
                        <div class="form-group form-group--float">
                            <input type="text" name="subject" id="subject" class="form-control" value="<?=$TeacherDetailArray['subject']?>">
                            <label class="asterikCls">Subjects</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group form-group--float">
                            <input type="text" name="achivements" id="achivements" class="form-control" value="<?=$TeacherDetailArray['achivements']?>">
                            <label>Achivements</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group form-group--float">
                            <input type="text" name="fb_url" id="fb_url" class="form-control" value="<?=$TeacherDetailArray['fb_url']?>">
                            <label>Facebook profile url</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group form-group--float">
                            <input type="text" name="linkedin_url" id="linkedin_url" class="form-control" value="<?=$TeacherDetailArray['linkedin_url']?>">
                            <label>Linkedin profile url</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group form-group--float">
                            <input type="text" name="yt_url" id="yt_url" class="form-control" value="<?=$TeacherDetailArray['yt_url']?>">
                            <label>Youtube video url (if multiple videos then separate by comma)</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>
                </div>
                <p style="color:red;" id = "errorMsgD"></p>
                <div class="clearfix"></div>
                <div class="m-t-20">
                    <button type="submit" class="btn btn-primary submitBtn"><?=$btn?> Teacher</button>
                    <a class="btn btn-link" href="<?=DASH_URL?>/teacher-list">Cancel</a>
                </div>
            </div>
        </form>

    </div>
</section>

<script type="text/javascript">
    $(document).ready(function() {         

        var dash_url = '<?=DASH_URL?>';
        $(document).on("submit", "form#AddTeacherForm", function() {
            $(".submitBtn").attr("disabled", "disabled");
            var type = $('#type').val();
            var flowtype = $('#flowtype').val();
            var teacher_id = $('#teacher_id').val();
            var designation = $('#designation').val();
            var first_name = $('#first_name').val();
            var last_name = $('#last_name').val();
            var qualtification = $('#qualtification').val();
            var experience = $('#experience').val();
            var gender = $('#gender').val();
            var age = $('#age').val();
            var subject = $('#subject').val();
            var achivements = $('#achivements').val();
            var fb_url = $('#fb_url').val();
            var linkedin_url = $('#linkedin_url').val();
            var yt_url = $('#yt_url').val();
            if(!first_name) {
                $('#errorMsgD').text('Please enter first name');
                $('.submitBtn').removeAttr("disabled");
            } else if (!experience || experience == 0) {
                $('#errorMsgD').text('Please enter experience');
                $('.submitBtn').removeAttr("disabled");
            } else if (!subject) {
                $('#errorMsgD').text('Please enter subject');
                $('.submitBtn').removeAttr("disabled");
            } else {
                $.post(dash_url+"/controller/teacher_controller.php", {type:type, flowtype:flowtype, teacher_id:teacher_id, designation:designation, first_name:first_name, last_name:last_name, qualtification:qualtification, experience:experience, gender:gender, age:age, subject:subject, achivements:achivements, fb_url:fb_url, linkedin_url:linkedin_url, yt_url:yt_url},function(data) {
                    var result = jQuery.parseJSON(data);
                    if(result.status == 'success') {
                        $('.submitBtn').removeAttr("disabled");
                        $('#errorMsgD').css('color', 'green').html('Update Successfully');
                        $("#errorMsgD").fadeOut(1000, function () {        
                            setTimeout(function(){ window.location.href = dash_url+'/teacher-list'; }, 1500);     
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