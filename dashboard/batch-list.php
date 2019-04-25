<?php
session_start();
/*-------------------     Include File Start      ---------------*/
include_once("config.php");
include_once("global.php");
include_once("./class/batch_class.php");

/*-------------------     Include File End      ---------------*/

if(!isset($_SESSION['id']) && empty($_SESSION['id'])) {
    header("Location: ".DASH_URL);
    die();  
}

/*-------------------     Class Object Start      ---------------*/

$Batch = new Batch();

/*-------------------     Class Object End      ---------------*/

$BatchArray = $Batch->getBatchByInstituateId($_SESSION['instituate_id']);
$CountBatch = $Batch->getCountBatchByInstituateId($_SESSION['instituate_id']);
$countAvtar = count($AVTAR_IMG_Array);

/*-------------------     Include Header and Left Menu     ---------------*/
include_once("layout/header.php");
include_once("layout/left-menu.php");
?>

<title>Batch List| Ecoaching.guru | Your Online Coaching Guru</title>
<section id="main__content">
    <div class="action-header-alt">
        <div class="action-header__item action-header__item--search hide">
            <form>
                <input type="text" placeholder="Search for contacts...">
            </form>
        </div>

        <div class="action-header__item action-header__add">
            <a href="<?=DASH_URL?>/batch?type=add" class="btn btn-danger btn-sm">Add New Batch</a>
        </div>
    </div>

    <div class="main__container">
        <header class="main__title" style="padding:0px;">
            <h2>Batch List: </h2>
        </header>

        <div class="row">
            <div class="col-md-12">
                <div class="list-group list-group--block contact-lists">
                    <?php if(is_array($BatchArray) && !empty($BatchArray)) { ?>
                    <div class="list-group__header text-left">
                        <?=$CountBatch?> Total Batch
                    </div>
                    <?php foreach ($BatchArray as $key => $value) {
                    ?>
                        <div class="list-group__wrap">
                            <a class="list-group-item media" href="<?=DASH_URL?>/batch-list">
                                <div class="pull-left">
                                    <div class="pull-left">
                                        <div class="avatar-char mdc-bg-<?=$AVTAR_IMG_Array[$key]?>-400"><?=strtoupper($value['name'][0])?></div>
                                    </div>
                                </div>
                                <div class="media-body list-group__text">
                                    <h4><?=$value['name']?></h4>
                                    <div class="list-group__attrs">
                                        <div><b>Start Date:</b>&nbsp;<?=date('d M Y', strtotime($value['start_date']))?></div>
                                        <div><b>Duration (In Weeks):</b>&nbsp;<?=$value['duration']?></div>
                                        <div><b>Timing:</b>&nbsp;<?=$BATCH_TIMING[$value['timing']]?></div>
                                    </div>
                                </div>
                            </a>
                            <div class="actions list-group__actions">
                                <div class="dropdown">
                                    <a href="<?=DASH_URL?>/batch-list" data-toggle="dropdown"><i class="zmdi zmdi-more-vert"></i></a>
                                    
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="<?=DASH_URL?>/batch?type=edit&id=<?=base64_encode($value['id'])?>">Edit</a></li>
                                        <li><a href="<?=DASH_URL?>/batch-list" id="<?=base64_encode($value['id'])?>####<?=ucfirst($value['name'])?>" data-demo-action="delete-listing">Delete</a></li>
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
                    text: "You want to delete <b>"+Id[1]+"</b> batch.",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    showLoaderOnConfirm: true,
                    preConfirm: function() {
                        return new Promise(function(resolve) {
                            setTimeout(function() {
                                $.ajax({
                                    url: dash_url+"/controller/batch_controller.php",
                                    type: "POST",
                                    data: {batch_id: Id[0], flowtype:2},
                                    dataType: "json",
                                    success: function (response) {
                                        if(response.status == 'success') {
                                            swal('Done!','Batch detail has been deleted.','success').then(function() { window.location = dash_url+"/batch-list"; });
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