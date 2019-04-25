<?php
session_start();
/*-------------------     Include File Start      ---------------*/
include_once("config.php");
include_once("global.php");
include_once("./class/instituate_class.php");
include_once("./class/amenities_class.php");
include_once("./class/city_master_class.php");
include_once("./class/child_category_class.php");
include_once("./class/country_master_class.php");
include_once("./class/location_master_class.php");

/*-------------------     Include File End      ---------------*/

if(!isset($_SESSION['id']) && empty($_SESSION['id'])) {
    header("Location: ".DASH_URL);
    die();  
}

/*-------------------     Class Object Start      ---------------*/

$Amenities = new Amenities();
$Instituate = new Instituate();
$cityMaster = new City_Master();
$countryMaster = new Country_Master();
$childCategory = new Child_Category();
$LocationMaster = new Location_Master();

/*-------------------     Class Object End      ---------------*/

if(isset($_GET['type']) && ($_GET['type'] == 'edit')) {
    $InstituateArray = $Instituate->getInstituateById($_SESSION['instituate_id']);
    if(is_array($InstituateArray) && empty($InstituateArray)) {
        header("Location: ".DASH_URL.'');
        die();
    }
    if(isset($InstituateArray['city_id']) && $InstituateArray['city_id']) {
        $CityId = $InstituateArray['city_id'];
    } else {
        $CityId = 1;
    }

    $CountryArray = $countryMaster->getListOfMasterCountry();
    $LocationArray = $LocationMaster->getListOfCityLocation($CityId);
    $AmenitiesArray = $Amenities->getListOfAmenities($_SESSION['instituate_id']);
    $CityArray = $cityMaster->getListOfCityByCountryId($InstituateArray['country_id']);
    $ChildCategoryArray = $childCategory->getListOfChildCategory($InstituateArray['country_id']);

} else {
    header("Location: ".DASH_URL.'');
    die();
}
/*-------------------     Include Header and Left Menu     ---------------*/
include_once("layout/header.php");
include_once("layout/left-menu.php");
?>

