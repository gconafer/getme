<?php
include_once("config.php");
include_once("./class/test_class.php");
$Test = new Test();


function query($url) {
    $url = "https://api.import.io/store/connector/574c42bc-9478-44d6-903f-85386a0c43b4/_query?input=webpage/url:".$url."&&_apikey=14945ae741dd49bbbc8e843d530d5761290fa600623dbb7902e09a1ff658a54e7f37f5b56916d053634bcc1af6c17925c41aa0f16d1854055fff3d48a7f6f45381cc6fafccb0e582fa4e37f1f4a6cc02";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/json"
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $result = curl_exec($ch);
    curl_close($ch);
    return json_decode($result, true);
}


function get_remote_data($url, $post_paramtrs=false, $location)
{
    $c = curl_init();
    curl_setopt($c, CURLOPT_URL, $url);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
    if($post_paramtrs)
    {
        curl_setopt($c, CURLOPT_POST,TRUE);
        curl_setopt($c, CURLOPT_POSTFIELDS, "var1=bla&".$post_paramtrs );
    }
    curl_setopt($c, CURLOPT_SSL_VERIFYHOST,false);
    curl_setopt($c, CURLOPT_SSL_VERIFYPEER,false);
    curl_setopt($c, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; rv:33.0) Gecko/20100101 Firefox/33.0");
    curl_setopt($c, CURLOPT_COOKIE, "my_current_location=$location;");
    curl_setopt($c, CURLOPT_MAXREDIRS, 10);
    $follow_allowed= ( ini_get('open_basedir') || ini_get('safe_mode')) ? false:true;
    if ($follow_allowed)
    {
        curl_setopt($c, CURLOPT_FOLLOWLOCATION, 1);
    }
    curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 9);
    curl_setopt($c, CURLOPT_REFERER, $url);
    curl_setopt($c, CURLOPT_TIMEOUT, 60);
    curl_setopt($c, CURLOPT_AUTOREFERER, true);
    curl_setopt($c, CURLOPT_ENCODING, 'gzip,deflate');
    $data=curl_exec($c);
    $status=curl_getinfo($c);
    curl_close($c);
    preg_match('/(http(|s)):\/\/(.*?)\/(.*\/|)/si',  $status['url'],$link); $data=preg_replace('/(src|href|action)=(\'|\")((?!(http|https|javascript:|\/\/|\/)).*?)(\'|\")/si','$1=$2'.$link[0].'$3$4$5', $data);   $data=preg_replace('/(src|href|action)=(\'|\")((?!(http|https|javascript:|\/\/)).*?)(\'|\")/si','$1=$2'.$link[1].'://'.$link[3].'$3$4$5', $data);
    if($status['http_code']==200)
    {
        return $data;
    }
    elseif($status['http_code']==301 || $status['http_code']==302)
    {
        if (!$follow_allowed)
        {
            if (!empty($status['redirect_url']))
            {
                $redirURL=$status['redirect_url'];
            }
            else
            {
                preg_match('/href\=\"(.*?)\"/si',$data,$m);
                if (!empty($m[1]))
                {
                    $redirURL=$m[1];
                }
            }
            if(!empty($redirURL))
            {
                return  call_user_func( __FUNCTION__, $redirURL, $post_paramtrs);
            }
        }
    }
    return "ERRORCODE22 with $url!!<br/>Last status codes<b/>:".json_encode($status)."<br/><br/>Last data got<br/>:$data";
}




$edu_Cat_Array = array(579 => "SSC", 2429 => "BANK PO", 1798 => "Railway", 1174 => "IIT-JEE", 1773 => "GATE", 1810 => "UPSC", 2077 => "AIPMT", 566 => "CAT");

$edu_City_Array = array(26 => "Delhi", 32 => "Noida", 34 => "Ghaziabad", 27 => "Gurgaon", 59 => "Mumbai", 55 => "Pune", 211 => "Bengaluru", 36 => "Faridabad");


$courseArray1 = array(1 => "IIT", 3 => "GATE", 7 => "AIPMT", 10 => "CAT", 12 => "IIFT", 13 => "XAT", 17 => "CS", 22 => "GRE", 23 => "GMAT", 24 => "TOEFL", 26 => "IELTS", 31 => "NID", 37 => "UPSC", 41 => "NDA", 47 => "CTET", 51 => "SSC", 53 => "IBPS", 54 => "RRB", 73 => "CA", 74 => "SBI", 77 => "DSSSB");

$courseArray2 = array(16 => array(0 => "CA", 1 => "CPT"), 55 => array(0 => "CA", 1 => "IPCC"), 56 => array(0 => "CA", 1 => "Final"), 57 => array(0 => "CS", 1 => "Foundation"), 64 => array(0 => "CS", 1 => "Final"), 69 => array(0 => "SSC", 1 => "CHSL"), 70 => array(0 => "SSC", 1 => "CPO"), 71 => array(0 => "SSC", 1 => "CGL"), 75 => array(0 => "SBI", 1 => "PO"));




$e_city_id = 8; //Ecoaching city ID

$start = 10;

$cat_id = 566;

$city_id = 36;

$url = "http://www.edunuts.com/coachingBYCity?start=$start&cc=$cat_id&ccat=0&cccat=0";
$output = get_remote_data($url, false, $city_id);
$Array  = json_decode($output, true);

//echo '<pre>'; print_r($Array);

