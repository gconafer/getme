<?php
session_start();
/*-------------------     Include File Start      ---------------*/
include_once("config.php");
include_once("global.php");
include_once ("./class/gallery_class.php");
include_once("./class/instituate_class.php");

/*-------------------     Include File End      ---------------*/

if(!isset($_SESSION['id']) && empty($_SESSION['id'])) {
    header("Location: ".DASH_URL);
    die();  
}

/*-------------------     Class Object Start      ---------------*/

$Gallery = new Gallery();
$Instituate = new Instituate();

/*-------------------     Class Object End      ---------------*/

$countAvtar = count($AVTAR_IMG_Array);
$InstituateArray = $Instituate->getInstituateById($_SESSION['instituate_id']);
$GalleryDetailArray = $Gallery->getInstituteGalleryList($_SESSION['instituate_id']);
if(!empty($InstituateArray['latitude']) && !empty($InstituateArray['longitude'])) { 
    $zoomV = 15;
    $latV = $InstituateArray['latitude'];
    $longV = $InstituateArray['longitude'];
} else { 
    $zoomV = 4;
    $latV = $LAT_LONG_ARRAY[$InstituateArray['country_id']]['lat'];
    $longV = $LAT_LONG_ARRAY[$InstituateArray['country_id']]['long'];
}

/*-------------------     Include Header and Left Menu     ---------------*/
include_once("layout/header.php");
include_once("layout/left-menu.php");
?>

<title> Gallery | Ecoaching.guru | Your Online Coaching Guru</title>

<section id="main__content">
    <div class="main__container" style="padding: 40px 20px 40px 20px;">
        <header class="main__title" style="padding:0px;">
            <h2>Gallery</h2>
        </header>

        <div class="row">
        <?php foreach ($GalleryDetailArray as $key => $value) { 
            $index = $key%$countAvtar;
            if($value['type'] == 1) {
        ?>
            <div class="col-sm-4 col-md-3 notes notes--<?=$AVTAR_IMG_Array[$index]?>">
                <a href="#edit-note" data-toggle="modal">
                    <img style="width:100%;height:100%;" src="<?=ABS_I_IMG_URL?>/<?=$value['url']?>"></img>
                </a>
                <?php if($value['featured_status'] == 1) { ?>
                    <div class="notes__actions">
                        <i title="Featured Image" class="zmdi zmdi-star"></i>
                    </div>
                <?php } else { ?>
                    <div id="gallery####<?=base64_encode($value['type'])?>####<?=base64_encode($value['id'])?>" class="notes__actions" data-demo-action="delete-listing">
                        <i title="Click here to delete" class="zmdi zmdi-delete"></i>
                    </div>
                <?php } ?>
            </div>
        <?php } 
        }
        ?>
        </div>

        <form class="card new-contact" id="Gallery" method="post" enctype="multipart/form-data">
            <input type="hidden" name="flowtype" id="flowtype" value="1">
            <div class="card__body">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="form-group form-group--float">
                            <input class="form-control" type="file" name="image" id="image" />
                            <span><input class="btn btn-primary submitBtn" style="margin-top:20px;" type="submit" name="submit" value="Upload"/></span>
                        </div>
                    </div>

                    <div class="col-sm-2"></div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <span id="imageShow"></span>
                        </div>
                    </div>

                </div>
            </div>
        </form>

        <header class="main__title" style="padding:0px;">
            <h2>Youtube Video</h2>
        </header>

        <div class="row">
        <?php foreach ($GalleryDetailArray as $key => $value) { 
            $index = $key%$countAvtar;
            if($value['type'] == 2) {
        ?>
            <div class="col-sm-6 col-md-4 notes notes--<?=$AVTAR_IMG_Array[$index]?>">
                <a href="#edit-note" data-toggle="modal">
                    <iframe width="250" height="125" src="https://www.youtube.com/embed/<?=$value['url']?>"></iframe>
                </a>
                <?php if($value['featured_status'] == 1) { ?>
                    <div class="notes__actions">
                        <i title="Featured Image" class="zmdi zmdi-star"></i>
                    </div>
                <?php } else { ?>
                    <div id="gallery####<?=base64_encode($value['type'])?>####<?=base64_encode($value['id'])?>" class="notes__actions" data-demo-action="delete-listing">
                        <i title="Click here to delete" class="zmdi zmdi-delete"></i>
                    </div>
                <?php } ?>
            </div>
        <?php } 
        }
        ?>
        </div>

        <form class="card new-contact" id="youTube" method="post" enctype="multipart/form-data">
            <input type="hidden" name="yflowtype" id="yflowtype" value="3">
            <div class="card__body">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group form-group--float">
                            <input type="text" name="yt" id="yt" class="form-control">
                            <label>Enter Youtube Video ID</label>
                            <i class="form-group__bar"></i>
                            <span class="asterikCls">Click here to find <a target="_blank" href="https://docs.joeworkman.net/rapidweaver/stacks/youtube/video-id">youtube video id</a></span>
                        </div>
                    </div>

                    <div class="col-sm-1"></div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary submitYTBtn">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <header class="main__title" style="padding:0px;">
            <h2>Location On Map</h2>
        </header>

        <form class="card new-contact" id="mapLocation" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mflowtype" id="mflowtype" value="3">
            <div class="card__body">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group form-group--float">
                            <input type="text" name="lat" id="lat" class="form-control" value="<?php if(!empty($InstituateArray['latitude'])) { echo $InstituateArray['latitude']; } else { echo 0; }?>">
                            <label>Current Latitude</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group form-group--float">
                            <input type="text" name="long" id="long" class="form-control" value="<?php if(!empty($InstituateArray['longitude'])) { echo $InstituateArray['longitude']; } else { echo 0; }?>">
                            <label>Current Longitude</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    <div class="col-sm-1"></div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary submitMapBtn">Save</button>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div id="current">Zoom in to find the exact location on map. Drag marker to your nearest possible location.</div>
                        <div id='map_canvas' style="width:100%;height: 500px;"></div>
                    </div>

                </div>
            </div>
        </form>
    </div>
</section>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCvVYsleYUQ_N6M_jl5kqOQo9j0KOWlTOM"></script>
<script type="text/javascript">

    var dash_url = '<?=DASH_URL?>';
    var latV = '<?=$latV;?>';
    var longV = '<?=$longV;?>';
    var zoomV = <?=$zoomV;?>;
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

<script type="text/javascript">
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

</script>

<?php include_once("layout/footer.php"); ?>