<title><?=$_GET['type']?> Institute Details | Ecoaching.guru | Your Online Coaching Guru</title>
<section id="main__content">
    <div class="action-header-alt">
        <a class="action-header__item action-header__back" href="<?=DASH_URL?>/dashboard">
            <i class="zmdi zmdi-long-arrow-left"></i> Back to Dashboard
        </a>
    </div>

    <div class="main__container main__container-sm">
        <header class="main__title" style="padding:0px;">
            <h2><?=$_GET['type']?> Institute Detail</h2>
        </header>

        <form class="card new-contact" id="InstituateForm">
            <input type="hidden" name="flowtype" id="flowtype" value="1">

            <div class="card__body">
                <div class="row">

                    <div class="col-sm-12">
                        <div class="form-group form-group--float">
                            <input type="text" name="name" id="name" class="form-control" value="<?=$InstituateArray['name']?>">
                            <label class="asterikCls">Institute Name</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group form-group--float">
                            <textarea name="description" id="description" class="form-control textarea-autoheight" style="overflow: hidden; overflow-wrap: break-word; height: 44px;">
                                <?=$InstituateArray['description']?>
                            </textarea>
                            <label>Description</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group form-group--float">
                            <input type="number" name="founded" id="founded" class="form-control" value="<?=$InstituateArray['founded']?>">
                            <label>Founded</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group form-group--float">
                            <input type="text" name="working_days" id="working_days" class="form-control" value="<?=$InstituateArray['working_days']?>">
                            <label>Working Days</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <select name="country_id" id="country_id" class="select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                            <option value="0">Search Country</option>
                            <?php foreach ($CountryArray as $key => $value) {
                                if($value['id'] == $InstituateArray['country_id']) $select = "selected"; else $select = "";
                                echo '<option value="'.$value['id'].'" '.$select.'>'.ucfirst($value['name']).'</option>';
                            }
                            ?>
                            </select>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <select name="city_id" id="city_id" class="select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                            <option value="0">Search City</option>
                            <?php foreach ($CityArray as $key => $value) {
                                if($value['id'] == $InstituateArray['city_id']) $select = "selected"; else $select = "";
                                echo '<option value="'.$value['id'].'" '.$select.'>'.ucfirst($value['name']).'</option>';
                            }
                            ?>
                            </select>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <select name="location_id" id="location_id" class="select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                            <option value="0">Search Locality</option>
                            <?php foreach ($LocationArray as $key => $value) {
                                if($value['id'] == $InstituateArray['location_id']) $select = "selected"; else $select = "";
                                echo '<option value="'.$value['id'].'" '.$select.'>'.ucwords($value['name']).'</option>';
                            }
                            ?>
                            </select>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group form-group--float">
                            <input type="text" name="contact_email" id="contact_email" class="form-control" value="<?=$InstituateArray['contact_email']?>">
                            <label class="asterikCls">Contact Email</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group form-group--float">
                            <input type="text" name="contact_no" id="contact_no" class="form-control" value="<?=$InstituateArray['contact_no']?>">
                            <label class="asterikCls">Contact No.</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group form-group--float">
                            <input type="text" name="address" id="address" class="form-control" value="<?=$InstituateArray['address']?>">
                            <label class="asterikCls">Address</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group form-group--float">
                            <input type="text" name="website_url" id="website_url" class="form-control" value="<?=$InstituateArray['website_url']?>">
                            <label>Website Url (eg. http://ecoaching.guru)</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group form-group--float">
                            <input type="text" name="fb_page_url" id="fb_page_url" class="form-control" value="<?=$InstituateArray['fb_page_url']?>">
                            <label>FB Page Url (eg. https://www.facebook.com/ecoaching.guru)</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group form-group--float">
                            <input type="number" name="avg_no_batches" id="avg_no_batches" class="form-control" value="<?=$InstituateArray['avg_no_batches']?>">
                            <label>Total Number of Batch (in Years)</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group form-group--float">
                            <input type="number" name="no_of_teachers" id="no_of_teachers" class="form-control" value="<?=$InstituateArray['no_of_teachers']?>">
                            <label>Total Count of Teacher</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group form-group--float">
                            <input type="text" name="avg_teacher_exp" id="avg_teacher_exp" class="form-control" value="<?=$InstituateArray['avg_teacher_exp']?>">
                            <label>Avg. Teacher Experience</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group form-group--float">
                            <input type="number" name="avg_batch_size" id="avg_batch_size" class="form-control" value="<?=$InstituateArray['avg_batch_size']?>">
                            <label>Avg. Batch Size</label>
                            <i class="form-group__bar"></i>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <label>Amenities:&nbsp;</label><br />
                        <input type="checkbox" name="study_material" id="study_material" <?php if(is_array($AmenitiesArray) && !empty($AmenitiesArray)) { if($AmenitiesArray['study_material']) echo 'checked'; } ?>>&nbsp;Study Material&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="checkbox" name="test_series" id="test_series" <?php if(is_array($AmenitiesArray) && !empty($AmenitiesArray)) { if($AmenitiesArray['test_series']) echo 'checked'; } ?>>&nbsp;Test Series&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="checkbox" name="online_portal" id="online_portal" <?php if(is_array($AmenitiesArray) && !empty($AmenitiesArray)) { if($AmenitiesArray['online_portal']) echo 'checked'; } ?>>&nbsp;Online Portal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="checkbox" name="ac" id="ac" <?php if(is_array($AmenitiesArray) && !empty($AmenitiesArray)) { if($AmenitiesArray['ac']) echo 'checked'; } ?>>&nbsp;AC&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="checkbox" name="wifi" id="wifi" <?php if(is_array($AmenitiesArray) && !empty($AmenitiesArray)) { if($AmenitiesArray['wifi']) echo 'checked'; } ?>>&nbsp;WIFI&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="checkbox" name="pick_and_drop" id="pick_and_drop" <?php if(is_array($AmenitiesArray) && !empty($AmenitiesArray)) { if($AmenitiesArray['pick_and_drop']) echo 'checked'; } ?>>&nbsp;Pick And Drop&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="checkbox" name="library" id="library" <?php if(is_array($AmenitiesArray) && !empty($AmenitiesArray)) { if($AmenitiesArray['library']) echo 'checked'; } ?>>&nbsp;Library
                    </div>

                </div>

                <p style="color:red;" id = "errorMsgD"></p>
                <div class="clearfix"></div>
                <div class="m-t-20">
                    <button type="submit" class="btn btn-primary submitBtn">Save</button>
                    <a class="btn btn-link" href="<?=DASH_URL?>/dashboard">Cancel</a>
                </div>
            </div>
        </form>

    </div>
</section>

<script type="text/javascript">
    $(document).ready(function() {         

        var dash_url = '<?=DASH_URL?>';
        var regEx = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        $(document).on("submit", "form#InstituateForm", function() { 
            $(".submitBtn").attr("disabled", "disabled");
            var study_material = 0, test_series = 0, online_portal = 0, ac = 0, wifi = 0, pick_and_drop = 0, library = 0;
            var flowtype = $('#flowtype').val();
            var name = $('#name').val();
            var founded = $('#founded').val();
            var description = $('#description').val();
            var working_days = $('#working_days').val();
            var country_id = $('#country_id').val();
            var city_id = $('#city_id').val();
            var location_id = $('#location_id').val();
            var contact_email = $('#contact_email').val();
            var contact_no = $('#contact_no').val();
            var address = $('#address').val();
            var website_url = $('#website_url').val();
            var fb_page_url = $('#fb_page_url').val();
            var avg_no_batches = $('#avg_no_batches').val();
            var no_of_teachers = $('#no_of_teachers').val();
            var avg_teacher_exp = $('#avg_teacher_exp').val();
            var avg_batch_size = $('#avg_batch_size').val();
            if($('#study_material').prop("checked") == true) study_material = 1;
            if($('#test_series').prop("checked") == true) test_series = 1;
            if($('#online_portal').prop("checked") == true) online_portal = 1;
            if($('#ac').prop("checked") == true) ac = 1;
            if($('#wifi').prop("checked") == true) wifi = 1;
            if($('#pick_and_drop').prop("checked") == true) pick_and_drop = 1;
            if($('#library').prop("checked") == true) library = 1;

            if(!name) {
                $('#errorMsgD').text('Please enter Institute name');
                $('.submitBtn').removeAttr("disabled");
            } else if (country_id == 0) {
                $('#errorMsgD').text('Please select country');
                $('.submitBtn').removeAttr("disabled");
            } else if (city_id == 0) {
                $('#errorMsgD').text('Please enter city');
                $('.submitBtn').removeAttr("disabled");
            } else if (location_id == 0) {
                $('#errorMsgD').text('Please enter Locality');
                $('.submitBtn').removeAttr("disabled");
            } else if (!contact_email) {
                $('#errorMsgD').text('Please enter contact email');
                $('.submitBtn').removeAttr("disabled");
            } else if (!regEx.test(contact_email)) {
                $('#errorMsgD').text('Please enter valid email');
                $('.submitBtn').removeAttr("disabled");
            } else if (!contact_no) {
                $('#errorMsgD').text('Please enter contact no');
                $('.submitBtn').removeAttr("disabled");
            } else if (!address) {
                $('#errorMsgD').text('Please enter address');
                $('.submitBtn').removeAttr("disabled");
            } else {
                $.post(dash_url+"/controller/dashboard_controller.php", {flowtype:flowtype, name:name, founded:founded, description:description, working_days:working_days, country_id:country_id, city_id:city_id, location_id:location_id, contact_email:contact_email, contact_no:contact_no, address:address, website_url:website_url, fb_page_url:fb_page_url, avg_no_batches:avg_no_batches, no_of_teachers:no_of_teachers, avg_teacher_exp:avg_teacher_exp, avg_batch_size:avg_batch_size, study_material:study_material, test_series:test_series, online_portal:online_portal, ac:ac, wifi:wifi, pick_and_drop:pick_and_drop, library:library},function(data) {
                    var result = jQuery.parseJSON(data);
                    if(result.status == 'success') {
                        $('.submitBtn').removeAttr("disabled");
                        $('#errorMsgD').css('color', 'green').html('Update Successfully');
                        $("#errorMsgD").fadeOut(1000, function () {        
                            setTimeout(function(){ window.location.href = dash_url+'/dashboard'; }, 1500);     
                        });
                    } else {
                        $('#errorMsgD').text('Something went wrong. Please try again.');
                        $('.submitBtn').removeAttr("disabled");
                    }
                });
            }
            return false;
        });

        $(document).on("change", "select#city_id", function() {
            var city_id = this.value;
            var flowtype = 2;
            $.post(dash_url+"/controller/dashboard_controller.php", {flowtype:flowtype, city_id:city_id},function(jsonData) {
                var result = jQuery.parseJSON(jsonData);
                if(result.status == 'success') {
                    $('select#location_id').empty();
                    $('select#location_id').append(
                        $("<option></option>").text("Select Locality").val(0)
                    );
                    $.each(jQuery.parseJSON(result.json), function() {
                        $('select#location_id').append(
                            $("<option></option>").text(this.name).val(this.id)
                        );
                    })
                } else {
                    alert('No locality for this city. We are currently opertional in delhi.');
                }
            });
        });

    });
</script>
<?php include_once("layout/footer.php"); ?>