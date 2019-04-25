<?php
include_once("config.php");
include_once("./class/test_class.php");

$Test = new Test();

$childCategoryIdArray = $Test->getChildCategoryList();
$instituateId = $Test->getLastInstituteId();
?>
<a href="<?=DASH_URL?>/test_add_institute.php">Add Institute</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?=DASH_URL?>/test_add_course.php">Add Course</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?=DASH_URL?>/test_add_city.php">Add City</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?=DASH_URL?>/test_list_institute.php">List Institute</a><br /><br />
<form action="./controller/test_controller.php" method="post">
    <input type="hidden" name="flowtype" value="2" />
    <div class="search">
        <div class="search__body">
            <div class="search__advanced">
                <br />
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>child_category_id</label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <select style="width:1200px;" name="child_category_id" class="select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                        <?php
                        foreach ($childCategoryIdArray as $key => $value) {
                            echo "<option value='".$value['id']."'>".$value['name']."</option>";
                        }
                        ?>
                        </select>
                    </div>
                </div>
                <br />
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>instituate_id</label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <input style="width:1200px;" type="text" name="instituate_id" value="<?=$instituateId?>">
                    </div>
                </div>
                <br />
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>price</label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <input style="width:1200px;" type="text" name="price" value="0">
                    </div>
                </div>
                <br />
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>duration (In Week, 1 month == 4 week)</label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <input style="width:1200px;" type="text" name="duration" value="0">
                    </div>
                </div>
                <br />
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>avg_no_student</label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <input style="width:1200px;" type="text" name="avg_no_student" value="0">
                    </div>
                </div>
                <br />
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>description</label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <input style="width:1200px;" type="text" name="description">
                    </div>
                </div>
                <br />
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>teaching_pattern</label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <input style="width:1200px;" type="text" name="teaching_pattern">
                    </div>
                </div>
                <br /><br /><br /><br />
                <div class="col-xs-12 m-t-10">
                    <button style="width:300px;" type="submit" value="Search" class="btn btn-primary">SUBMIT</button>
                </div>
            </div>
        </div>
    </div>
</form>