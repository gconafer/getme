<?php
/*-------------------     Include File Start      ---------------*/

include_once("config.php");
include_once("global.php");
include_once("./class/blog_class.php");
include_once("./class/common_class.php");
include_once("./class/instituate_class.php");
include_once("./class/city_master_class.php");
include_once("./class/child_category_class.php");
include_once("./class/location_master_class.php");

/*-------------------     Include File End      ---------------*/


/*-------------------     Class Object Start      ---------------*/

// $Blog = new Blog();

// $Common = new Common();
// $Instituate = new Instituate();
// $cityMaster = new City_Master();
// $childCategory = new Child_Category();
// $locationMaster = new Location_Master();

/*-------------------     Class Object End      ---------------*/


/*-------------------     Function Define Start      ---------------*/

// $cityArray = $cityMaster->getCityByCountry(COUNTRY_ID);
// $locationArray = $locationMaster->getListOfCityLocation(CITY_ID);
// $popularArray = $Instituate->getPopularInstituate(CITY_ID);
// $categoryArray = $childCategory->getListOfChildCategory(COUNTRY_ID);
// $latestBlogArray = $Blog->getLatestBlog($BlogDBLink);

/*-------------------     Function Define End      ---------------*/


/*-------------------  Page Specific Variable ---------------*/
// $cityDetailArray = $cityMaster->getDetailOfCity(CITY_ID);

$pageTitle = "Test";
$pageDesc = "Desc";
$ogTitle = "Test";
$ogType = "website";
$ogUrl = ABS_URL;
$ogSiteName = "Test";
$ogDesc = $pageDesc;
$ogImage = ABS_IMG_URL."/logo.png";
$ogImageHeight = 200;
$ogImageWidth = 150;

?>

<?php include_once("layout/header.php"); ?>

    <div class="header__search container">
        <form action="./controller/index_controller.php" method="post">
            <input type="hidden" name="flowtype" value="1" />
            <div class="search">
                <div class="search__body">
                    <input class="form-control search__input" placeholder="Search for Coaching Institute in <?=$cityName?>" data-rmd-action="advanced-search-open" type="text">

                    <div class="search__advanced">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Course Category</label>

                                <select name="category_id" class="select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                <option value="0">Search Courses</option>
                                <?php
                                // foreach ($categoryArray as $key => $value) {
                                //     echo "<option value='".$value['id']."'>".$Common->checkStringSanitize($value['name'])."</option>";
                                // }
                                ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Near By Location/Pincode</label>

                                <select name="location_id" class="select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                <option value="0">Search Location/Pincode</option>
                                <?php
                                // foreach ($locationArray as $key => $value) {
                                //     echo "<option value='".$value['id']."'>".$Common->checkStringSanitize($value['name'])."&nbsp;(".$Common->checkStringSanitize($value['pincode']).")</option>";
                                // }
                                ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-xs-12 m-t-10">
                            <button type="submit" value="Search" class="btn btn-primary">Search</button>
                            <button class="btn btn-link" data-rmd-action="advanced-search-close">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</header>