if ((isset($Array)) && (!empty($Array))) {

foreach ($Array as $key => $value) {
    $location_id = $founded = $count = 0;
    $logo = $address = $name = $pincode = $website_url = $fb_url = $desc = $founded = $contact_no = $l_unique_url = $locality = $location = "";
    if($value['inst_city_url'] == "faridabad") {

        if(!empty(trim($value["logo"]))) $logo = "http://img.edunuts.com/".$value['logo'];
        if(!empty(trim($value["address"]))) $address = $value["address"];
        if(!empty(trim($value["name"]))) $name = $value["name"];

        if(!empty(trim($value["location"]))) {
            $parray = explode('-', $address);
            $last_key = key(array_slice($parray, -1, 1, TRUE));
            $pincode = $parray[$last_key];

            $location = $value["location"];
            $explode1 = explode(',', $location);
            $count = count($explode1);
            foreach ($explode1 as $k1 => $v1) {
                $explode2 = explode('@', $v1);
                $locality = $explode2[0];
                $pos = strpos($address, $locality);
                if (($pos !== false) || ($count == 1)) {
                    $l_unique_url = $Test->seofriendlyurl($locality);
                    $lArray = $Test->getlocationId($l_unique_url, $e_city_id);
                    if(!empty($lArray) && is_array($lArray)) {
                        $location_id = $lArray['id'];
                        $pincode = $lArray['pincode'];
                        $l_unique_url = $lArray['url'];
                    } else {
                        $location_id = $Test->insertLocationMaster($e_city_id, $pincode, $locality, $l_unique_url);
                    }
                }
            }

        }

        //changeeeee
        $inst_url = "http://www.edunuts.com/faridabad-coaching/".trim($value['inst_url']);
        $inst_detail = query($inst_url);

        //echo '<pre>';  echo $inst_url; print_r($inst_detail);

        $pos = strpos($inst_detail['results'][0]['my_column_6'], "Founded in");
        if (($pos !== false) && (!empty($inst_detail['results'][0]['my_column_6']))) {
            preg_match_all('!\d+!', $inst_detail['results'][0]['my_column_6'], $matches);
            $founded = (int) $matches[0][0];
        }

        
        $desc = $inst_detail['results'][0]['my_column_5'];
        if ((isset($inst_detail['results'][0]['my_column_3'])) && is_array($inst_detail['results'][0]['my_column_3'])) {
            $website_url = $inst_detail['results'][0]['my_column_3'][0];
            $fb_url = $inst_detail['results'][0]['my_column_3'][1];
        } else {
            $website_url = $inst_detail['results'][0]['my_column_3'];
            $fb_url = "";
        }
        
        $contact_no = $inst_detail['results'][0]['my_column_9'];
        $course_desc = $inst_detail['results'][0]['my_column_7'];
        //echo $desc."@@@@".$website_url."@@@@@".$fb_url."@@@@@".$contact_no."@@@@@@@@".$course_desc; 
        //die('asdddd');


        if(!empty($name)) {
            $unique_url = $Test->seofriendlyurl($name)."-".$l_unique_url;
            $lUIArray = $Test->checkUniqueUrl($unique_url);
            //print_r($lUIArray);
            
            if ((is_array($lUIArray)) && (empty($lUIArray))) {
                $Id = $Test->insertInstitute(0, $name, $desc, $founded, "Mon-Sat 10PM to 8PM", $website_url, $fb_url, 1, $e_city_id, $location_id, $pincode, $unique_url, "", "", "", $contact_no, $address, $name, 0, 0, 0, 0, 0, $logo, $course_desc);
                if (($Id) && (!empty($course_desc))) {

                    $Aid = $Test->insertAmenities($Id, 1, 1, 0, 0, 0, 0, 0);

                    foreach ($courseArray1 as $k2 => $v2) {
                        if (strpos($course_desc, $v2) !== FALSE) {
                            $exist = $Test->checkCourseExist($Id, $k2);
                            if(!$exist) {
                                $master_category_id = $Test->MasterCategoryId($k2);
                                $Cid = $Test->insertCourse($master_category_id, $k2, $Id, 0, 0, 0, "", "");
                            }
                        }
                    }

                    foreach ($courseArray2 as $k3 => $v3) {
                        if ((strpos($course_desc, $v3[0]) !== FALSE) && (strpos($course_desc, $v3[1]) !== FALSE)) {
                            $exist = $Test->checkCourseExist($Id, $k3);
                            if(!$exist) {
                                $master_category_id = $Test->MasterCategoryId($k3);
                                $Cid = $Test->insertCourse($master_category_id, $k3, $Id, 0, 0, 0, "", "");

                                if($k3 == 55) {
                                    $ex = $Test->checkCourseExist($Id, 68);
                                    if(!$ex) {
                                        $master_category_id = $Test->MasterCategoryId(68);
                                        $Cid = $Test->insertCourse($master_category_id, 68, $Id, 0, 0, 0, "", "");
                                    }
                                }

                                if($k3 == 56) {
                                    $ex = $Test->checkCourseExist($Id, 72);
                                    if(!$ex) {
                                        $master_category_id = $Test->MasterCategoryId(72);
                                        $Cid = $Test->insertCourse($master_category_id, 72, $Id, 0, 0, 0, "", "");
                                    }
                                }

                                if($k3 == 64) {
                                    $ex = $Test->checkCourseExist($Id, 59);
                                    if(!$ex) {
                                        $master_category_id = $Test->MasterCategoryId(59);
                                        $Cid = $Test->insertCourse($master_category_id, 59, $Id, 0, 0, 0, "", "");
                                    }

                                    $ex = $Test->checkCourseExist($Id, 65);
                                    if(!$ex) {
                                        $master_category_id = $Test->MasterCategoryId(65);
                                        $Cid = $Test->insertCourse($master_category_id, 65, $Id, 0, 0, 0, "", "");
                                    }
                                }

                            }
                        }
                    }
                }
            }
        }



    }
}


} else {

die('no data');

}
die('END');
?>