<?php
/*
include_once("config.php");
include_once("./class/test_class.php");
$Test = new Test();


function save_image($inPath, $outPath) { 
	$in = fopen($inPath, "rb");
    $out = fopen($outPath, "wb");
    while ($chunk = fread($in,8192)) {
    	fwrite($out, $chunk, 8192);
    }
    fclose($in);
    fclose($out);
}

$valid_formats = array("jpg", "jpeg", "JPG", "JPEG","gif","GIF");

$Array = $Test->getAllImageRecord();
foreach ($Array as $key => $value) {

	$gArray = $Test->checkGallery($value['id']);
	if(!$gArray) {
    	$i   = strrpos($value['image_url'], ".");
		$l   = strlen($value['image_url']) - $i;
		$ext = substr($value['image_url'], $i+1, $l);
		if(in_array($ext, $valid_formats)) {
			$imageName = 'image_'.time().'.'.$ext;
			save_image($value['image_url'], '/var/www/html/EdTech/dashboard/assets/img/instituate_image/'.$imageName);
			$GIid = $Test->insertGallery($value['id'], 0, 1, 1, $imageName);
			if($GIid) {
				sleep(2);
			}
		}
	}
}
*/
?>


<?php
/*
include_once("config.php");
include_once("./class/test_class.php");
$Test = new Test();

$Array = $Test->getDuplicateUrl();
foreach ($Array as $key => $value) {
	$aArray = $Test->getOtherValue($value['url']);
	foreach ($aArray as $k => $v) {
		$n = $k+2;
		$url = $v['lurl']."-".$v['curl']."-".$n;
		$Test->updateLMUrl($v['id'], $url);
	}
}
*/

?>