<section class="section">
    <div class="container">
        <header class="section__title">
            <h1>Practice Courses</h1><hr />
        </header>

        <div class="row listings-grid">
            <div class="col-sm-2 col-md-2"></div>
            <div class="col-sm-4 col-md-4 notes">
                <a href="<?=ABS_URL?>/bank-clerk-test">
                    <div class=""><center><h4>Bank Clerk</h4></center></div>
                    <div class="" style="overflow: hidden; text-overflow: ellipsis; -webkit-box-orient: vertical; display: -webkit-box; -webkit-line-clamp: 4;">
                        <center><b>IBPS Clerk, SBI Clerk, RRB Assistant</b></center>
                    </div>
                </a>
            </div>
            <div class="col-sm-4 col-md-4 notes">
                <a href="<?=ABS_URL?>/bank-po-test">
                    <div class=""><center><h4>Bank PO</h4></center></div>
                    <div class="" style="overflow: hidden; text-overflow: ellipsis; -webkit-box-orient: vertical; display: -webkit-box; -webkit-line-clamp: 4;">
                        <center><b>IBPS PO, SBI PO, IPPB Officer, RRB Officer</b></center>
                    </div>
                </a>
            </div>
            <div class="col-sm-2 col-md-2"></div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <header class="section__title">
            <h1>Popular Courses in <?=$cityName?></h1><hr />
        </header>

        <div class="row neighb-guide">
            <div class="col-sm-3"></div>
            <div class="col-sm-1">
                <a class="card" href="<?=MAIN_URL?>/ssc-coaching-in-<?=$cityUrl?>">
                    <img style="width:100%;height:66px;" src="<?=ABS_IMG_URL?>/ssc.jpg" alt="SSC">
                    <span><center><h4>SSC</h4></center></span>
                </a>
            </div>
            <div class="col-sm-1">
                <a class="card" href="<?=MAIN_URL?>/ca-coaching-in-<?=$cityUrl?>">
                    <img style="width:100%;height:66px;" src="<?=ABS_IMG_URL?>/ca.jpg" alt="CA">
                    <span><center><h4>CA</h4></center></span>
                </a>
            </div>
            <div class="col-sm-1">
                <a class="card" href="<?=MAIN_URL?>/iit-jee-coaching-in-<?=$cityUrl?>">
                    <img style="width:100%;height:66px;" src="<?=ABS_IMG_URL?>/iit.jpg" alt="IIT-JEE">
                    <span><center><h4>IIT JEE</h4></center></span>
                </a>
            </div>
            <div class="col-sm-1">
                <a class="card" href="<?=MAIN_URL?>/aipmt-coaching-in-<?=$cityUrl?>">
                    <img style="width:100%;height:66px;" src="<?=ABS_IMG_URL?>/aipmt.jpg" alt="AIPMT">
                    <span><center><h4>AIPMT</h4></center></span>
                </a>
            </div>
            <div class="col-sm-1">
                <a class="card" href="<?=MAIN_URL?>/ibps-po-coaching-in-<?=$cityUrl?>">
                    <img style="width:100%;height:66px;" src="<?=ABS_IMG_URL?>/ibps.jpg" alt="IBPS PO">
                    <span><center><h4>IBPS</h4></center></span>
                </a>
            </div>
            <div class="col-sm-1">
                <a class="card" href="<?=MAIN_URL?>/nda-coaching-in-<?=$cityUrl?>">
                    <img style="width:100%;height:66px;" src="<?=ABS_IMG_URL?>/nda.png" alt="NDA">
                    <span><center><h4>NDA</h4></center></span>
                </a>
            </div>
            <div class="col-sm-3"></div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <header class="section__title">
            <h1>Popular Coaching In <?=$cityName?></h1><hr />
        </header>

        <div class="row listings-grid">
        <?php //foreach ($popularArray as $key => $value) { 
                //if(empty($value['i_image_url'])) $image = 'noimage.png'; else $image = $value['i_image_url'];
        ?>
            <div class="col-sm-4 col-md-3">
                <div class="listings-grid__item">
                    <a href="<?=MAIN_URL?>/<?=$value['unique_url']?>" title="<?=$Common->checkStringSanitize($value['name'])?>">
                        <div class="listings-grid__main">
                            
                        </div>

                        <div class="listings-grid__body">
                            <small><?=$value['address']?></small>
                            
                        </div>
                    </a>

                </div>
            </div>
        <?php //} ?>
        </div>
    </div>
</section>

<section class="section submit-ticker">
    <p>Are you looking for Best Coaching Institute for Competitve/Entrance Exam?</p>
    <a href="http://bootstrapsale.com/projects/roost/v1-1/dashboard/tasks-lists.html#contactNow" data-toggle="modal" >Contact Now</a>
</section>

