<?php
session_start();
/*-------------------     Include File Start      ---------------*/
include_once("config.php");
include_once("global.php");
include_once("./class/courses_class.php");
include_once("./class/teacher_class.php");
include_once("./class/instituate_class.php");

/*-------------------     Include File End      ---------------*/

if(!isset($_SESSION['id']) && empty($_SESSION['id'])) {
    header("Location: ".DASH_URL);
    die();  
}

/*-------------------     Class Object Start      ---------------*/

$Courses = new Courses();
$Teacher = new Teacher();
$Instituate = new Instituate();

/*-------------------     Class Object End      ---------------*/

$InstituateArray = $Instituate->getInstituateById($_SESSION['instituate_id']);
$TeacherArray = $Teacher->getTeacherByInstituateId($_SESSION['instituate_id']);
$CoursesArray = $Courses->getCoursesByInstituateId($_SESSION['instituate_id']);

$countAvtar = count($AVTAR_IMG_Array);

/*-------------------     Include Header and Left Menu     ---------------*/
include_once("layout/header.php");
include_once("layout/left-menu.php");
?>

<title> Dashboard | Ecoaching.guru | Your Online Coaching Guru</title>

<section id="main__content">
    <div class="quick-stats clearfix">
        <div class="col-md-6 col-sm-6 hidden-xs">
            <div class="quick-stats__item">
                <div class="quick-stats__list">
                    <h3><?php if(is_array($CoursesArray) && !empty($CoursesArray)) echo count($CoursesArray); else echo 0; ?></h3>
                    <small>Total Courses<span class="pull-right"><a href="<?=DASH_URL?>/courses-list">view more</a></span></small>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-6 hidden-sm hidden-xs">
            <div class="quick-stats__item">
                <div class="quick-stats__list">
                    <h3><?php if(is_array($TeacherArray) && !empty($TeacherArray)) echo count($TeacherArray); else echo 0; ?></h3>
                    <small>Total Teacher<span class="pull-right"><a href="<?=DASH_URL?>/teacher-list">view more</a></span></small>
                </div>
            </div>
        </div>
    </div>

    <div class="main__container">
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card__header" style="padding: 30px 35px 0px 35px;">
                        <h2>Institute Detail</h2>
                    </div>
                    <hr>
                    <div class="list-group">
                        <a href="<?=DASH_URL?>/institute?type=edit" class="list-group-item media" style="padding:0px 25px 0px 25px;">
                            <div class="media-body list-group__text">
                                <div><b>Institute Name:</b>&nbsp;&nbsp;<small><?php if(!empty($InstituateArray['name'])) echo $InstituateArray['name']; else echo 'N/A'; ?></small></div>
                                <div><b>Contact Email:</b>&nbsp;&nbsp;<small><?php if(!empty($InstituateArray['contact_email'])) echo $InstituateArray['contact_email']; else echo 'N/A'; ?></small></div>
                                <div><b>Contact No:</b>&nbsp;&nbsp;<small><?php if(!empty($InstituateArray['contact_no'])) echo $InstituateArray['contact_no']; else echo 'N/A'; ?></small></div>
                                <div><b>Founded:</b>&nbsp;&nbsp;<small><?php if(!empty($InstituateArray['founded'])) echo $InstituateArray['founded']; else echo 'N/A'; ?></small></div>
                                <div><b>Working Days:</b>&nbsp;&nbsp;<small><?php if(!empty($InstituateArray['working_days'])) echo $InstituateArray['working_days']; else echo 'N/A'; ?></small></div>
                                <div><b>Website url:</b>&nbsp;&nbsp;<small><?php if(!empty($InstituateArray['website_url'])) echo $InstituateArray['website_url']; else echo 'N/A'; ?></small></div>
                                <div><b>Fb Page url:</b>&nbsp;&nbsp;<small><?php if(!empty($InstituateArray['fb_page_url'])) echo $InstituateArray['fb_page_url']; else echo 'N/A'; ?></small></div>
                                <div><b>Address:</b>&nbsp;&nbsp;<small><?php if(!empty($InstituateArray['address'])) echo $InstituateArray['address']; else echo 'N/A'; ?></small></div>
                                <div><b>No of Teacher:</b>&nbsp;&nbsp;<small><?php if(!empty($InstituateArray['no_of_teachers'])) echo $InstituateArray['no_of_teachers']; else echo 'N/A'; ?></small></div>
                            </div>
                        </a>
                        <hr>
                        <a class="view-more" href="<?=DASH_URL?>/institute?type=edit">
                            Edit Institute Detail
                        </a>
                    </div>
                </div>

                <div class="list-group list-group--block contact-lists">
                    <div class="card__header" style="padding: 30px 35px 0px 35px;">
                        <h2>Courses List</h2>
                    </div>
                    <hr>
                    <div class="card__body">
                        <ul class="detail-amenities__list">
                        <?php
                            foreach ($CoursesArray as $k => $v) {
                                $index = $k%$countAvtar;
                                echo '<li class="mdc-bg-'.$AVTAR_IMG_Array[$index].'-400"><i class="zmdi zmdi-check-all hidden-xs"></i>&nbsp;'.trim(ucwords($v['cname'])).'</li>&nbsp;&nbsp;';
                            }
                        ?>
                        </ul>
                    </div>
                    <hr>
                    <a class="view-more" href="<?=DASH_URL?>/courses-list">
                        View Courses list
                    </a>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card">
                    <div class="card__header" style="padding: 30px 35px 0px 35px;">
                        <h2>Teacher List</h2>
                    </div>
                    <hr>
                    <div class="list-group tasks-lists">
                    <?php foreach ($TeacherArray as $key => $value) {
                            $index = $value['id']%$countAvtar;
                            if(!empty($value['designation'])) {
                                $name = $value['designation'].' '.$value['first_name'].' '.$value['last_name'];
                            } else {
                                $name = $value['first_name'].' '.$value['last_name'];
                            }
                    ?>
                        <div class="list-group-item media">
                            <div class="pull-left">
                            <?php if(!empty(trim($value['image']))) { ?>
                                <img src="<?=ABS_T_IMG_URL?>/<?=$value['image']?>" alt="<?=$name?>" class="list-group__img" width="60">
                            <?php } else { ?>
                                <div class="pull-left">
                                    <div class="avatar-char mdc-bg-<?=$AVTAR_IMG_Array[$index]?>-400"><?=strtoupper($value['first_name'][0])?></div>
                                </div>
                            <?php } ?>
                            </div>

                            <div class="media-body list-group__text">
                                <strong><a href="#"><?=ucfirst($name)?></a></strong>
                                <small><b>Experience:</b>&nbsp;<?php if($value['experience']) echo $value['experience']; else echo 'N/A'; ?> Years,&nbsp;<b>Qualification:</b>&nbsp;<?php if($value['qualtification']) echo $value['qualtification']; else echo 'N/A'; ?></small>
                                <small><b>Subjects:</b> <?=$value['subject']?></small>
                            </div>
                        </div>
                    <?php } ?>
                        <hr>
                        <a class="view-more" href="<?=DASH_URL?>/teacher-list">
                            View Teacher list
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include_once("layout/footer.php"); ?>