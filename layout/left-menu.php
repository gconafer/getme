<?php 
$phpFileName = basename($_SERVER['PHP_SELF']);
$dashboardMenu = array('dashboard.php', 'institute.php');
$teacherMenu = array('teacher-list.php', 'teacher.php');
$coursesMenu = array('courses-list.php', 'courses.php');
$batchMenu = array('batch-list.php', 'batch.php');
$galleryMenu = array('gallery.php');
$testMenu = array('create-test.php');

$dashboardMenuActive = $teacherMenuActive = $courseMenuActive = $batchMenuActive = $galleryMenuActive = $testMenuActive = "";
if (in_array($phpFileName, $dashboardMenu)) {
    $dashboardMenuActive = "class='active'";
} elseif(in_array($phpFileName, $teacherMenu)) {
    $teacherMenuActive = "class='active'";
} elseif (in_array($phpFileName, $coursesMenu)) {
    $courseMenuActive = "class='active'";
} elseif (in_array($phpFileName, $batchMenu)) {
    $batchMenuActive = "class='active'";
} elseif (in_array($phpFileName, $galleryMenu)) {
    $galleryMenuActive = "class='active'";
} elseif (in_array($phpFileName, $testMenu)) {
    $testMenuActive = "class='active'";
}
?>
<main id="main">
    <?php if ((!$NM) && (!isset($_GET['n']))) { ?>
        <aside id="main__sidebar">
            <a class="hidden-lg main__block-close" href="<?=ABS_URL?>" data-rmd-action="block-close" data-rmd-target="#main__sidebar">
                <i class="zmdi zmdi-long-arrow-left"></i>
            </a>

            <ul class="main-menu">
                <li <?=$courseMenuActive?>><a href="<?=ABS_URL?>/gallery.php"><i class="zmdi zmdi-home"></i> Profile</a></li>
                <li <?=$batchMenuActive?>><a href="<?=ABS_URL?>/gallery.php"><i class="zmdi zmdi-view-list"></i> Support</a></li>
            </ul>
        </aside>
    <?php } ?>