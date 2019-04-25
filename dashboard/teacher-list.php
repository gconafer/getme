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

$TeacherArray = $Teacher->getTeacherByInstituateId($_SESSION['instituate_id']);
$CountTeacher = $Teacher->getCountTeacherByInstituateId($_SESSION['instituate_id']);

$countAvtar = count($AVTAR_IMG_Array);

/*-------------------     Include Header and Left Menu     ---------------*/
include_once("layout/header.php");
include_once("layout/left-menu.php");
?>

<title>Teacher List| Ecoaching.guru | Your Online Coaching Guru</title>
<section id="main__content">
    <div class="action-header-alt">
        <div class="action-header__item action-header__item--search hide">
            <form>
                <input type="text" placeholder="Search for contacts...">
            </form>
        </div>

        <div class="action-header__item action-header__add">
            <a href="<?=DASH_URL?>/teacher?type=add" class="btn btn-danger btn-sm">Add New Teacher</a>
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
            <h2>Teacher List: </h2>
        </header>

        <div class="row">
            <div class="col-md-12">
                <div class="list-group list-group--block contact-lists">
                    <?php if(is_array($TeacherArray) && !empty($TeacherArray)) { ?>
                    <div class="list-group__header text-left">
                        <?=$CountTeacher?> Total Teachers
                    </div>
                    <?php foreach ($TeacherArray as $key => $value) { 
                            $index = $value['id']%$countAvtar;
                            if(!empty($value['designation'])) {
                                $name = $value['designation'].' '.$value['first_name'].' '.$value['last_name'];
                            } else {
                                $name = $value['first_name'].' '.$value['last_name'];
                            }
                    ?>
                        <div class="list-group__wrap">
                            <a class="list-group-item media" href="<?=DASH_URL?>/teacher-list">
                                <div class="pull-left">
                                    <?php if(!empty(trim($value['image']))) { ?>
                                        <img src="<?=ABS_T_IMG_URL?>/<?=$value['image']?>" alt="<?=$name?>" class="list-group__img img-circle" width="60">
                                    <?php } else { ?>
                                        <div class="pull-left">
                                            <div class="avatar-char mdc-bg-<?=$AVTAR_IMG_Array[$index]?>-400"><?=strtoupper($value['first_name'][0])?></div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="media-body list-group__text">
                                    <strong><?=ucfirst($name)?></strong>
                                    <div class="list-group__attrs">
                                        <div><b>Experience:</b>&nbsp;<?php if($value['experience']) echo $value['experience']; else echo 'N/A'; ?> Years</div>
                                        <div><b>Qualification:</b>&nbsp;<?php if($value['qualtification']) echo $value['qualtification']; else echo 'N/A'; ?></div>
                                        <div><b>Gender:</b>&nbsp;<?php if($value['gender'] == 1) echo 'M'; elseif ($value['gender'] == 2) echo 'F'; else echo 'N/A'; ?></div>
                                        <div><b>Subject:</b>&nbsp;<?php if($value['subject']) echo $value['subject']; else echo 'N/A'; ?></div>
                                    </div>
                                </div>
                            </a>
                            <div class="actions list-group__actions">
                                <div class="dropdown">
                                    <a href="<?=DASH_URL?>/teacher-list" data-toggle="dropdown"><i class="zmdi zmdi-more-vert"></i></a>

                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="<?=DASH_URL?>/teacher?type=edit&id=<?=base64_encode($value['id'])?>">Edit</a></li>
                                        <li><a href="<?=DASH_URL?>/teacher-list" id="<?=base64_encode($value['id'])?>####<?=ucfirst($name)?>" data-demo-action="delete-listing">Delete</a></li>
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
                    text: "You want to delete <b>"+Id[1]+"</b>.",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    showLoaderOnConfirm: true,
                    preConfirm: function() {
                        return new Promise(function(resolve) {
                            setTimeout(function() {
                                $.ajax({
                                    url: dash_url+"/controller/teacher_controller.php",
                                    type: "POST",
                                    data: {teacher_id: Id[0], flowtype:2},
                                    dataType: "json",
                                    success: function (response) {
                                        if(response.status == 'success') {
                                            swal('Done!','Teacher detail has been deleted.','success').then(function() { window.location = dash_url+"/teacher-list"; });
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