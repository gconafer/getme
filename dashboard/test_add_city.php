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
?>

<script src="<?=ABS_JS_URL?>/jquery-min.js" type="text/javascript"></script>
<link href="<?=ABS_CSS_URL?>/select2-min.css" rel="stylesheet" />
<script src="<?=ABS_JS_URL?>/select2-min.js"></script>

<a href="<?=DASH_URL?>/test_add_institute.php">Add Institute</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?=DASH_URL?>/test_add_course.php">Add Course</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?=DASH_URL?>/test_add_city.php">Add City</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?=DASH_URL?>/test_list_institute.php">List Institute</a><br /><br />
<form action="./controller/test_controller.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="flowtype" value="4" />
    <div class="search">
        <div class="search__body">
            <div class="search__advanced">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>country name</label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <select style="width:1200px;" name="country" tabindex="-1" aria-hidden="true">
                        <?php
                        foreach ($countryArray as $key => $value) {
                            echo "<option value='".$value['id']."'>".$value['name']."</option>";
                        }
                        ?>
                        </select>
                    </div>
                </div>
                <br />
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>city name</label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <input style="width:1500px;" type="text" name="city">
                    </div>
                </div>
                <br /><br />
                <div class="col-xs-12 m-t-10">
                    <button style="width:300px;" type="submit" value="Search" class="btn btn-primary">SUBMIT</button>
                </div>
            </div>
        </div>
    </div>
</form>
<br /><br /><br /><br />
<form action="./controller/test_controller.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="flowtype" value="5" />
    <div class="search">
        <div class="search__body">
            <div class="search__advanced">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>country name</label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <select style="width:1200px;" name="country" tabindex="-1" aria-hidden="true">
                        <?php
                        foreach ($countryArray as $key => $value) {
                            echo "<option value='".$value['id']."'>".$value['name']."</option>";
                        }
                        ?>
                        </select>
                    </div>
                </div>
                <br />
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>City Name</label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <select style="width:1200px;" name="city" tabindex="-1" aria-hidden="true">
                        <?php
                        foreach ($cityArray as $key => $value) {
                            echo "<option value='".$value['id']."'>".$value['name']."</option>";
                        }
                        ?>
                        </select>
                    </div>
                </div>
                <br />
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Pincode</label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <input style="width:1500px;" type="text" name="pincode">
                    </div>
                </div>
                <br />
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Location Name</label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <input style="width:1500px;" type="text" name="location">
                    </div>
                </div>
                <br /><br />
                <div class="col-xs-12 m-t-10">
                    <button style="width:300px;" type="submit" value="Search" class="btn btn-primary">SUBMIT</button>
                </div>
            </div>
        </div>
    </div>
</form>
