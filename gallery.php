<?php
session_start();
 /*-------------------     Include File Start      ---------------*/
 include_once("config.php");
 include_once("global.php");
 include_once("./class/student_class.php");

// include_once("./class/instituate_class.php");

// /*-------------------     Include File End      ---------------*/

if(!isset($_SESSION['id']) && empty($_SESSION['id'])) {
    header("Location: ".DASH_URL);
    die();  
}

// /*-------------------     Class Object Start      ---------------*/

$Student = new Student();

$arrayF = $Student->getStudentById($_SESSION['id'], $_SESSION['type']);

if ($_SESSION['type']) {
    $page = 'e_form.php';
} else {
    $page = 'i_form.php';
}

$NM = $arrayF['formNumber'];


// $Instituate = new Instituate();

// /*-------------------     Class Object End      ---------------*/

// $countAvtar = count($AVTAR_IMG_Array);
// $InstituateArray = $Instituate->getInstituateById($_SESSION['instituate_id']);
// $GalleryDetailArray = $Gallery->getInstituteGalleryList($_SESSION['instituate_id']);
// if(!empty($InstituateArray['latitude']) && !empty($InstituateArray['longitude'])) { 
//     $zoomV = 15;
//     $latV = $InstituateArray['latitude'];
//     $longV = $InstituateArray['longitude'];
// } else { 
//     $zoomV = 4;
//     $latV = $LAT_LONG_ARRAY[$InstituateArray['country_id']]['lat'];
//     $longV = $LAT_LONG_ARRAY[$InstituateArray['country_id']]['long'];
// }

// /*-------------------     Include Header and Left Menu     ---------------*/

include_once("layout/dashboard-header.php");
include_once("layout/left-menu.php");
?>

<title> Profile</title>

