<?php
session_start();
include_once("config.php");
include_once("./class/test_class.php");

if ((!isset($_SESSION['id']) && empty($_SESSION['id'])) || ($_SESSION['instituate_id'] != 1)) {
    header("Location: ".DASH_URL);
    die();  
}

$Test = new Test();
$InstituteArray = $Test->getInstituateList();
?>
<a href="<?=DASH_URL?>/test_add_institute.php">Add Institute</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?=DASH_URL?>/test_add_course.php">Add Course</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?=DASH_URL?>/test_add_city.php">Add City</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?=DASH_URL?>/test_list_institute.php">List Institute</a><br /><br />
<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
</style>
<table style="width:100%">
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Url</th>
        <th>Address</th> 
        <th>Pincode</th>
    </tr>
    <?php foreach ($InstituteArray as $key => $value) { ?>
    <tr>
        <td><?=$value['id']?></td>
        <td><?=$value['name']?></td>
        <td>http://ecoaching.guru/coaching-institutes/<?=$value['unique_url']?></td>
        <td><?=$value['address']?></td>
        <td><?=$value['pincode']?></td>
    </tr>
    <?php } ?>
</table>