<?php 
header("Content-Type: application/xml; charset=utf-8");
echo '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL; 
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' .PHP_EOL;
?>
<?php
/*-------------------     Include File Start      ---------------*/

include_once("config.php");
include_once("global.php");
include_once("./class/instituate_class.php");

/*-------------------     Include File End      ---------------*/


/*-------------------     Class Object Start      ---------------*/

$Instituate = new Instituate();

/*-------------------     Class Object End      ---------------*/

/*-------------------     Function Define Start      ---------------*/

$instituateArray = $Instituate->getAllInstituate();

/*-------------------     Function Define End      ---------------*/
?>
<?php foreach ($instituateArray as $key => $value) { ?>
<url>
    <loc><?=MAIN_URL."/".$value['unique_url']?></loc>
    <changefreq>weekly</changefreq>
</url>
<?php } ?>

</urlset>