<section id="main__content" style="padding-left: 250px;">
    <div class="main__container">

        <form class="card">
            <div class="card__body">
                <div class="row">
                    <div class="col-sm-11"></div>
                    <div class="col-sm-1"><a href="<?php echo ABS_URL; ?>/<?php echo $page; ?>?n=1" class="btn btn-sm btn-primary">Edit</a></div>
                </div>
                <div class="row">
                    <div class="col-sm-5"><h4>Phone:</h4></div>
                    <div class="col-sm-7"><?php echo $arrayF['contactNo']; ?></div>
                </div>
                <div class="row">
                    <div class="col-sm-5"><h4>Startup name:</h4></div>
                    <div class="col-sm-7"><?php echo $arrayF['startupName']; ?></div>
                </div>
                <div class="row">
                    <div class="col-sm-5"><h4>Website url:</h4></div>
                    <div class="col-sm-7"><?php echo $arrayF['websiteUrl']; ?></div>
                </div>
                <div class="row">
                    <div class="col-sm-5"><h4>No. Of Cofounder:</h4></div>
                    <div class="col-sm-7"><?php echo $arrayF['noOfCofounder']; ?></div>
                </div>
                <div class="row">
                    <div class="col-sm-5"><h4>No. Of Team Member:</h4></div>
                    <div class="col-sm-7"><?php echo $arrayF['noOfTeamMember']; ?></div>
                </div>
            </div>
        </form>

        <form class="card">
            <div class="card__body">
                <div class="row">
                    <div class="col-sm-11"></div>
                    <div class="col-sm-1"><a href="<?php echo ABS_URL; ?>/<?php echo $page; ?>?n=2" class="btn btn-sm btn-primary">Edit</a></div>
                </div>
                <div class="row">
                    <div class="col-sm-5"><h4>Is company registered?:</h4></div>
                    <div class="col-sm-7"><?php if($arrayF['registered'] == 1) echo 'Yes'; else 'No'; ?></div>
                </div>
                <div class="row">
                    <div class="col-sm-5"><h4>date of inception:</h4></div>
                    <div class="col-sm-7"><?php echo $arrayF['inceptionDate']; ?></div>
                </div>
                <div class="row">
                    <div class="col-sm-5"><h4>Location (Country/City):</h4></div>
                    <div class="col-sm-7"><?php echo $arrayF['locationName']; ?></div>
                </div>
                <div class="row">
                    <div class="col-sm-5"><h4>Sector/market:</h4></div>
                    <div class="col-sm-7"><?php echo $sector[$arrayF['sectorId']]; ?></div>
                </div>
                <div class="row">
                    <div class="col-sm-5"><h4>Type of startup:</h4></div>
                    <div class="col-sm-7"><?php echo $type_of_startup[$arrayF['startupType']]; ?></div>
                </div>
            </div>
        </form>

        <form class="card">
            <div class="card__body">
                <div class="row">
                    <div class="col-sm-11"></div>
                    <div class="col-sm-1"><a href="<?php echo ABS_URL; ?>/<?php echo $page; ?>?n=3" class="btn btn-sm btn-primary">Edit</a></div>
                </div>
                <div class="row">
                    <div class="col-sm-5"><h4>Avg monthly revenue:</h4></div>
                    <div class="col-sm-7"><?php echo $Avg_monthly_revenue[$arrayF['avgMonthlyRevenue']]; ?></div>
                </div>
                <div class="row">
                    <div class="col-sm-5"><h4>Total revenue till now:</h4></div>
                    <div class="col-sm-7"><?php echo $total_revenue_till_now[$arrayF['totalRevenueTillNow']]; ?></div>
                </div>
                <div class="row">
                    <div class="col-sm-5"><h4>Expected revenue in next 5 years:</h4></div>
                    <div class="col-sm-7"><?php echo $expected_monthly_revenue_in_next_5_years[$arrayF['revenueNextFiveYears']]; ?></div>
                </div>
                <div class="row">
                    <div class="col-sm-5"><h4>Looking to raise:</h4></div>
                    <div class="col-sm-7"><?php echo $amount_wants_to_raise[$arrayF['lookingToRaise']]; ?></div>
                </div>
                <div class="row">
                    <div class="col-sm-5"><h4>Equity diluted for above amount:</h4></div>
                    <div class="col-sm-7"><?php echo $equity_diluted_for_above_amount[$arrayF['equityDilutedForAboveAmount']]; ?></div>
                </div>
                <div class="row">
                    <div class="col-sm-5"><h4>Amount Invested already:</h4></div>
                    <div class="col-sm-7"><?php echo $Amount_Invested_already[$arrayF['amountInvestedAlready']]; ?></div>
                </div>
            </div>
        </form>

        <form class="card">
            <div class="card__body">
                <div class="row">
                    <div class="col-sm-11"></div>
                    <div class="col-sm-1"><a href="<?php echo ABS_URL; ?>/<?php echo $page; ?>?n=4" class="btn btn-sm btn-primary">Edit</a></div>
                </div>
                <div class="row">
                    <div class="col-sm-5"><h4>About startup:</h4></div>
                    <div class="col-sm-7"><?php echo $arrayF['aboutUs']; ?></div>
                </div>
                <div class="row">
                    <div class="col-sm-5"><h4>Tags:</h4></div>
                    <div class="col-sm-7"><?php echo $Suggested_Tags[$arrayF['tags']]; ?></div>
                </div>
            </div>
        </form>

    </div>
</section>


