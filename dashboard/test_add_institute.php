<?php
session_start();
include_once("config.php");
include_once("global.php");
include_once("./class/test_class.php");

if ((!isset($_SESSION['id']) && empty($_SESSION['id'])) || ($_SESSION['instituate_id'] != 1)) {
    header("Location: ".DASH_URL);
    die();  
}

$Test = new Test();

$countryArray = $Test->getCountryList();
$cityArray = $Test->getCityList();
$LocationArray = $Test->getLocationList();
?>

<script src="<?=ABS_JS_URL?>/jquery-min.js" type="text/javascript"></script>
<link href="<?=ABS_CSS_URL?>/select2-min.css" rel="stylesheet" />
<script src="<?=ABS_JS_URL?>/select2-min.js"></script>

<a href="<?=DASH_URL?>/test_add_institute.php">Add Institute</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?=DASH_URL?>/test_add_course.php">Add Course</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?=DASH_URL?>/test_add_city.php">Add City</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?=DASH_URL?>/test_list_institute.php">List Institute</a><br /><br />
<form action="./controller/test_controller.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="flowtype" value="1" />
    <div class="search">
        <div class="search__body">
            <div class="search__advanced">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>parent_id</label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <input style="width:1200px;" type="text" name="parent_id" value="0">
                    </div>
                </div>
                <br />
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>name(I)</label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <input style="width:1500px;" type="text" name="name">
                    </div>
                </div>
                <br />
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>country_id(I)</label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <select style="width:1200px;" name="country_id" tabindex="-1" aria-hidden="true">
                        <?php
                        foreach ($countryArray as $key => $value) {
                            echo "<option value='".$value['id']."'>".$value['name']."</option>";
                        }
                        ?>
                        </select>
                    </div>
                </div>
                <br />
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>city_id(I)</label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <select style="width:1200px;" name="city_id" tabindex="-1" aria-hidden="true">
                        <?php
                        foreach ($cityArray as $key => $value) {
                            echo "<option value='".$value['id']."'>".$value['name']."</option>";
                        }
                        ?>
                        </select>
                    </div>
                </div>
                <br />
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>location_id(I)</label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <select id="country" style="width:1200px;" name="location_id" class="select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                        <?php
                        foreach ($LocationArray as $key => $value) {
                            echo "<option value='".$value['id']."'>".$value['name']."&nbsp;(".$value['pincode'].") ".ucwords($value['cname'])."</option>";
                        }
                        ?>
                        </select>
                    </div>
                </div>
                <br />
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>description</label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <textarea rows="8" cols="200" name="description"></textarea>
                    </div>
                </div>
                <br /><br />
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>founded</label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <input style="width:1200px;" type="text" name="founded">
                    </div>
                </div>
                <br />
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>working_days</label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <input style="width:1200px;" type="text" name="working_days" value="Mon-Sat 10PM to 8PM">
                    </div>
                </div>
                <br />
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>website_url</label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <input style="width:1200px;" type="text" name="website_url">
                    </div>
                </div>
                <br />
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>fb_page_url</label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <input style="width:1200px;" type="text" name="fb_page_url">
                    </div>
                </div>
                <br />
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>latitude</label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <input style="width:1200px;" type="text" name="latitude" value="">
                    </div>
                </div>
                <br />
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>longitude</label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <input style="width:1200px;" type="text" name="longitude" value="">
                    </div>
                </div>
                <br />
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>contact_email</label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <input style="width:1200px;" type="text" name="contact_email" value="">
                    </div>
                </div>
                <br />
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>pincode</label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <input style="width:1200px;" type="text" name="pincode" value="">
                    </div>
                </div>
                <br />
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>contact_no</label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <input style="width:1200px;" type="text" name="contact_no" value="">
                    </div>
                </div>
                <br />
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>address</label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <input style="width:1200px;" type="text" name="address" value="">
                    </div>
                </div>
                <br />
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>map_address</label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <input style="width:1200px;" type="text" name="map_address" value="">
                    </div>
                </div>
                <br />
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>avg_no_batches</label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <input style="width:1200px;" type="text" name="avg_no_batches" value="8">
                    </div>
                </div>
                <br />
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>no_of_teachers</label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <input style="width:1200px;" type="text" name="no_of_teachers" value="6">
                    </div>
                </div>
                <br />
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>ratio</label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <input style="width:1200px;" type="text" name="ratio" value="">
                    </div>
                </div>
                <br />
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>avg_teacher_exp</label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <input style="width:1200px;" type="text" name="avg_teacher_exp" value="5">
                    </div>
                </div>
                <br />
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>avg_batch_size</label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <input style="width:1200px;" type="text" name="avg_batch_size" value="20">
                    </div>
                </div>
                <br />
                <input type="checkbox" name="study_material" value="1">Study Material&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="checkbox" name="test_series" value="1">Test Series&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="checkbox" name="online_portal" value="1">Online Portal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="checkbox" name="ac" value="1">AC&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="checkbox" name="wifi" value="1">WIFI&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="checkbox" name="pick_and_drop" value="1">Pick And Drop&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="checkbox" name="library" value="1">Library&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <br /><br />
                <input type="file" name="image1">&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="file" name="image2">&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="file" name="image3">&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="file" name="image4">&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="file" name="image5">&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="file" name="image6">&nbsp;&nbsp;&nbsp;&nbsp;
                <br /><br /><br /><br />
                <div class="col-xs-12 m-t-10">
                    <button style="width:300px;" type="submit" value="Search" class="btn btn-primary">SUBMIT</button>
                </div>
            </div>
        </div>
    </div>
</form>


<script type="text/javascript">
    $(document).ready(function() { 
        $("#country").select2();
    });
</script>