<!-- Contact Now Modal -->
<div class="modal fade" id="contactNow">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><center>Fill following details</center></h4>
            </div>
            <form id="contactnowForm">
                <input type="hidden" id="type" name="type" value="4">
                <input type="hidden" id="flowtype" name="flowtype" value="1">
                <input type="hidden" id="instituate_id" name="instituate_id" value="0">
                <input type="hidden" id="location_id" name="location_id" value="">
                <input type="hidden" id="value1" name="value1" value="">
                <input type="hidden" id="value2" name="value2" value="">
                <input type="hidden" id="value3" name="value3" value="">
                <div class="modal-body">
                    <div class="form-group form-group--float">
                        <input id="name" name="name" class="form-control" type="text">
                        <label>Name</label>
                        <i class="form-group__bar"></i>
                    </div>
                    <div class="form-group form-group--float">
                        <input id="email" name="email" class="form-control" type="text">
                        <label>Email Address</label>
                        <i class="form-group__bar"></i>
                    </div>
                    <div class="form-group form-group--float">
                        <input id="contact_no" name="contact_no" class="form-control" type="text">
                        <label>Contact Number</label>
                        <i class="form-group__bar"></i>
                    </div>

                    <div class="form-group">
                        <select name="category_id" id="category_id" class="select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                            <option value="0">Select Course</option>
                        <?php
                        // foreach ($categoryArray as $key => $value) {
                        //     echo "<option value='".$value['id']."'>".$Common->checkStringSanitize($value['name'])."</option>";
                        // }
                        ?>
                        </select>
                    </div>
                </div>
                <p style="color:red;margin-left:10%;" id = "errorMsgD"></p>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Dismiss</button>
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Mutli-City Modal -->
<div class="modal fade" id="new-event" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Select City</h4>
            </div>
            <div class="modal-body">
                <form class="new-event__form">
                    <div class="form-group">
                        <select name="city_id" id="city_id" class="select2 select2-hidden-accessible form-control new-event__title" tabindex="-1" aria-hidden="true">
                        <option value="0">Search City</option>
                        <?php
                        // foreach ($cityArray as $key => $value) {
                        //     echo "<option value='".base64_encode($value['id'])."'>".$Common->checkStringSanitize($value['name'])."</option>";
                        // }
                        ?>
                        </select>
                        <i class="form-group__bar"></i>
                    </div>
                </form>
            </div>
            <p style="color:red;margin-left:5%;" id = "errorMsgC"></p>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="addEvent">Select</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

$(document).ready(function() {

    <?php if($POP_UP) { ?>
        $('#new-event').modal('show');
    <?php } ?>
    
    var abs_url = '<?=ABS_URL?>';
    var regEx = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    $(document).on("submit", "form#contactnowForm", function() {
        var name = $('#name').val();
        var email = $('#email').val();
        var type = $('#type').val();
        var contact_no = $('#contact_no').val();
        var flowtype = $('#flowtype').val();
        var instituate_id = $('#instituate_id').val();
        var category_id = $('#category_id').val();
        var location_id = $('#location_id').val();
        var value1 = $('#value1').val();
        var value2 = $('#value2').val();
        var value3 = $('#value3').val();
        if(!name) {
            $('#errorMsgD').text('Please enter name');
        } else if (!email) {
            $('#errorMsgD').text('Please enter email');
        } else if (!regEx.test(email)) {
            $('#errorMsgD').text('Please enter valid email');
        } else if (!contact_no) {
            $('#errorMsgD').text('Please enter conatct no');
        } else if (parseInt(category_id) == 0) {
            $('#errorMsgD').text('Please select course');
        } else {
            $.post(abs_url+"/controller/common_controller.php", {name:name, email:email, contact_no:contact_no, flowtype:flowtype, type:type, instituate_id:instituate_id, category_id:category_id, location_id:location_id, value1:value1, value2:value2, value3:value3},function(data) {
                var result = jQuery.parseJSON(data);
                if(result.status == 'success') {
                    $('#contactnowForm').html('<div class="submit-property__success"><i style="margin-left:35%;" class="zmdi zmdi-check"></i><h2 style="margin-left:15%;">Successfully Submitted!</h2><br /><br /><br /><br /></div>');
                    $('#contactNow').delay(100000).modal('hide');
                } else {
                    $('#errorMsgD').text('Something went wrong.');
                }
            });
        }
        return false;
    });

    $(document).on("click", "#addEvent", function() {
        var city_id = $('#city_id').val();
        if(parseInt(city_id) == 0) {
            $('#errorMsgC').text('Please select city');
        } else {
            $.post(abs_url+"/controller/common_controller.php", {city_id:city_id, flowtype:2},function(data) {
                var result = jQuery.parseJSON(data);
                if(result.status == 'success') {
                    $('#new-event').delay(5000).modal('hide');
                    window.location.reload();
                } else {
                    $('#errorMsgC').text('Something went wrong.');
                }
            });
        }
        return false;
    });
});    

</script>

<?php include_once("layout/footer.php"); ?>