<script type="text/javascript">

    var dash_url = '<?=DASH_URL?>';
    var latV = '<?=$latV;?>';
    var longV = '<?=$longV;?>';
    var zoomV = '<?=$zoomV;?>';
    function filePreview(input) {
        var valid_formats = ["image/jpg", "image/png", "image/jpeg", "image/PNG", "image/JPG", "image/JPEG", "image/gif", "image/GIF"];
        if (input.files && input.files[0]) {
            if (input.files[0].size < 20*1024*1024) {
                if (valid_formats.indexOf(input.files[0].type) > 0) {
                    console.log(valid_formats.indexOf(input.files[0].type));
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#imageShow').nextAll().remove();
                        $('#imageShow').after('<img src="'+e.target.result+'" width="150" height="100"/>');
                    }
                    reader.readAsDataURL(input.files[0]);
                } else {
                    $('#imageShow').nextAll().remove();
                    $('#imageShow').after('<span style="color:red;">File type is not valid.</span>');
                }
            } else {
                $('#imageShow').nextAll().remove();
                $('#imageShow').after('<span style="color:red;">File size is greater than 20MB.</span>');
            }
        }
    }

    $(document).ready(function (e) {
        $("form#Gallery").on('submit',(function(e) {
            e.preventDefault();
            $(".submitBtn").attr("disabled", "disabled");
            $('#imageShow').nextAll().remove();
            $('#imageShow').after('<span style="color:green;">Uploading</span>');
            $.ajax({
                url: dash_url+"/controller/gallery_controller.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,      
                processData: false,
                success: function(response) {
                    var result = jQuery.parseJSON(response);
                    if(result.status == 'success') {
                        $('.submitBtn').removeAttr("disabled");
                        $('#imageShow').nextAll().remove();
                        $('#imageShow').after('<span style="color:green;">Uploaded Successfully</span>');
                        $("#imageShow").fadeOut(1000, function () {        
                            setTimeout(function(){ window.location.href = dash_url+'/gallery'; }, 1500);     
                        });
                    } else {
                        $('#imageShow').after('<span style="color:red;">Something went wrong. Please try again1.</span>');
                        $('.submitBtn').removeAttr("disabled");
                    }
                },
                error: function(response) {
                    $('#imageShow').nextAll().remove();
                    $('#imageShow').after('<span style="color:red;">Something went wrong. Please try again2.</span>');
                    $('.submitBtn').removeAttr("disabled");
                }
            });
        }));

        $(document).on("submit", "form#mapLocation", function() {
            $(".submitMapBtn").attr("disabled", "disabled");
            var flowtype = $('#mflowtype').val();
            var lat = $('#lat').val();
            var long = $('#long').val();
            $.post(dash_url+"/controller/dashboard_controller.php", {flowtype:flowtype, lat:lat, long:long},function(data) {
                var result = jQuery.parseJSON(data);
                if(result.status == 'success') {
                    $('.submitMapBtn').removeAttr("disabled");
                    window.location = dash_url+"/gallery";
                } else {
                    $('.submitMapBtn').removeAttr("disabled");
                }
            });
            return false;
        });

        $(document).on("submit", "form#youTube", function() {
            $(".submitYTBtn").attr("disabled", "disabled");
            var flowtype = $('#yflowtype').val();
            var yt = $('#yt').val();
            $.post(dash_url+"/controller/gallery_controller.php", {flowtype:flowtype, yt:yt},function(data) {
                var result = jQuery.parseJSON(data);
                if(result.status == 'success') {
                    $('.submitYTBtn').removeAttr("disabled");
                    window.location = dash_url+"/gallery";
                } else {
                    $('.submitYTBtn').removeAttr("disabled");
                }
            });
            return false;
        });

        if($('[data-demo-action="delete-listing"]')[0]) {
            $('[data-demo-action="delete-listing"]').click(function (e) {
                e.preventDefault();
                var Id = $(this).attr('id').split('####');
                if(Id[1] == 'MQ==') {
                    var text = "Image";
                } else if (Id[1] == 'Mg==') {
                    var text = "Video";
                }

                swal({
                    title: 'Are you sure?',
                    text: "You want to delete this "+text+".",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    showLoaderOnConfirm: true,
                    preConfirm: function() {
                        return new Promise(function(resolve) {
                            setTimeout(function() {
                                $.ajax({
                                    url: dash_url+"/controller/gallery_controller.php",
                                    type: "POST",
                                    data: {type: Id[1], gallery_id: Id[2], flowtype:2},
                                    dataType: "json",
                                    success: function (response) {
                                        if(response.status == 'success') {
                                            swal('Done!',text+' has been deleted.','success').then(function() { window.location = dash_url+"/gallery"; });
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

        $("#image").change(function () {
            filePreview(this);
        });
    });
</script>

<!-- <script type="text/javascript">
    var map = new google.maps.Map(document.getElementById('map_canvas'), {
        zoom: zoomV,
        center: new google.maps.LatLng(35.137879, -82.836914),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var myMarker = new google.maps.Marker({
        position: new google.maps.LatLng(latV, longV),
        draggable: true
    });

    google.maps.event.addListener(myMarker, 'dragend', function (evt) {
        document.getElementById('current').innerHTML = '<p>Marker dropped: Current Lat: ' + evt.latLng.lat().toFixed(3) + ' Current Long: ' + evt.latLng.lng().toFixed(3) + '</p>';
        document.getElementById('lat').value = evt.latLng.lat().toFixed(3);
        document.getElementById('long').value = evt.latLng.lng().toFixed(3);
    });

    google.maps.event.addListener(myMarker, 'dragstart', function (evt) {
        document.getElementById('current').innerHTML = '<p>Currently dragging marker...</p>';
    });

    map.setCenter(myMarker.position);
    myMarker.setMap(map);

</script> -->

<?php include_once("layout/dashboard-footer.php"); ?>