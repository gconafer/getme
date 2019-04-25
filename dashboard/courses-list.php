<?php
session_start();
/*-------------------     Include File Start      ---------------*/
include_once("config.php");
include_once("global.php");
include_once("./class/courses_class.php");

/*-------------------     Include File End      ---------------*/

if(!isset($_SESSION['id']) && empty($_SESSION['id'])) {
    header("Location: ".DASH_URL);
    die();  
}

/*-------------------     Class Object Start      ---------------*/

$Courses = new Courses();

/*-------------------     Class Object End      ---------------*/

$CoursesArray = $Courses->getCoursesByInstituateId($_SESSION['instituate_id']);
$CountCourses = $Courses->getCountCoursesByInstituateId($_SESSION['instituate_id']);

/*-------------------     Include Header and Left Menu     ---------------*/
include_once("layout/header.php");
include_once("layout/left-menu.php");
?>

<title>Courses List | Ecoaching.guru | Your Online Coaching Guru</title>
<section id="main__content">
    <div class="action-header-alt">
        <div class="action-header__item action-header__item--search hide">
            <form>
                <input type="text" placeholder="Search for contacts...">
            </form>
        </div>

        <div class="action-header__item action-header__add">
            <a href="<?=DASH_URL?>/courses?type=add" class="btn btn-danger btn-sm">Add New Course</a>
        </div>

        <div class="action-header__item action-header__item--sort hidden-xs hide">
            <span class="action-header__small">Sort by :</span>

            <select class="select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                <option>Names: A to Z</option>
                <option>Names: Z to A</option>
                <option>Frequently Contacted</option>
            </select>
        </div>
    </div>

    <div class="main__container">
        <header class="main__title" style="padding:0px;">
            <h2>Courses List: </h2>
        </header>

        <div class="row">
            <div class="col-md-12">
                <div class="list-group list-group--block contact-lists">
                    <?php if(is_array($CoursesArray) && !empty($CoursesArray)) { ?>
                    <div class="list-group__header text-left">
                        <?=$CountCourses?> Total Courses
                    </div>
                    <?php foreach ($CoursesArray as $key => $value) { 
                    ?>
                        <div class="list-group__wrap">
                            <a class="list-group-item media" href="<?=DASH_URL?>/courses-list">
                                <div class="media-body list-group__text">
                                    <h4><?=ucfirst($value['cname'])?></h4>
                                    <div class="list-group__attrs">
                                        <div><b>Category&nbsp;:</b>&nbsp;<?php if($value['mname']) echo $value['mname']; else echo 'N/A'; ?></div>
                                        <div><b>Price:</b>&nbsp;<?php if($value['price']) echo $value['price']; else echo 'N/A'; ?></div>
                                        <div><b>Duration (In Weeks):</b>&nbsp;<?php if($value['duration']) echo $value['duration']; else echo 'N/A'; ?></div>
                                        <div><b>Batch Size:</b>&nbsp;<?php if($value['avg_no_student']) echo $value['avg_no_student']; else echo 'N/A'; ?></div>
                                    </div>
                                </div>
                            </a>
                            <div class="actions list-group__actions">
                                <div class="dropdown">
                                    <a href="<?=DASH_URL?>/courses-list" data-toggle="dropdown"><i class="zmdi zmdi-more-vert"></i></a>
                                    
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="<?=DASH_URL?>/courses?type=edit&id=<?=base64_encode($value['id'])?>">Edit</a></li>
                                        <li><a href="<?=DASH_URL?>/courses-list" id="<?=base64_encode($value['id'])?>####<?=ucfirst($value['cname'])?>" data-demo-action="delete-listing">Delete</a></li>
                                    </ul>
                                </div>
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
                    text: "You want to delete <b>"+Id[1]+"</b> Course.",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    showLoaderOnConfirm: true,
                    preConfirm: function() {
                        return new Promise(function(resolve) {
                            setTimeout(function() {
                                $.ajax({
                                    url: dash_url+"/controller/courses_controller.php",
                                    type: "POST",
                                    data: {course_id: Id[0], flowtype:2},
                                    dataType: "json",
                                    success: function (response) {
                                        if(response.status == 'success') {
                                            swal('Done!','Course has been deleted.','success').then(function() { window.location = dash_url+"/courses-list"; });
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