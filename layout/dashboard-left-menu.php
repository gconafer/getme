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
    <aside id="main__sidebar">
        <a class="hidden-lg main__block-close" href="<?=DASH_URL?>" data-rmd-action="block-close" data-rmd-target="#main__sidebar">
            <i class="zmdi zmdi-long-arrow-left"></i>
        </a>

        <ul class="main-menu">
            <li <?=$dashboardMenuActive?>><a href="<?=DASH_URL?>/dashboard"><i class="zmdi zmdi-home"></i> Home</a></li>
            <li <?=$courseMenuActive?>><a href="<?=DASH_URL?>/courses-list"><i class="zmdi zmdi-chart"></i> Courses</a></li>
            <li <?=$batchMenuActive?>><a href="<?=DASH_URL?>/batch-list"><i class="zmdi zmdi-view-list"></i> Batch</a></li>
            <li <?=$teacherMenuActive?>><a href="<?=DASH_URL?>/teacher-list"><i class="zmdi zmdi-account-box"></i> Teachers</a></li>
            <li <?=$galleryMenuActive?>><a href="<?=DASH_URL?>/gallery"><i class="zmdi zmdi-collection-image"></i> Gallery</a></li>
            <br />
            <li <?=$testMenuActive?>><a href="<?=DASH_URL?>/exam-test-list" id="onlineTestSeries"><i class="zmdi zmdi-file-text"></i> Online Test<span class="mdc-bg-green-400">&nbsp;&nbsp;New&nbsp;&nbsp;</span></a></li>
        </ul>
    </aside>