<?php
function getPasskey(){
	$length = 20;
	$characters = "0123456789abcdefghijklmnopqrstuvwxyz";
	$string='';
	for ($p = 0; $p < $length; $p++) {
		$string .= $characters[mt_rand(0, strlen($characters)-1)];
	}
	return $string;
}


function fix_for_page($value){
	$value = htmlspecialchars(trim($value));
	if (get_magic_quotes_gpc())
	$value = stripslashes($value);
	return $value;
}


function sksort(&$array, $subkey="id", $sort_ascending=false) {

    if (count($array))
        $temp_array[key($array)] = array_shift($array);

    foreach($array as $key => $val){
        $offset = 0;
        $found = false;
        foreach($temp_array as $tmp_key => $tmp_val)
        {
            if(!$found and strtolower($val[$subkey]) > strtolower($tmp_val[$subkey]))
            {
                $temp_array = array_merge(    (array)array_slice($temp_array,0,$offset),
                                            array($key => $val),
                                            array_slice($temp_array,$offset)
                                          );
                $found = true;
            }
            $offset++;
        }
        if(!$found) $temp_array = array_merge($temp_array, array($key => $val));
    }

    if ($sort_ascending) $array = array_reverse($temp_array);

    else $array = $temp_array;
}

function getEncryptValue($word){
   $url="http://mcnapi.vidooly.com/api/v1/auth/enpasswd?word=$word";
   $ch = curl_init($url);
   curl_setopt($ch, CURLOPT_URL, $url);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   $output = curl_exec($ch);
   curl_close($ch);
   $result = json_decode($output, true);
   $encryptValue=isset($result['encryptvalue'])?$result['encryptvalue']:'';
   return $encryptValue;
}

function clean_url($text)
{
	$text = trim($text);
	$text=strtolower($text);
	$code_entities_match = array(' ','--','&quot;','!','@','#','$','%','^','&','*','(',')','_','+','{','}','|',':','"','<','>','?','[',']','\\',';',"'",',','.','/','*','+','~','`','=');
	$code_entities_replace = array('-','-','','','','','','','','','','','','','','','','','','','','','','','','','','','','','-','','','','','');
	$text = str_replace($code_entities_match, $code_entities_replace, $text);
	return $text;
}

function cleanAdvanced_url($text){
	$text = clean_url($text);
	$text = str_replace('--','-', $text);
	return $text;
}

function isValidEmail($email){
	return eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,15})$", $email);
}

//Get keywordio tool
function getKeywordFromTool($keyword,$country='us',$ln='en'){
		$keywordtoolApi = '5a437861892fbba23948acc62f1c0ca1ee73c992';
		$url="http://api.keywordtool.io/v1/search/youtube?apikey=$keywordtoolApi&keyword=$keyword&output=json&metrics=true&country=$country&language=$ln";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch);
		curl_close($ch);
		$result = json_decode($output, true);
		return $result;
}

function fix_for_mysql($value){
	$con1 = mysql_connect(HOSTNAME,USERNAME,PASSWORD) or die('Unable to connect database.');
	if (get_magic_quotes_gpc())
	$value = trim($value);
	$value = strip_tags($value);
	$value = stripslashes($value);
	$value = mysql_real_escape_string($value,$con1);
	return $value;
}
function StringXmltoArray($xmlstring){
	$xmlstring = simplexml_load_string($xmlstring);
	$xmlstring = json_encode($xmlstring);
	return $xmlstring = json_decode($xmlstring,TRUE);
}
function simpleXMLToArray(SimpleXMLElement $xml,$attributesKey=null,$childrenKey=null,$valueKey=null){

	if($childrenKey && !is_string($childrenKey)){$childrenKey = '@children';}
	if($attributesKey && !is_string($attributesKey)){$attributesKey = '@attributes';}
	if($valueKey && !is_string($valueKey)){$valueKey = '@values';}

	$return = array();
	$name = $xml->getName();
	$_value = trim((string)$xml);
	if(!strlen($_value)){$_value = null;};

	if($_value!==null){
		if($valueKey){$return[$valueKey] = $_value;}
		else{$return = $_value;}
	}

	$children = array();
	$first = true;
	foreach($xml->children() as $elementName => $child){
		$value = simpleXMLToArray($child,$attributesKey, $childrenKey,$valueKey);
		if(isset($children[$elementName])){
			if(is_array($children[$elementName])){
				if($first){
					$temp = $children[$elementName];
					unset($children[$elementName]);
					$children[$elementName][] = $temp;
					$first=false;
				}
				$children[$elementName][] = $value;
			}else{
				$children[$elementName] = array($children[$elementName],$value);
			}
		}
		else{
			$children[$elementName] = $value;
		}
	}
	if($children){
		if($childrenKey){$return[$childrenKey] = $children;}
		else{$return = array_merge($return,$children);}
	}

	$attributes = array();
	foreach($xml->attributes() as $name=>$value){
		$attributes[$name] = trim($value);
	}
	if($attributes){
		if($attributesKey){$return[$attributesKey] = $attributes;}
		else{$return = array_merge($return, $attributes);}
	}

	return $return;
}

function correctURL($address)
{
	if (!empty($address) AND $address{0} != '#' AND
	strpos(strtolower($address), 'mailto:') === FALSE AND
	strpos(strtolower($address), 'javascript:') === FALSE)
	{
		$address = explode('/', $address);
		$keys = array_keys($address, '..');

		foreach($keys AS $keypos => $key)
		array_splice($address, $key - ($keypos * 2 + 1), 2);

		$address = implode('/', $address);
		$address = str_replace('./', '', $address);
		 
		$scheme = parse_url($address);
		 
		if (empty($scheme['scheme']))
		$address = 'http://' . $address;

		$parts = parse_url($address);
		$address = strtolower($parts['scheme']) . '://';

		if (!empty($parts['user']))
		{
			$address .= $parts['user'];

			if (!empty($parts['pass']))
			$address .= ':' . $parts['pass'];

			$address .= '@';
		}

		if (!empty($parts['host']))
		{
			$host = str_replace(',', '.', strtolower($parts['host']));

			if (strpos(ltrim($host, 'www.'), '.') === FALSE)
			$host .= '.com';

			$address .= $host;
		}

		if (!empty($parts['port']))
		$address .= ':' . $parts['port'];

		$address .= '/';

		if (!empty($parts['path']))
		{
			$path = trim($parts['path'], ' /\\');

			if (!empty($path) AND strpos($path, '.') === FALSE)
			$path .= '/';
			 
			$address .= $path;
		}

		if (!empty($parts['query']))
		$address .= '?' . $parts['query'];

		return $address;
	}

	else
	return FALSE;
}

function isAllowedExtension($fileName) {
	$imagetype = strtolower($fileName['type']);
	if($imagetype == "image/gif" || $imagetype == "image/jpg" || $imagetype == "image/jpeg" || $imagetype == "image/pjpeg" || $imagetype == "image/bmp" || $imagetype == "image/png"){
		return true;
	} else {
		return false;
	}
}

?>
<?php
// Paging that is using
function paginationForJobsFeedDynamic($totalCount,$pageSize,$showStart,$page,$querysrt){
	if($querysrt != ''){
		$querysrt = $querysrt.'&';
	} else {
		$querysrt = '?';
	}
	$noOfIteration=ceil($totalCount/$pageSize);
	$flag=0;
	$forward=$showStart;
	$backward=0;

	$starti=1;
	$startBackward=0;
	$previ=$page;
	$previ-=1;
	$prevBackward=$showStart-$pageSize;

	$minLimit=$page-4;
	$maxLimit=$page+4;
	?>

	<?php if($page==1){?>
<!--<span class="pagenav">&lt;&lt;&nbsp;Start</span> 
	<span class="pagenav">&lt;&nbsp;Prev</span>-->
	<?php }else{?>
<a href="<?php echo "".$querysrt."st=$startBackward&pg=$starti"?>"
	class="pagenav" title="Start">&lt;&lt;&nbsp;Start</a>
<a href="<?php echo "".$querysrt."st=$prevBackward&pg=$previ"?>"
	class="pagenav" title="Prev">&lt;&nbsp;Prev</a>
	<?php }?>

	<?php
	for($i=1;$i<=$noOfIteration;$i++){
		if($i>=$page){
			if($page==$i){
				if($noOfIteration!=1){
					echo "<span class='pagenav'>$i</span> ";
				}
			}else{
				if($i>=$minLimit && $i<=$maxLimit){
					echo "<a href='".$querysrt."st=$forward&pg=$i' class='pagenav'><strong>$i</strong></a> ";
				}
					
			}
			$forward+=$pageSize;
		}else{
			if($page==$i){
				if($noOfIteration!=1){
					echo "<span class='pagenav'>$i</span> ";
				}
			}else{
				if($i>=$minLimit && $i<=$maxLimit){
					echo "<a href='".$querysrt."st=$backward&pg=$i' class='pagenav'><strong>$i</strong></a> ";
				}
			}
			$backward+=$pageSize;
		}
	}
	$endi=$i;
	$endi-=1;
	$endForward=$forward;
	$endForward-=$pageSize;
	$nexti=$page;
	$nexti+=1;
	$nextForward=$showStart+$pageSize;
	?>
	<?php if($noOfIteration==$page){?>
<!--<span class="pagenav">Next&nbsp;&gt;</span> 
	    <span class="pagenav">End&nbsp;&gt;&gt;</span>-->
	<?php }else{?>
<a href="<?php echo "".$querysrt."st=$nextForward&pg=$nexti"?>"
	class="pagenav" title="Next">Next&nbsp;&gt;</a>
<a href="<?php echo "".$querysrt."st=$endForward&pg=$endi"?>"
	class="pagenav" title="End">End&nbsp;&gt;&gt;</a>
	<?php }?>
	<?php
}
function LoadToXml($filename,$text,$child='error'){
	$text = htmlentities($text);
	if(file_exists($filename)){
		if(filesize($filename) > 167772160){
			unlink($filename);
		}
	}
	$docold = new DOMDocument();
	if(!file_exists($filename)){
		$Handle = fopen($filename, 'w');
		fclose($Handle);
	}
	if(file_exists($filename)){
		if(!@($docold->load($filename))){
			$doc = new DOMDocument();
			$doc->formatOutput = true;
			$r = $doc->createElement('error_log');
			$doc->appendChild($r);
			$name = $doc->createElement($child);
			$name->appendChild($doc->createTextNode($text));
			$r->appendChild( $name );
			$doc->saveXML();
			$doc->save($filename);
		} else {
			$xml = simplexml_load_file($filename);
			$xml->addChild($child,$text);
			file_put_contents($filename, $xml->asXML());
		}
	}
}

function CovertTimeZone($time,$currentTimezone,$timezoneRequired)
{
	/*$system_timezone = date_default_timezone_get();
	$local_timezone = $currentTimezone;
	date_default_timezone_set($local_timezone);
	$local = date("Y-m-d h:i:s A");

	date_default_timezone_set("GMT");
	$gmt = date("Y-m-d h:i:s A");

	$require_timezone = $timezoneRequired;
	date_default_timezone_set($require_timezone);
	$required = date("Y-m-d h:i:s A");

	date_default_timezone_set($system_timezone);

	$diff1 = (strtotime($gmt) - strtotime($local));
	$diff2 = (strtotime($required) - strtotime($gmt));
*/
	$date = new DateTime($time);
	//$date->modify("+$diff1 seconds");
	//$date->modify("+$diff2 seconds");
	$timestamp = $date->format("d-m-Y h:i a"); 
	return $timestamp;
}

/* Checks jobs Refresh availibility based on date of created
 * It returns true or false based on created and date before 7 days
 * If date before 7 days is greaterthan created date then it returns true else false
 */
function checkResetLinkStatus($createddate,$uid=null,$email=null){
	if(is_numeric($uid) && $email!=null && checkRefreshJobDays($uid,$email)){
		$strtotimedatebeforesevendays  = strtotime('-20 day');
	}else{
		$strtotimedatebeforesevendays  = strtotime('-7 day');
	}
	$daybeforesevendays = date('Y-m-d',$strtotimedatebeforesevendays);
	if(strtotime($daybeforesevendays) > strtotime(date('Y-m-d',strtotime($createddate)))){
		return true;
	} else {
		return false;
	}
}
/* Checks jobs edit availibility based on date of createdutube*/

//Facebook Wall Post by ajay
function FacebookPost($access_token,$title,$desc,$link,$pic,$fbid)
{
	if(isset($access_token)){
		$token=$access_token;
		$mess=$title;
		$desc=str_replace("<p>","",$desc);
		$desc=str_replace("</p>","",$desc);
		$desc=str_replace("<br/>","",$desc);
		$url = "https://graph.facebook.com/".$fbid."/feed";
			
		$attachment =  array(
			'access_token' => $token,
			'name' => $mess,
			'link'=>$link,
			'caption'=>' ',
			'description' =>$desc,
			'picture'=>$pic,
			'actions' => json_encode(array('name' => 'iimjobs','link' => 'http://www.iimjobs.com'))
		);
			
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $attachment);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  //to suppress the curl output
		$result = curl_exec($ch);
		curl_close ($ch);
		return $result;
	}else{
		return false;
	}

}
function unsubscribe_add_email($email){
	$params = array(
		'api_user'  => SG_USERNAME,
		'api_key'   => SG_PASSWORD,
		'email'	=>$email,
	);
	$session = curl_init(SG_URL_ADD);
	curl_setopt ($session, CURLOPT_POST, true);
	curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
	curl_setopt($session, CURLOPT_HEADER, false);
	curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($session);
	curl_close($session);
	$results  = json_decode ( $response, TRUE );
	return $results;
}
function subscribe_email($email)
{
	$params = array(
		'api_user'  => SG_USERNAME,
		'api_key'   => SG_PASSWORD,
		'email'	=>$email,
	);
	$session = curl_init(SG_URL_REMOVE);
	curl_setopt ($session, CURLOPT_POST, true);
	curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
	curl_setopt($session, CURLOPT_HEADER, false);
	curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($session);
	curl_close($session);
	$results  = json_decode ( $response, TRUE );
	return $results;
}

function getSubInsightHbase($channelid,$st=0,$end=0){
	$url="http://172.31.24.201/hbase/search_creator.php";
	
	$data="channelId=$channelid&type=se&start_date=$st&end_date=$end";
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-Length: ' . strlen($data))
	);
	$result = curl_exec($ch);
	$result = json_decode($result, true);
	
	return $result; 
}

function isValidPhone($phoneNo){
	//$landlinepattern = "/^([1]-)?[0-9]{3}-[0-9]{3}-[0-9]{4}$/i";
	//$mobilepattern = "/^((\+){0,1}91(\s){0,1}(\-){0,1}(\s){0,1})?([0-9]{10})$/";
	//if(preg_match($landlinepattern,$phoneNo)){
	//	return true;
	//} else {
	//	return preg_match($mobilepattern,$phoneNo)? true : false;
	//}
	if(strlen($phoneNo) > 10){
		return true;
	}
	return false;
}

function getChannelEngagedDataFromHBase($channelid,$fullESipArray,$start=0,$size=20){
	$url="http://172.31.24.201/hbase/search_creator.php";
	$data_json = "channelId=".$channelid."&type=ce";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Length: '.strlen($data_json)));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$output = curl_exec($ch);
	curl_close($ch);
	$result = json_decode($output, true);
	return $result;
}

function getVideoEngagedDataFromHBase($channelid,$fullESipArray,$start=0,$size=20) {
	$url="http://172.31.24.201/hbase/search_creator.php";
	$data_json = "channelId=".$channelid."&type=ve";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Length: '.strlen($data_json)));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$output = curl_exec($ch);
	curl_close($ch);
	$result = json_decode($output, true);
	return $result;

}

function getChannelUnSubDataFromES($channelid,$fullESipArray,$start=0,$size=20){
	$randkey = array_rand($fullESipArray,1);
	$randIP=$fullESipArray[$randkey];
	$url="http://$randIP:9200/channelsubscribers/subscription/_search";
	$ch = curl_init();
    $data_json = '{"query":{"filtered":{"filter":{"bool":{"must":[{"term":{"snippet.resourceId.channelId":"'.$channelid.'"}}],"must":[{"exists":{"field":"unsubscribed"}}]}}}},"from":'.$start.',"size":'.$size.'}';
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: '.strlen($data_json)));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$output = curl_exec($ch);
	curl_close($ch);
	$result = json_decode($output, true);
	return $result;
}

function checkRecruiterLogo($recruiterId){
	//logo according to recruiter id
	$logoimage = RECRUITER_LOGO_DIR.'/'.$recruiterId.'.jpg';
	if(file_exists($logoimage)){
		return true;
	} else {
		return false;
	}
}
//Resume uploading.
function resumeUpload($regfile,$resumeDir,$id){
	if(isset($regfile['name']) && (isset($resumeDir))){
		$resumeExt=end(explode('.',$regfile['name']));
		if (($resumeExt=="doc") || ($resumeExt=="txt") || ($resumeExt=="docx") || ($resumeExt=="rtf") || ($resumeExt=="pdf")){
			if ($regfile["size"] < 307201) {
				if ($regfile["error"] > 0) {
					die("Error in file uploading.");
				} else {
					$timestamp = date("Y-m-d-H-i-s");
					$fname = preg_replace("/[^\w\d.-]+/i", "", $regfile["name"]);
					$folderpath=explode("-",$timestamp);
					$newfolderpath = ''.$folderpath['0'].'/'.$folderpath['1'].'/'.$folderpath['2'];
					$foldernewpath=$resumeDir."/".$newfolderpath.'/';
					if(!is_dir($foldernewpath)){
						makeDirUpload($foldernewpath);
					}
					$filenamewithtimestamp = $timestamp."-".$id."-".$fname;
					if(move_uploaded_file($regfile["tmp_name"], $resumeDir."/". $newfolderpath.'/'.$filenamewithtimestamp))
					{
						$rpath =$filenamewithtimestamp;
					}else{
						die("There is some issue in uploading resume.");
					}
					return $rpath;
				}
			}else{
				die("File size is greater than 300 Kb.");
			}
		}else{
			die("Resume file format should be only doc,docx,txt or pdf.");
		}
	}else{
		die("There is some issue with resume uploading.");
	}
	// File uploaded
}



//Converting into Html from resume
function covertIntoHtml($pathOfFile,$viewResumeDir,$pdfDir){
	if(file_exists($pathOfFile)){
		$resumeExt=end(explode('.',$pathOfFile));
		ob_start();
                session_write_close();
                if($resumeExt=='pdf'){
			system("pdf2htmlEX --dest-dir '$viewResumeDir' --fit-width=850 '$pathOfFile' --process-outline 0"); 
		}else{
		      $pdfDirFile=$pdfDir."/";
		      $resumename=basename($pathOfFile);
		      // $rhtml=preg_replace('/\..+$/', '.' . 'pdf', $resumename);
                      $rhtml=str_replace('.'.$resumeExt,".pdf",$resumename);
		      $pdfDirFileNew=$pdfDir."/$rhtml";
		      // system("abiword --to=pdf -o '$pdfDirFileNew' '$pathOfFile' ",$retVal);
		      system("unoconv -f pdf -o '$pdfDirFile' '$pathOfFile'  & echo $!",$out);
		      $pid=$out[0];
		      if(TRUE){
				@exec("kill -9 $pid", $output);
                                
                                //exec("sudo /home/hiorbit/public_html/iimjobs.com/public/scripts/killpid.sh $pid", $output2);
                                @exec("/var/www/iimjobs.com/scripts/killpid.sh $pid", $output2);
                                //@exec("sudo /home/jaspal/vhosts/iimjobs-live/scripts/killpid.sh $pid", $output2);
                                
			}
		      system("pdf2htmlEX --dest-dir '$viewResumeDir' --fit-width=850 '$pdfDirFileNew' --process-outline 0");
		}
		$resumeHtml= ob_get_clean();
		$resumeHtml=true;
	}else{
		$resumeHtml=false;
	}
	return $resumeHtml;
}
//Function get html path of resume
function getHtmlPathOfResume($resume,$userid){
	$resumeExt=end(explode('.',$resume));
	if($resumeExt=='pdf'){
		$rhtml=str_replace(".pdf",".html",$resume);
	}else{
	    $rhtml=$userid.'.html';
	}
	return $rhtml;
}
function convertFileNameInHthml($filename){
      $resumeExt=end(explode('.',$filename));
      // $rhtml=preg_replace('/\..+$/', '.' . 'html', $filename);
      $rhtml=str_replace('.'.$resumeExt,".html",$filename);
      return $rhtml;
}
//spliting string on nth postion
function splitn($string, $needle, $offset)
{
    $newString = $string;
    $totalPos = 0;
    $length = strlen($needle);
    for($i = 0; $i < $offset; $i++)
    {
        $pos = strpos($newString, $needle);

        // If you run out of string before you find all your needles
        if($pos === false)
            return false;
        $newString = substr($newString, $pos+$length);
        $totalPos += $pos+$length;
    }
    return substr($string, $totalPos);
}
//function creating directories
function makeDirUpload( $target) {
	$target = rtrim($target, '/'); 
	if(!is_dir($target)){
	      $oldmask = umask(0);
	      @mkdir($target, 0777,true ) ;
	      umask($oldmask);
	      return true;
	}else{
		return false;
	}
}
//Function to get file path 
function getFullFilePath($filename,$resumeDir){
	 $folderpath=explode("-",$filename);
	 $newpath=$folderpath[0].'/'.$folderpath[1].'/'.$folderpath[2];
	 $newfilepath=$resumeDir.'/'.$newpath.'/'.$filename;
	  if(file_exists($newfilepath)){
		    $filepath=$newfilepath;
	  }else if(file_exists($resumeDir.'/'.$filename)){
		  $filepath=$resumeDir.'/'.$filename;
	  }else{
		  $filepath='';
	  }
	  return $filepath;
}
//Function for get only file name 
function getFileNameFromResume($fileName,$resumeDir){
          $fileName=trim($fileName);
	 $folderpath=explode("-",$fileName);
	 $newpath=$folderpath[0].'/'.$folderpath[1].'/'.$folderpath[2];
	 $newfilepath=$resumeDir.'/'.$newpath.'/'.$fileName;
	  if(file_exists($newfilepath)){
		    $resumename=splitn($fileName,'-',7);
	  }else if(file_exists($resumeDir.'/'.$fileName)){
		   $resumename=splitn($fileName,'-',6);
	  }else{
		  $resumename='';
	  }
	return $resumename;

}
//Searching value in array 
function search_array($needle, $haystack) {
	if(is_array($haystack)){
		if(in_array($needle, $haystack)) {
			return true;
		}
     
		foreach($haystack as $element) {
			if(is_array($element) && search_array($needle, $element))
				return true;
		}
	}
   return false;
}
//Get domain name from full domain name
function getDomainName($domain){
	preg_match("/^(http:\/\/)?([^\/]+)/i",$domain, $matches);
	$host = $matches[2];
	if(isset($matches[2])){
		preg_match("/[^\.\/]+\.[^\.\/]+$/", $host, $matches);
		return $matches[0];
	}else{
		return false;
	}

}
function getDomainFromEmail($email)
{
	// Get the data after the @ sign
	$domain = substr(strrchr($email, "@"), 1);
	return $domain;
}
function removeDotFromName($value){
	$value=str_replace('.','',$value);
	return $value;
}
//Function to check file type
function checkResumeExt($resumeExt){
	if(isset($resumeExt)){
		$resumeExt=strtolower($resumeExt);
		if(($resumeExt=="doc") || ($resumeExt=="txt") || ($resumeExt=="docx") || ($resumeExt=="rtf") || ($resumeExt=="pdf")){
			return true;
		}else{
			return false;
		}
	}
	return false;
}

// Sending mail via mandrill
function sendfileMailByManDrill($to, $toname = '', $subject, $html, $text = '', $replyto = FROM, $mailcat = 'odml', $mailfrom = FROM, $mailfromname = FROMNAME, $attachment_encoded,$fileDownloadName,$fileType) {

    $array_data = (object) array(
        'key' => MANDRILL_KEY,
        'message' => (object) array(
            'html' => $html,
            'text' => $text,
            'subject' => $subject,
            'from_email' => $mailfrom,
            'from_name' => $mailfromname,
            'to' => array(
                (object) array(
                    'email' => $to,
                    'name' => $toname,
                ),
            ),
            'headers' => (object) array(
                'Reply-to' => $replyto   
            ),
            'track_opens' => true,
            'track_clicks' => true,
            'auto_text' => true,
            'url_strip_qs' => true,
            'tags' => array(
                $mailcat
            ),
            
           'attachments' => array(
            array(
            'content' => $attachment_encoded,
            'type' => 'application/'.$fileType,    
            'name' => $fileDownloadName,                
            )
           ),
            
        ),
    );
    // echo '<pre>'; print_r($array_data); echo '</pre>';
    $string_data = json_encode($array_data);

    $session = curl_init(MANDRILL_URL);
    curl_setopt($session, CURLOPT_POST, true);
    curl_setopt($session, CURLOPT_POSTFIELDS, $string_data);
    curl_setopt($session, CURLOPT_HEADER, false);
    curl_setopt($session, CURLOPT_ENCODING, 'UTF-8');
    curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($session, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($session);
    curl_close($session);

    $results = json_decode($response, TRUE);
    return $results;
}

// Sending mail via mandrill
function sendMailByManDrill($to, $toname = '', $subject, $html, $text = '', $replyto = FROM, $mailcat = 'odml', $mailfrom = FROM, $mailfromname = FROMNAME) {

	//$mailfrom = 'info@vidooly.com';
    $array_data = (object) array(
        'key' => MANDRILL_KEY,
        'message' => (object) array(
            'html' => $html,
            'text' => $text,
            'subject' => $subject,
            'from_email' => $mailfrom,
            'from_name' => $mailfromname,
            'to' => array(
                (object) array(
                    'email' => $to,
                    'name' => $toname,
                ),
            ),
            'headers' => (object) array(
                'Reply-to' => $replyto   
            ),
            'track_opens' => true,
            'track_clicks' => true,
            'auto_text' => true,
            'url_strip_qs' => true,
            'tags' => array(
                $mailcat
            ),
        ),
    );
    //echo '<pre>'; print_r($array_data); echo '</pre>';
    $string_data = json_encode($array_data);

    $session = curl_init(MANDRILL_URL);
    curl_setopt($session, CURLOPT_POST, true);
    curl_setopt($session, CURLOPT_POSTFIELDS, $string_data);
    curl_setopt($session, CURLOPT_HEADER, false);
    curl_setopt($session, CURLOPT_ENCODING, 'UTF-8');
    curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($session, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($session);
    curl_close($session);

    $results = json_decode($response, TRUE);
    return $results;
}
//send video mail from
function sendVideoMailByManDrill($to, $toname = '', $subject, $html, $text = '',$mailfrom = 'info@vidooly.com', $mailfromname = 'vidoomail',$mailcat = 'videomails', $replyto = 'info@vidooly.com' ) {

    $array_data = (object) array(
        'key' => MANDRILL_KEY,
        'message' => (object) array(
            'html' => $html,
            'text' => $text,
            'subject' => $subject,
            'from_email' => $mailfrom,
            'from_name' => $mailfromname,
            'to' => array(
                (object) array(
                    'email' => $to,
                    'name' => $toname,
                ),
            ),
            'headers' => (object) array(
                'Reply-to' => $replyto
            ),
            'track_opens' => true,
            'track_clicks' => true,
            'auto_text' => true,
            'url_strip_qs' => true,
            'tags' => array(
                $mailcat
            ),
        ),
    );
    // echo '<pre>'; print_r($array_data); echo '</pre>';
    $string_data = json_encode($array_data);

    $session = curl_init(MANDRILL_URL);
    curl_setopt($session, CURLOPT_POST, true);
    curl_setopt($session, CURLOPT_POSTFIELDS, $string_data);
    curl_setopt($session, CURLOPT_HEADER, false);
    curl_setopt($session, CURLOPT_ENCODING, 'UTF-8');
    curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($session, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($session);
    curl_close($session);

    $results = json_decode($response, TRUE);
    return $results;
}

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
//check for refresh days of recruiter is 7days or 20 days
function checkRefreshJobDays($uid,$email){
	global $refresh20daybyid;
	if(is_array($refresh20daybyid) && in_array($uid,$refresh20daybyid)){
		return true;
	}else{
		global $refresh20daybydomain;
		$domainOfEmail=getDomainFromEmail($email);
		if(is_array($refresh20daybydomain) && in_array($domainOfEmail,$refresh20daybydomain)){
			return true;
		}
	}
	return false;
}
//Normalize string from word to text
function normalize_str($str){
	$invalid = array('Š'=>'S', 'š'=>'s', 'Đ'=>'Dj', 'đ'=>'dj', 'Ž'=>'Z', 'ž'=>'z',
	'Č'=>'C', 'č'=>'c', 'Ć'=>'C', 'ć'=>'c', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A',
	'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E',
	'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O',
	'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y',
	'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a',
	'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e',  'ë'=>'e', 'ì'=>'i', 'í'=>'i',
	'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
	'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y',  'ý'=>'y', 'þ'=>'b',
	'ÿ'=>'y', 'Ŕ'=>'R', 'ŕ'=>'r', "`" => "'", "´" => "'", "„" => ",", "`" => "'",
	"´" => "'", "“" => "\"", "”" => "\"", "´" => "'", "&acirc;€™" => "'", "{" => "",
	"~" => "", "–" => "-", "’" => "'");
	$str = str_replace(array_keys($invalid), array_values($invalid), $str);
	return $str;
}
function sendMail($email,$subject,$message, $mailcat='nwml'){
    $to=$toname=$email;
    $html=$text=$message;
    sendMailByManDrill($to, $toname, $subject, $html, $text, 'info@vidooly.com', $mailcat);
}
function getBrowser()
{
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= "";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    }
    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    }
    elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }

    // Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
    {
        $bname = 'Internet Explorer';
        $ub = "MSIE";
    }
    elseif(preg_match('/Firefox/i',$u_agent))
    {
        $bname = 'Mozilla Firefox';
        $ub = "Firefox";
    }
    elseif(preg_match('/Chrome/i',$u_agent))
    {
        $bname = 'Google Chrome';
        $ub = "Chrome";
    }
    elseif(preg_match('/Safari/i',$u_agent))
    {
        $bname = 'Apple Safari';
        $ub = "Safari";
    }
    elseif(preg_match('/Opera/i',$u_agent))
    {
        $bname = 'Opera';
        $ub = "Opera";
    }
    elseif(preg_match('/Netscape/i',$u_agent))
    {
        $bname = 'Netscape';
        $ub = "Netscape";
    }

    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }

    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        }
        else {
            $version= $matches['version'][1];
        }
    }
    else {
        $version= $matches['version'][0];
    }

    // check if we have a number
    if ($version==null || $version=="") {$version="?";}

    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'    => $pattern
    );
}
//get Ip information
function ipInfo($ip){
	if($ip=='127.0.0.1'){
		$details = NULL;
		$details->city='none';
		$details->country='IN';
	}else{
		$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}"));
	}
	return $details;
}
//Pagination function
function paging($limit,$numRows,$page,$querystring){

    $allPages = ceil($numRows / $limit);
    $start  = ($page - 1) * $limit;
    if($limit<$numRows){
		$paginHTML = "<div class='pagination'>";
		$paginHTML .= "<ul> ";
		for ($i = 1; $i <= $allPages; $i++) {
			if ($i>1) {
				$prev = $i-1;
				//$paginHTML .= '<a href="?'.$querystring.'page='.$prev'">Previous</a>';
			}
			$paginHTML .= "<li ".($i==$page?"class=active":"").">";
			$paginHTML .= "<a href=\"?$querystring&page=$i";
			$paginHTML .= "\">$i</a> </li>";
			if ($i<$allPages) {
				$next = $i+1;
				//$paginHTML .= '<a href="?'.$querystring.'page='.$next'">Next</a>';
			}
		}
		$paginHTML .= "</ul> </div>";
		return $paginHTML;
	}

 }
 //Get appkey
 function getWidgetkey($email){
	$length = 15;
	$characters = $email;
	$string='';
	for ($p = 0; $p < $length; $p++) {
		$string .= $characters[mt_rand(0, strlen($characters)-1)];
	}
	return $string;
}

//Get Video id from youtube
function youtube_id_from_url($url) {
    $pattern =
        '%^# Match any youtube URL
        (?:https?://)?  # Optional scheme. Either http or https
        (?:www\.)?      # Optional www subdomain
        (?:             # Group host alternatives
          youtu\.be/    # Either youtu.be,
        | youtube\.com  # or youtube.com
          (?:           # Group path alternatives
            /embed/     # Either /embed/
          | /v/         # or /v/
          | /watch\?v=  # or /watch\?v=
          )             # End path alternatives.
        )               # End host alternatives.
        ([\w-]{10,12})  # Allow 10-12 for 11 char youtube id.
        $%x'
        ;
    $result = preg_match($pattern, $url, $matches);
    if (false !== $result) {
        return $matches[1];
    }
    return false;
}
function isValidYoutubeURL($url) {

    // Let's check the host first
    $parse = parse_url($url);
    $host = $parse['host'];
    if (!in_array($host, array('youtube.com', 'www.youtube.com'))) {
        return false;
    }

    $ch = curl_init();
    $oembedURL = 'www.youtube.com/oembed?url=' . urlencode($url).'&format=json';
    curl_setopt($ch, CURLOPT_URL, $oembedURL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // Silent CURL execution
    $output = curl_exec($ch);
    unset($output);

    $info = curl_getinfo($ch);
    curl_close($ch);

    if ($info['http_code'] !== 404)
        return true;
    else
        return false;
}
	function explodeEmailFromString($emailString){
		$emailArray=explode(',',$emailString);
		return $emailArray;
	}


	function Idencrypt($string, $key='%key&') {
        $result = '';
        for($i=0; $i<strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key))-1, 1);
            $ordChar = ord($char);
            $ordKeychar = ord($keychar);
            $sum = $ordChar + $ordKeychar;
            $char = chr($sum);
            $result.=$char;
        }
        return base64_encode($result);
    }

    function Iddecrypt($string, $key='%key&') {
        $result = '';
        $string = base64_decode($string);
        for($i=0; $i<strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key))-1, 1);
            $ordChar = ord($char);
            $ordKeychar = ord($keychar);
            $sum = $ordChar - $ordKeychar;
            $char = chr($sum);
            $result.=$char;
        }
        return $result;
    }

	function get_domain($url)
	{
	$pieces = parse_url($url);
	$domain = isset($pieces['host']) ? $pieces['host'] : '';
	if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
		return $regs['domain'];
	}
	return false;
	}
	function getVideolength($videoid='') {
		define('YT_API_URL', 'http://gdata.youtube.com/feeds/api/videos?q=');
		$video_id = $videoid;
		//Using cURL php extension to make the request to youtube API
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, YT_API_URL . $video_id);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		//$feed holds a rss feed xml returned by youtube API
		$feed = curl_exec($ch);
		curl_close($ch);

		//Using SimpleXML to parse youtube's feed
		$xml = simplexml_load_string($feed);
		$entry = $xml->entry[0];
		$media = $entry->children('media', true);
		$group = $media->group;
		$vid_duration = $content_attributes['duration'];
		$duration_formatted = str_pad(floor($vid_duration / 60), 2,
		'0', STR_PAD_LEFT) . ':' . str_pad($vid_duration % 60, 2, '0', STR_PAD_LEFT);
		return $duration_formatted;
}
 function getDuration($video_id){
        $data=file_get_contents('http://gdata.youtube.com/feeds/api/videos/'.$video_id.'?v=2&alt=jsonc');
        if (false===$data) return false;
        $obj=json_decode($data);
        return $obj->data->duration;
    }
    function NormalizeDuration($duration){
    preg_match('#PT(.*?)H(.*?)M(.*?)S#si',$duration,$out);
    if(empty($out[1])){
    preg_match('#PT(.*?)M(.*?)S#si',$duration,$out);
    if(empty($out[1])){
    preg_match('#PT(.*?)S#si',$duration,$out);
    if(empty($out[1])){
    return '00:00';
    }
    }else{
    if(strlen($out[1])==1){ $out[1]= '0'.$out[1]; }
    if(strlen($out[2])==1){ $out[2]= '0'.$out[2]; }
    return $out[1].':'.$out[2];
    }
    }else{
    if(strlen($out[1])==1){ $out[1]= '0'.$out[1]; }
    if(strlen($out[2])==1){ $out[2]= '0'.$out[2]; }
    if(strlen($out[3])==1){ $out[3]= '0'.$out[3]; }
   // print_r($out);
    return $out[1].':'.$out[2].':'.$out[3];
    }
    }
     function secondsToTime($inputSeconds) {

        $secondsInAMinute = 60;
        $secondsInAnHour  = 60 * $secondsInAMinute;
        $secondsInADay    = 24 * $secondsInAnHour;

        // extract days
        $days = floor($inputSeconds / $secondsInADay);

        // extract hours
        $hourSeconds = $inputSeconds % $secondsInADay;
        $hours = floor($hourSeconds / $secondsInAnHour);

        // extract minutes
        $minuteSeconds = $hourSeconds % $secondsInAnHour;
        $minutes = floor($minuteSeconds / $secondsInAMinute);

        // extract the remaining seconds
        $remainingSeconds = $minuteSeconds % $secondsInAMinute;
        $seconds = ceil($remainingSeconds);

        // return the final array
        $obj = array(
            'd' => (int) $days,
            'h' => (int) $hours,
            'm' => (int) $minutes,
            's' => (int) $seconds,
        );
        return $obj;
    }

    //Create Ajax pagination
    function createPaginationForData($limit,$numRows,$page){
		$htmlContent='<div class="pagination"><ul>';
		$allPages = ceil($numRows / $limit);
		$start  = ($page - 1) * $limit;
		
		if($limit<$numRows){
			if($page>1){
				$htmlContent.="<li><a href='javascript:loadPageData($next);'><i class='icon-double-angle-left'></i></a></li>";
			}
			if ($page>1) {
				$prev = $page-1;
				//$htmlContent .= "<a href='javascript:loadPageData($prev);'>Previous</a>";
			}
			
			$start=$page-4;
			if($start<1){
				$start=1;
			}
			$end=$page+4;
			if($end>$allPages){
				$end=$page;
			}
			//if($end>$page)
			for ($i = $start; $i <= $end; $i++) {
				$htmlContent .= "<li ".($i==$page?"class=active":"").">";
				$htmlContent .= "<a href='javascript:loadPageData($i);'";
				$htmlContent .= ">$i</a> </li>";

			}
			if ($page<$allPages) {
					$next = $page+1;
					$htmlContent.="<li ><a href='javascript:loadPageData($next);'><i class='icon-double-angle-right'></i></a></li>";
				}
		}
		$htmlContent.='</ul></div>';
		return $htmlContent;
    }
    //Get Height
     function getHeightWidthFromCss($cssArray){
			foreach(explode(';',$cssArray) as $attr){
					 if (strlen(trim($attr)) > 0) // for missing semicolon on last element, which is legal
            {
                list($name, $value) = explode(':', $attr);
					$fname=trim($name);
					$fvalue=trim($value);
					if($fname=='height'){
							$value= str_replace("px","",$value);
							$result['height']=$value;

					}if($fname=='width'){
							$value= str_replace("px","",$value);
							$result['width']=$value;
						}

				}
				}
				return $result;
		  }
	//Get Os image from Name
	function getOsImage($osArray,$osName){
		if(is_array($osArray)){
			$imgName='';
			foreach($osArray as $innerOsArray){
				if($innerOsArray[1]=="$osName"){
					$imgName=$innerOsArray[5];
					break;
				}
			}
			return $imgName;
		}
		return false;
	}
	//Check Hotmail.com,live.com,hotmail.co.in
	function checkHotMailStatus($email){
		$emailDomain=getDomainFromEmail($email);
		if($emailDomain=='hotmail.co.in' || $emailDomain=='hotmail.com' || $emailDomain=='live.com'){
			return true;
		}
		return false;
		
	}

    //Get Real ip
    function getRealIp(){
		$ip=false;
		$proxy_headers = array(
			'HTTP_VIA',
			'HTTP_X_FORWARDED_FOR',
			'HTTP_FORWARDED_FOR',
			'HTTP_X_FORWARDED',
			'HTTP_FORWARDED',
			'HTTP_CLIENT_IP',
			'HTTP_FORWARDED_FOR_IP',
			'VIA',
			'X_FORWARDED_FOR',
			'FORWARDED_FOR',
			'X_FORWARDED',
			'FORWARDED',
			'CLIENT_IP',
			'FORWARDED_FOR_IP',
			'HTTP_PROXY_CONNECTION'
		);
		foreach($proxy_headers as $x){
			if (isset($_SERVER[$x])){
				$ip=$_SERVER[$x];
				break;
			}
		}
		return $ip;
    }

    function Get_IP_ADDRESS() {
    	
    	$ipaddress = '';
    	if (getenv('HTTP_CLIENT_IP'))
        	$ipaddress = getenv('HTTP_CLIENT_IP');
    	else if(getenv('HTTP_X_FORWARDED_FOR'))
        	$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    	else if(getenv('HTTP_X_FORWARDED'))
        	$ipaddress = getenv('HTTP_X_FORWARDED');
    	else if(getenv('HTTP_FORWARDED_FOR'))
        	$ipaddress = getenv('HTTP_FORWARDED_FOR');
    	else if(getenv('HTTP_FORWARDED'))
       		$ipaddress = getenv('HTTP_FORWARDED');
    	else if(getenv('REMOTE_ADDR'))
        	$ipaddress = getenv('REMOTE_ADDR');
    	else
        	$ipaddress = 'UNKNOWN';

    	return $ipaddress;
	
	}
	
    //Fetch Full Json Data
    function getYoutubeURIData($url) {
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch);
		curl_close($ch);
		$result = json_decode($output, true);
		return $result;
	}

	function add_quotes($str) {
    	return sprintf("'%s'", $str);
	}
	
	function nice_number($n) {
        // first strip any formatting;
        $n = (0+str_replace(",","",$n));

        // is this a number?
        if(!is_numeric($n)) return false;

        // now filter it;
        if($n>1000000000000) return round(($n/1000000000000),2).' T';
        else if($n>1000000000) return round(($n/1000000000),2).' B';
        else if($n>1000000) return round(($n/1000000),2).' M';
        else if($n>1000) return round(($n/1000),2).' K';

        return number_format($n);
    }

    function nice_number_second($n) {
        // first strip any formatting;
        $n = (0+str_replace(",","",$n));

        // is this a number?
        if(!is_numeric($n)) return false;

        // now filter it;
        if($n>1000000000000) return round(($n/1000000000000),2).' T';
        else if($n>1000000000) return round(($n/1000000000),2).' B';
        else if($n>1000000) return round(($n/1000000),2).' M';
        else if($n>1000) return round(($n/1000),2).' K';
        return round($n, 2);
    }
    
    function reverse_nice_number($n,$counter) {
        // now filter it;
        //echo $counter.'###################################33'.$n;
        if($counter=='trillion') return round(($n*1000000000000),2);
        else if($counter=='billion') return round(($n*1000000000),2);
        else if($counter=='million') return round(($n*1000000),2);
        else if($counter=='thousand') return round(($n*1000),2);
        return number_format($n);
    }
    //difference between given date
    function monthDiff($givendate){
		$date1 = date(strtotime($givendate));
		$time_now = date("Y-m-d");
		$date2 = date(strtotime($time_now));

		$difference = $date2 - $date1;
		$months = floor($difference / 86400 / 30 );
		return $months;
    }
	//Get From sharedcount api value
	function getSocialCountForVideos($videoid){
		$url="https://www.youtube.com/watch?v=$videoid";
		//$url = ((!empty($_SERVER['HTTPS'])) ? "https://": "http://" ) . $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		$apikey = "ccacd9837217d63b550cdf46638204b5076db33e";
		$json = file_get_contents("http://free.sharedcount.com/?url=" . rawurlencode($url) . "&apikey=" . $apikey);
		$result = json_decode($json, true);
		return $result;
	}
	function getHourDifference($time2){
		$time1 = time();
		$totalHours=(int) (($time1 - $time2) / 3600);
		return $totalHours;

	}
	function getUrls($string) {
		$regex = '/https?\:\/\/[^\" ]+/i';
		preg_match_all($regex, $string, $matches);
		//return (array_reverse($matches[0]));
		return ($matches[0]);
	}
	function getRanking($rank){
		if($rank>=80){
			return "A++";
		}else if($rank>=70 && $rank<80){
			return "A+";
		}else if($rank>=60 && $rank<70){
			return "A";
		}else if($rank>=50 && $rank<60){
			return "B+";
		}else if($rank>=40 && $rank<50){
			return "B";
		}else{
			return "C";
		}
	}
	 //difference between given date
    function yearDiff($givendate){
		$date1 = date(strtotime($givendate));
		$time_now = date("Y-m-d");
		$date2 = date(strtotime($time_now));

		$difference = $date2 - $date1;
		$years = floor($difference / 86400 / 3600 );
		return $years;
    }
    //Get Channel Rank
    function getChannelRank($earning){
		if($earning<=500){
			$grade="C";
		}else if($earning>500 && $earning<=1000){
			$grade="B";

		}else if($earning>1000 && $earning<=5000){
			$grade="B+";
		}else if($earning>5000 && $earning<=15000){
			$grade="A";
		}else if($earning>15000 && $earning<=25000){
			$grade="A+";
		}else{
			$grade="A++";
		}
		return $grade;
    }
    function getVideoRanking($earning){
		if($earning>=3000){
			return "A++";
		}else if($rank>=2500 && $rank<3000){
			return "A+";
		}else if($rank>=2000 && $rank<2500){
			return "A";
		}else if($rank>=1500 && $rank<2000){
			return "B+";
		}else if($rank>=1000 && $rank<1500){
			return "B";
		}else{
			return "C";
		}
	}
	//Date difference in time
	function datediffcur($date1){
		$date2 =date('Y-m-d H:i:s');

		$diff = abs(strtotime($date2) - strtotime($date1));
		
		$years   = floor($diff / (365*60*60*24));
		$months  = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
		$days    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
		$hours   = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60));
		if($years>0){
			if($years>1){
				$diff=$years." Years";
			}else{
				$diff=$years." Year";
			}
		}else if($months>0){
			if($months>1){
				$diff=$months." Months";
			}else{
				$diff=$months." Month";
			}
		}else if($days>0){
			if($days>1){
				$diff=$days." Days";
			}else{
				$diff=$days." Day";
			}
		}else {
			if($hours>1){
				$diff=$hours." Hours";
			}else{
				$diff=$hours." Hour";
			}
		}
		return $diff;
	}
	 function getAccessToken($url,$code,$redurl,$client_id,$secret) {
		$fields = array(
			'code'=>$code,
			'redirect_uri'=>$redurl,
			'client_id'=> $client_id,
			'client_secret'=>$secret,
			'grant_type'=>'authorization_code');
		$fields_string='';
		foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		rtrim($fields_string, '&');

		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch,CURLOPT_HEADER, false); 
		curl_setopt($ch,CURLOPT_POST, count($fields_string));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}
	//check access token is valid or not
	function checkTokenStatus($accessToken){
		$url="https://www.googleapis.com/oauth2/v1/tokeninfo?access_token=$accessToken";
		$result=getYoutubeURIData($url);
		if(isset($result['error']) && $result['error']=='invalid_token'){
			return false;
		}
		return true;
	}
	//Generate New Access token
	function regenerateToken($client_id,$secret,$refreshToken){
		$access_token_uri = 'https://accounts.google.com/o/oauth2/token';
		$fields = array(
			'refresh_token'=>$refreshToken,
			'client_id'=> $client_id,
			'client_secret'=>$secret,
			'grant_type'=>'refresh_token');
		$fields_string='';
		foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		rtrim($fields_string, '&');
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, $access_token_uri);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch,CURLOPT_HEADER, false);
		curl_setopt($ch,CURLOPT_POST, count($fields_string));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
		$result = curl_exec($ch);
		$result = json_decode($result, true);
		curl_close($ch);
		$token=$result['access_token'];
		return $token;
	}
	//Get Autosuggest for youtube
	function getAutoSuggest($keyword){
		$keyword=urlencode($keyword);
		$url="http://suggestqueries.google.com/complete/search?q=$keyword&client=toolbar&ds=yt";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $url);    // get the url contents

		$data = curl_exec($ch); // execute curl request
		curl_close($ch);

		$xml = simplexml_load_string($data);
		$json = json_encode($xml);
		$array = json_decode($json,TRUE);
		return $array;
	}
	//Get total search count
	function getCompetitonRank($searchvolume){
		if($searchvolume>90000){
			$return=5;
		}else if($searchvolume<90000 && $searchvolume>50000){
			$return=4;
		}else if($searchvolume<50000 && $searchvolume>10000){
			$return=3;
		}else if($searchvolume<10000 && $searchvolume>5000){
			$return=2;
		}else{
			$return=1;
		}
		return $return;

	}
	function getCompStatus($cmp){
		$retStatus="label-danger";
		if($cmp>0.80){
			$retStatus="label-success";
		}else if($cmp<0.80 && $cmp>0.60){
			$retStatus="label-primary";
		}else if($cmp<0.60 && $cmp>0.40){
			$retStatus="label-info";
		}else if($cmp<0.40 && $cmp>0.20){
			$retStatus="label-warning";
		}else{
			$retStatus="label-danger";
		}
		return $retStatus;
	}
	function getRetCompStatus($cmp){
		$retStatus="Poor";
		if($cmp>0.80){
			$retStatus="Very Competitive";
		}else if($cmp<0.80 && $cmp>0.60){
			$retStatus="Competitive";
		}else if($cmp<0.60 && $cmp>0.40){
			$retStatus="Medium";
		}else if($cmp<0.40 && $cmp>0.20){
			$retStatus="Average";
		}else{
			$retStatus="Poor";
		}
		return $retStatus;
	}
	function getFacebookStats($videoid){
		$url="https://www.youtube.com/watch?v=$videoid";
		$json = file_get_contents("https://api.facebook.com/method/links.getStats?urls=".rawurlencode($url)."&format=json");
		//$result = json_decode($json, true);
		$result=json_decode($json, true);
		$totalArray=array();
		$totalcount=0;
		if(isset($result[0]['share_count'])){
			$totalcount+=$totalArray['share_count']=$result[0]['share_count'];
		}
		if(isset($result[0]['comment_count'])){
			$totalcount+=$totalArray['comment_count']=$result[0]['comment_count'];
		}
		if(isset($result[0]['like_count'])){
			$totalcount+=$totalArray['like_count']=$result[0]['like_count'];
		}

		$totalArray['total']=$totalcount;
		return $totalArray;
	}
	function dayDiff($givendate){
		$date1 = date(strtotime($givendate));
		$time_now = date("Y-m-d");
		$date2 = date(strtotime($time_now));

		$difference = $date2 - $date1;
		$months = floor($difference / 86400 );
		return $months;
    }
    function getVideoIdFromUrl($yturl){
		parse_str( parse_url( $yturl, PHP_URL_QUERY ), $my_array_of_vars );
		return $my_array_of_vars['v'];
    }
    function pagingWithVideos($limit,$numRows,$page){
		$allPages       = ceil($numRows / $limit);
		$start          = ($page - 1) * $limit;
		$querystring = "";
		foreach ($_GET as $key => $value) {
			if ($key != "page") $paginHTML .= "$key=$value&amp;";
		}
		$paginHTML = "";
		$paginHTML .= "Pages: ";

		for ($i = 1; $i <= $allPages; $i++) {
			if ($i>1) {
						$prev = $i-1;
						//$paginHTML .= '<a href="?'.$querystring.'page='.$prev'">Previous</a>';
					}
					$paginHTML .= "<a " . ($i == $page ? "class=\"selected\" " : "");
			$paginHTML .= "href=\"?{$querystring}page=$i";
			$paginHTML .= "\">$i</a> ";
					if ($i<$allPages) {
						$next = $i+1;
						//$paginHTML .= '<a href="?'.$querystring.'page='.$next'">Next</a>';
					}
		}

		return $paginHTML;

	}
	function percentage($val1, $val2, $precision)
	{
		$division = $val1 / $val2;

		$res = $division * 100;

		$res = round($res, $precision);

		return $res;
	}
	//get function to display success and error msg
	function getSucErMsg($value,$succArray,$erArray){
		$html='';
		if(isset($value['success'])){
			$success=$value['success'];
			if(isset($succArray[$success])){
				$sucMsg=$succArray[$success];
				$html='<div class="alert alert-success" role="alert">'.$sucMsg.'</div>';
			}
		}
		if(isset($value['error'])){
			$error=$value['error'];
			if(isset($erArray[$error])){
				$sucMsg=$erArray[$error];
				$html='<div class="alert alert-danger" role="alert">'.$sucMsg.'</div>';
			}
		}
		return $html;
	}
	//Get Google Search Rank
	function getGoogleSuggestion($query,$lang='en'){
		$url = 'http://suggestqueries.google.com/complete/search?output=firefox&client=firefox&hl=' . $lang . '&q=' . urlencode($query);
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.0; rv:2.0.1) Gecko/20100101 Firefox/4.0.1");
		$data = curl_exec($ch);
		curl_close($ch);
		$suggestions = json_decode($data, true);
		return $suggestions;
	}
	//Get Youtube Suggestion
	function getYoutubeSuggestion($query,$lang=''){
		if($lang!=''){
			$url = 'http://suggestqueries.google.com/complete/search?output=firefox&client=firefox&ds=yt&hl=' . $lang . '&q=' . urlencode($query);
		}else{
			$url = 'http://suggestqueries.google.com/complete/search?output=firefox&client=firefox&ds=yt&q=' . urlencode($query);
		}
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.0; rv:2.0.1) Gecko/20100101 Firefox/4.0.1");
		$data = curl_exec($ch);
		curl_close($ch);
		$suggestions = json_decode($data, true);
		return $suggestions;
	}
	//Get Total Google Search Result
	function getGoogleSearchPosition($query,$start=0){
		$url="https://ajax.googleapis.com/ajax/services/search/web?v=1.0&q=$query&start=$start&rsz=large&callback=?";
		$body = file_get_contents($url);
		$json = json_decode($body);
		$result=$json->responseData->results;
		return $result;
	}
	//Get Google Rank competition
	function getGoogleCompetitonRank($query){
		$query=str_replace(' ','+',$query);
		$url="http://ajax.googleapis.com/ajax/services/search/web?v=1.0&q=$query&start=1&key=".GOOGLE_DEV_KEY."&userip=".$_SERVER['REMOTE_ADDR'];
		$body = file_get_contents($url);
		$json = json_decode($body);
		$searchvolume=isset($json->responseData->cursor->resultCount)?$json->responseData->cursor->resultCount:0;
		$searchvolume = str_replace( ',', '', $searchvolume );
		if($searchvolume>10000000){
			$return=5;
		}else if($searchvolume<10000000 && $searchvolume>1000000){
			$return=4;
		}else if($searchvolume<1000000 && $searchvolume>100000){
			$return=3;
		}else if($searchvolume<500000 && $searchvolume>100000){
			$return=2;
		}else{
			$return=1;
		}
		return $return;

	}
	function check_word($keyword){
       $url = "http://ajax.googleapis.com/ajax/services/search/web?v=1.0&q=".
		$keyword."&key=".GOOGLE_DEV_KEY."&userip=".$_SERVER['REMOTE_ADDR'];

				// sendRequest
				// note how referer is set manually
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_REFERER,1); /* Enter the URL of your site here*/
				$body = curl_exec($ch);
				curl_close($ch);

				// now, process the JSON string
				$json = json_decode($body);
				return $json;

	}
	function getGradeClass($grade){
		if($grade==1){
			$class="btn-nw";
		}else if($grade==2){
			$class="btn-nw1";
		}else if($grade==3){
			$class="btn-nw2";
		}else if($grade==4){
			$class="btn-nw3";
		}else{
			$class="btn-nw4";
		}
		return $class;
	}
	//Get youtube rank of video on keyword
	function getVideoRankOnKeywordGoogle($videoid,$query){
		$googleRank="No Rank";
		$youtubeUrl="https://www.youtube.com/watch?v=$videoid";
		return $googleRank;
		for($i=1;$i<5;$i++){
			//$result=getGoogleSearchPosition($query);
			foreach($result as $videoUrl){
				if(isset($videoUrl['url']) && $videoUrl['url']==$youtubeUrl){
					$googleRank=$i;
					break;
				}
				$i++;
			}
		}
		return $googleRank;
		
	}
	//Check Value in multidimensional Array
	function in_array_r($fullArray,$checkValue) {
		$return=false;
		if(is_array($fullArray)){
			foreach($fullArray as $key=>$value){
				if(strtolower($value[0])==strtolower($checkValue)){
					$return=$fullArray[$key];
					break;
				}
			}
		}
		return $return;
	}
	 function getYoutubeVideoTag($videoid){
		$tagurl="http://130.211.251.37/videotags/$videoid";
		$response = @file_get_contents($tagurl);
                
		$decoded=json_decode($response,true);
		return $decoded['videotag'];
    }
    function validYoutube($id){
		$id = trim($id);
		if (strlen($id) === 11){
			$file = @file_get_contents('http://gdata.youtube.com/feeds/api/videos/'.$id);
			return !!$file;
		}
		return false;
	}
	//Get Youtube video Rank with keyword
	function getYTRank($fullitems,$videoid){
		$i=1;
		$keywordRank="No Rank";
		if(is_array($fullitems)){
			foreach($fullitems as $videoResult){
				if(isset($videoResult['id']['videoId'])){
					if($videoResult['id']['videoId']==$videoid){
						$keywordRank=$i;
						break;
					}
				}
				$i++;
			}
		}
		return $keywordRank;
	}
	//get partner
	function getPartnername($channelid,$devkey){
		$recentUploadUrl="https://www.googleapis.com/youtube/v3/search?key=$devkey&channelId=$channelid&part=snippet&order=date&maxResults=1";
		$res=getYoutubeURIData($recentUploadUrl);
		$vidid=$res['items'][0]['id']['videoId'];
                $tags = get_meta_tags("http://www.youtube.com/watch?v=$vidid");
                $networkname=$tags['attribution'];
		return $networkname;
	}
        
      
        
        
	function givendaysDiff($date1,$date2){
		$date1 = date(strtotime($date1));
		$date2 = date(strtotime($date2));

		$difference = $date2 - $date1;
		$months = floor($difference / 86400 );
		return $months;
       }
       
    //Get all Users data
    function getChannelSubDataFromES($channelid,$fullESipArray,$start=0,$size=20){
		$randkey = array_rand($fullESipArray,1);
		$randIP=$fullESipArray[$randkey];
		$url="http://$randIP:9200/channelsubscribers/subscription/_search?q=$channelid&from=$start&size=$size";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch);
		curl_close($ch);
		$result = json_decode($output, true);
		return $result;
	}

	function validateDate($date, $format = 'Y-m-d') {
		$d = DateTime::createFromFormat($format, $date);
		return $d && $d->format($format) == $date;
	}
        
        
 function calcDensity($string){   
      $words = explode(" ",$string);   
      $common_words = "i,he,she,it,and,me,my,you,the"; 
      $common_words = strtolower($common_words);
      $common_words = explode(",", $common_words);
      $words_sum = 0;     
      foreach ($words as $value){
        $common = false;
        $value = trim_replace($value);
        if (strlen($value) > 3){
          foreach ($common_words as $common_word){
            if ($common_word == $value){
              $common = true;
            }
          }
          if ($common != true){
            if (!preg_match("/http/i", $value) && !preg_match("/mailto:/i", $value)) {
              $keywords[] = $value;
              $words_sum++;
            }
          }
        }
      }  
      $keywords = array_count_values($keywords);
      arsort($keywords);
      $results = array();
                  $results []= array(
                          'total words' => $words_sum
      );
      foreach ($keywords as $key => $value){
            $percent = 100 / $words_sum * $value;
                        $results []= array(
                    'keyword' => trim($key),
                                'count' => $value,
                                'percent' => round($percent, 2)
            );
      }
      return $results; 
    } 
    
     function trim_replace($string) {
      $string = trim($string);
      return (string)str_replace(array("\r", "\r\n", "\n"), '', $string);
    }
    
    
    //Get Channel Influencer data
	function getActivityOfChannel($chid){
		//if($chid=='UCbcQvk29SRAhCju1--6Vzkg'){
			//$fullUrl=
			$data = '{"query":{"match_phrase":{"pchannelid":"'.$chid.'"}},"from": 0,"size": 20}';
			$ch = curl_init('http://104.154.35.220:9200/subscribersactivity*/activity/_search');
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Content-Type: application/json',
				'Content-Length: ' . strlen($data))
			);
			$result = curl_exec($ch);
		/*}else{
			$result='';
		}*/
		return $result;
	}
        
        
        //New Function created by Suhel
        //Get User page access        
       
        function getUserPageAccess($userType=NULL,$pageName=NULL)
        {
            $result=0;
            
            if($userType==1){
              $result=1;    
            }
            elseif($userType==2){ 
              $result=1; 
            }elseif($userType==3){
                global $userTypeArrayChannelOwner;
                if(in_array($pageName,$userTypeArrayChannelOwner))
                        { $result=1; }
            }elseif($userType==4){
            	$result=1;
                //global $userTypeArrayChannelManager;
                //if(in_array($pageName,$userTypeArrayChannelManager))
                       // { $result=1; }
            }elseif($userType==5){
            	$result=1;
                //global $userTypeArrayFinance;
                //if(in_array($pageName,$userTypeArrayFinance))
                       // { $result=1; }
            }elseif($userType==6){
            	$result=1;
                //global $userTypeArrayRecruitment;
                //if(in_array($pageName,$userTypeArrayRecruitment))
                       // { $result=1; }
            }else{
              $result=0;  
            }
            
            if($result==1){
            return true;                
            }
            else{
                 //header("Location: ".ABS_URL.'/allow');
                return false;
            }         
            
        }
        
        //Start code for status
        function getStatus($status){
           $str='';
           if($status==0)
           {
             $str='Pending';              
           }
           elseif($status==1){
             $str='Active';    
           }
           elseif($status==2){
             $str='Rejected';    
           }
           elseif($status==3){
             $str='Intermediate';    
           }
           elseif($status==4){
             $str='Deleted';    
           }
           elseif($status==5){
             $str='Black Listed';    
           }
           
           if($str!=''){
               return($str);
           }
           else{
               return(0);               
           }
           
        }
        
        //Start code for status color 
        function getStatusColor($status){
           $str='';
           if($status==0)
           {
             $str='Pending';              
           }
           elseif($status==1){
             $str='Active';    
           }
           elseif($status==2){
             $str='Rejected';    
           }
           elseif($status==3){
             $str='Intermediate';    
           }
           elseif($status==4){
             $str='Deleted';    
           }
           elseif($status==5){
             $str='Black Listed';    
           }
           
           if($str!=''){
               return($str);
           }
           else{
               return(0);               
           }
           
        }
      
        
        
                
        function gender($gender)
        {
          if($gender=='M'){$str='Male';}else{$str='Female';} 
          return($str);
        } 

        // Randum password 5 digits
        function fiveDigitRand()
        {
         $number=rand(100,100000);
         return($number);
        }
?>

<?php 
// Start code for jquery pagination
function paginationLink($totalCount,$pageSize,$showStart,$page){
	
if($totalCount > 10) {
	$noOfIteration=ceil($totalCount/$pageSize);
	$flag=0;
	$forward=$showStart;
	$backward=0;

	$starti=1;
	$startBackward=0;
	$previ=$page;
	$previ-=1;
	$prevBackward=$showStart-$pageSize;

	$minLimit=$page-4;
	$maxLimit=$page+4;
	?>
<ul class="pagination pull-right" >
<?php if(($page=='')or($page==0)){?>
 <li><span aria-hidden="true">&laquo;&nbsp;Start</span> </li>
 <li><span aria-hidden="true">&laquo;&nbsp;Prev</span></li>
 <?php }else{?>
 <li><a href="#" onclick="myPagination('','')"   aria-label="Previous" title="Start"><span aria-hidden="true">&laquo;&nbsp;Start</span></a></li>
 <li><a href="#" onclick="myPagination('<?php echo $prevBackward?>','<?php echo $previ;?>')"  aria-label="Previous" title="Prev">&laquo;&nbsp;Prev</a></li>
	<?php }?>

	<?php
	for($i=0;$i<$noOfIteration;$i++){
		$j = $i + 1;
		if($i>=$page){
			if($page==$i){
				if($noOfIteration!=1){
					echo '<li><a href="#" class="active">'.$j.'</a></li>';
				}
			}else{
				if($i>=$minLimit && $i<=$maxLimit){?>
			        <li><a href="#" onclick="myPagination('<?php echo $forward?>','<?php echo $i;?>')" aria-hidden="true"><strong><?php echo $j;?></strong></a></li>
				<?php }
					
			}
			$forward+=$pageSize;
		}else{
			if($page==$i){
				if($noOfIteration!=1){
				    echo '<li><a href="#" class="active">'.$j.'</a></li>';
				}
			}else{
				if($i>=$minLimit && $i<=$maxLimit){?>
				  <li><a href="#" onclick="myPagination('<?php echo $backward?>','<?php echo $i;?>')"  aria-hidden="true"><strong><?php echo $j;?></strong></a></li>
				<?php }
			}
			$backward+=$pageSize;
		}
	}
	$endi=$i;
	$endi-=1;
	$endForward=$forward;
	$endForward-=$pageSize;
	$nexti=$page;
	$nexti+=1;
	$nextForward=$showStart+$pageSize;
        $lastpage=$page+1;
	?>
	<?php if($noOfIteration==$lastpage){?>
            <li><span aria-hidden="true">Next&nbsp; &raquo;</span></li>
            <li><span aria-hidden="true">End&nbsp; &raquo;</span></li>                                 
	<?php }else{?>      
            <li><a href="#" onclick="myPagination('<?php echo $nextForward?>','<?php echo $nexti;?>')"   aria-label="Next" title="Next"><span aria-hidden="true">Next&nbsp; &raquo;</span></a></li>
            <li><a href="#" onclick="myPagination('<?php echo $endForward?>','<?php echo $endi;?>')"  aria-label="Next" title="End"><span aria-hidden="true">End&nbsp; &raquo;</span></a></li>
	<?php }?>
      </ul>  
    <?php  } }
    
  // End  code for jquery pagination  
 

// Start code for jquery pagination without href
function jqueryPaginationLink($totalCount,$pageSize,$showStart,$page){
	
if($totalCount > 10) {
	$noOfIteration=ceil($totalCount/$pageSize);
	$flag=0;
	$forward=$showStart;
	$backward=0;

	$starti=1;
	$startBackward=0;
	$previ=$page;
	$previ-=1;
	$prevBackward=$showStart-$pageSize;

	$minLimit=$page-4;
	$maxLimit=$page+4;
	?>
<ul class="pagination pull-right" >
<?php if(($page=='')or($page==0)){?>
 <li><span aria-hidden="true">&laquo;&nbsp;Start</span> </li>
 <li><span aria-hidden="true">&laquo;&nbsp;Prev</span></li>
 <?php }else{?>
 <li><span style="cursor: pointer;" onclick="myPagination('','')"   aria-label="Previous" title="Start"><span aria-hidden="true">&laquo;&nbsp;Start</span></span></li>
 <li><span style="cursor: pointer;" onclick="myPagination('<?php echo $prevBackward?>','<?php echo $previ;?>')"  aria-label="Previous" title="Prev">&laquo;&nbsp;Prev</span></li>
	<?php }?>

	<?php
	for($i=0;$i<$noOfIteration;$i++){
		$j = $i + 1;
		if($i>=$page){
			if($page==$i){
				if($noOfIteration!=1){
					echo '<li><span style="cursor: pointer;" class="active">'.$j.'</span></li>';
				}
			}else{
				if($i>=$minLimit && $i<=$maxLimit){?>
			        <li><span style="cursor: pointer;" onclick="myPagination('<?php echo $forward?>','<?php echo $i;?>')" aria-hidden="true"><strong><?php echo $j;?></strong></span></li>
				<?php }
					
			}
			$forward+=$pageSize;
		}else{
			if($page==$i){
				if($noOfIteration!=1){
				    echo '<li><span style="cursor: pointer;" class="active">'.$j.'</span></li>';
				}
			}else{
				if($i>=$minLimit && $i<=$maxLimit){?>
				  <li><span style="cursor: pointer;" onclick="myPagination('<?php echo $backward?>','<?php echo $i;?>')"  aria-hidden="true"><strong><?php echo $j;?></strong></span></li>
				<?php }
			}
			$backward+=$pageSize;
		}
	}
	$endi=$i;
	$endi-=1;
	$endForward=$forward;
	$endForward-=$pageSize;
	$nexti=$page;
	$nexti+=1;
	$nextForward=$showStart+$pageSize;
        $lastpage=$page+1;
	?>
	<?php if($noOfIteration==$lastpage){?>
            <li><span aria-hidden="true">Next&nbsp; &raquo;</span></li>
            <li><span aria-hidden="true">End&nbsp; &raquo;</span></li>                                 
	<?php }else{?>      
            <li><span style="cursor: pointer;" onclick="myPagination('<?php echo $nextForward?>','<?php echo $nexti;?>')"   aria-label="Next" title="Next"><span aria-hidden="true">Next&nbsp; &raquo;</span></span></li>
            <li><span style="cursor: pointer;" onclick="myPagination('<?php echo $endForward?>','<?php echo $endi;?>')"  aria-label="Next" title="End"><span aria-hidden="true">End&nbsp; &raquo;</span></span></li>
	<?php }?>
      </ul>  
    <?php  } }
    
  // End  code for jquery pagination without href 
 



    
  // Start code for Category
  function getCategoryNmae($categoryID)
        {
            global $categoryArray;
            return($categoryArray[$categoryID]);         
        }
   // End code for Category
       
        
     // Start code file extension
  function getFileIcon($extension)
        {
                if($extension=='txt')
                {
                 $icon='fa fa-file-text';   
                }
                elseif($extension=='pdf')
                {
                  $icon='fa fa-file-pdf-o';   
                }
                elseif($extension=='doc')
                {
                  $icon='fa fa-file-word-o';
                }
                elseif($extension=='docx')
                {
                  $icon='fa fa-file-word-o';
                }
                elseif($extension=='word')
                {
                 $icon='fa fa-file-word-o';   
                } 
                elseif($extension=='ppt')
                {
                  $icon='fa fa-file-powerpoint-o';  
                } 
                elseif($extension=='xcel')
                {
                  $icon='fa fa-file-excel-o';   
                } 
                else
                {
                  $icon='fa fa-file-o';  
                } 
              return($icon);             
        }
   // End code for file extension
      
         //Start code for status present tense 
        function getStatusName($status){
           $str='';
           if($status=='Pending')
           {
             $str='make pending';              
           }
           
           elseif($status=='Approved'){
             $str='approve';    
           }
           elseif($status=='Rejected'){
             $str='reject';    
           }
           elseif($status=='Intermediate'){
             $str='intermediate';    
           }
           elseif($status=='Deleted'){
             $str='delete';    
           }
           elseif($status=='Black Listed'){
             $str='black list';    
           }
           
           if($str!=''){
               return($str);
           }
           else{
               return(0);               
           }
           
        }
        
        
        //Start code for status present tense 
        function getStatusSmallList($status){ echo $status;
           $str='';
           if($status=='Pending')
           {
             $str='make pending';              
           }
           
           elseif($status=='Approved'){
             $str='approve';    
           }
           elseif($status=='Deleted'){
             $str='delete';    
           }
                      
           if($str!=''){
               return($str);
           }
           else{
               return(0);               
           }
           
        }
        
     function channelVerification($channelId)
     {
        $url="https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id=$channelId&key=".GOOGLE_DEV_KEY."";
        $result=getYoutubeURIData($url);
        $itemsArray=$result['items'];
        if(is_array($itemsArray)){
            foreach($itemsArray as $item){ 
                if($item['kind']=='youtube#channel'){
                        $thumbnail=$item['snippet']['thumbnails']['default']['url'];
                        return($thumbnail);
                }
            }
        }
         
     }
     
     
     function getChannelUsername($channelId)
                {
                    
                    $so_user       =  array();
                    $userGuid      = 'e6b18416-580f-4175-80fe-6f590ab742b5';
                    $connectorGuid = '2cab30e3-90c8-4b02-a906-6a57669585ef';
                    $apiKey        = 'e6b18416-580f-4175-80fe-6f590ab742b5:oec6Z5pI0jAM1r3oTY/o3OfgtzNsUTk2FFyjqRX/xGBKSZE0Jzrt9bz/X3sVjL30oNxx7TiRTdxxHWBTD6gfpw==';
                    $channel_url   = 'https://www.youtube.com/channel/'.$channelId.'/about';                   
                    $url           = "https://query.import.io/store/connector/" . $connectorGuid . "/_query?_user=" . urlencode($userGuid) . "&_apikey=" . urlencode($apiKey);
                    
                    $ch = curl_init($url);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    "Content-Type: application/json",
                    "import-io-client: import.io PHP client",
                    "import-io-client-version: 2.0.0"
                    ));
                    curl_setopt($ch, CURLOPT_POSTFIELDS,  json_encode(array("input" => array( "webpage/url" => $channel_url))));
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_HEADER, 0);
                    $json_data = curl_exec($ch);
                    curl_close($ch);
                    
                    print_r($json_data);
                    die();
                    /*
                    $decode_json = json_decode($json_data);

                    $dom = new DOMDocument;
                    $dom->loadHTML($decode_json->results[0]->html);
                    $xpath = new DOMXPath($dom);
                    $nodes = $xpath->query('//a/@href');
                    
                    print_r($nodes);
                    
                    
                    
                    foreach($nodes as $href) {
                            $user_name = substr($href->nodeValue, strrpos($href->nodeValue, '/') + 1);
                            if(preg_match("/facebook.com/", $href->nodeValue, $matches)) {
                                    echo $so_user['fb_user'] = $href->nodeValue;                                    
                            } else if(preg_match("/twitter.com/", $href->nodeValue, $matches)) {
                                    echo $so_user['tw_user'] = $href->nodeValue;                                    
                            } else if(preg_match("/instagram.com/", $href->nodeValue, $matches)) {
                                    echo $so_user['ig_user'] = $href->nodeValue;                                   
                            } else if(preg_match("/plus.google.com/", $href->nodeValue, $matches)) {
                                    echo $so_user['gp_user'] = $href->nodeValue;                                    
                            } else if(preg_match("/vine/", $href->nodeValue, $matches)) {
                                    echo $so_user['vn_user'] = $href->nodeValue;                                   
                            }               
                    }*/
                    	
            }
            
           function unAuthorizeAccess($url)
           {
               header('location:'.$url.'/controller.php?flowtype=3');
           }
           
           function convetMinutsToSecond($seconds)
           {
                    $minutes = floor($seconds/60);
                    $secondsleft = $seconds%60;
                    if($minutes<10)
                    $minutes = "0" . $minutes;
                    if($secondsleft<10)
                    $secondsleft = "0" . $secondsleft;
                    $result=$minutes.':'.$secondsleft;
                    return ($result);
           }

    //get subscriber activity on Channel wise
	 function getChannelSubActivityOnChannel($channelid,$fullESipArray){
		$randkey = array_rand($fullESipArray,1);
		$randIP=$fullESipArray[$randkey];
		$url="http://$randIP:9200/subscriberactivity*/_search?search_type=count";
		$data='{"query": { "filtered": { "query": {"match_all": {}}, "filter": {"bool" : {"must" : [{"term" : {"cChannelId" : "'.$channelid.'"}}]}}}},"aggs":{"types":{"terms":{"field":"contentDetails.resourceId.channelId","size":50}}}}';
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Content-Length: ' . strlen($data))
		);
		$result = curl_exec($ch);
		$result = json_decode($result, true);
		return $result;
	}
	 //get YT Channel social Urls html
    function getYTurlsHtml($channelid){
		$userGuid      = 'e6b18416-580f-4175-80fe-6f590ab742b5';
		$connectorGuid = '2cab30e3-90c8-4b02-a906-6a57669585ef';
		$apiKey        = 'e6b18416-580f-4175-80fe-6f590ab742b5:oec6Z5pI0jAM1r3oTY/o3OfgtzNsUTk2FFyjqRX/xGBKSZE0Jzrt9bz/X3sVjL30oNxx7TiRTdxxHWBTD6gfpw==';
		$channel_url='https://www.youtube.com/channel/'.$channelid.'/about';
		$url="https://query.import.io/store/connector/" . $connectorGuid . "/_query?_user=" . urlencode($userGuid) . "&_apikey=" . urlencode($apiKey);
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			"Content-Type: application/json",
			"import-io-client: import.io PHP client",
			"import-io-client-version: 2.0.0"
		));
		curl_setopt($ch, CURLOPT_POSTFIELDS,  json_encode(array("input" => array( "webpage/url" => $channel_url))));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$json_data = curl_exec($ch);
		curl_close($ch);
		$decode_json = json_decode($json_data);
		$fullhtml='';
		$fullChannelUrls['fb']=$fullChannelUrls['tw']=$fullChannelUrls['in']=$fullChannelUrls['vn']='';
		if(isset($decode_json->results[0]->html) && $decode_json->results[0]->html!=''){
			$dom = new DOMDocument;
			$dom->loadHTML($decode_json->results[0]->html);
			$xpath = new DOMXPath($dom);
			$nodes = $xpath->query('//a/@href');
			$fbuser=$twuser=$gpuser=$iguser=$vnuser='';
			$fullurlsArray='';
			foreach($nodes as $href) {
				//print_r($href);
				$nodeurl=$href->nodeValue;
				//$user_name = substr($href->nodeValue, strrpos($href->nodeValue, '/') + 1);
				$fullurlsArray[]=$href->nodeValue;
				if(preg_match("/facebook.com/", $href->nodeValue, $matches)) {
					$fullhtml.='<a target="_blank" href="'.$nodeurl.'"><i class="fa fa-facebook-square fbCol"></i></a>';
				} else if(preg_match("/twitter.com/", $href->nodeValue, $matches)) {
					$fullhtml.='<a target="_blank" href="'.$nodeurl.'"><i class="fa fa-twitter-square twCol"></i></a>';
				} else if(preg_match("/instagram.com/", $href->nodeValue, $matches)) {
					$fullhtml.='<a target="_blank" href="'.$nodeurl.'"><i class="fa fa-instagram insCol"></i></a>';
				} else if(preg_match("/plus.google.com/", $href->nodeValue, $matches)) {
					$fullhtml.='<a target="_blank" href="'.$nodeurl.'"><i class="fa fa-google-plus-square gooCol"></i></a>';
				} else if(preg_match("/vine/", $href->nodeValue, $matches)) {
					$fullhtml.='<a target="_blank" href="'.$nodeurl.'"><i class="fa fa-vimeo-square vinCol"></i></a>';
				}
			}

		}
		if(trim($fullhtml)==''){
			$fullhtml='<img src="'.RES_URL_V1DASH.'/images/no-socialdata.png">';
		}
		return $fullhtml;
   }
   //
   //get YT Channel social Urls
    function getSocialUrlsDifferentByChannelid($channelid){
		$userGuid      = 'e6b18416-580f-4175-80fe-6f590ab742b5';
		$connectorGuid = '2cab30e3-90c8-4b02-a906-6a57669585ef';
		$apiKey        = 'e6b18416-580f-4175-80fe-6f590ab742b5:oec6Z5pI0jAM1r3oTY/o3OfgtzNsUTk2FFyjqRX/xGBKSZE0Jzrt9bz/X3sVjL30oNxx7TiRTdxxHWBTD6gfpw==';
		$channel_url='https://www.youtube.com/channel/'.$channelid.'/about';
		$url="https://query.import.io/store/connector/" . $connectorGuid . "/_query?_user=" . urlencode($userGuid) . "&_apikey=" . urlencode($apiKey);
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			"Content-Type: application/json",
			"import-io-client: import.io PHP client",
			"import-io-client-version: 2.0.0"
		));
		curl_setopt($ch, CURLOPT_POSTFIELDS,  json_encode(array("input" => array( "webpage/url" => $channel_url))));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$json_data = curl_exec($ch);
		curl_close($ch);
		$decode_json = json_decode($json_data);
		$fullChannelUrls['fb']=$fullChannelUrls['tw']=$fullChannelUrls['in']=$fullChannelUrls['vn']='';
		if(isset($decode_json->results[0]->html) && $decode_json->results[0]->html!=''){
			$dom = new DOMDocument;
			$dom->loadHTML($decode_json->results[0]->html);
			$xpath = new DOMXPath($dom);
			$nodes = $xpath->query('//a/@href');
			$fbuser=$twuser=$gpuser=$iguser=$vnuser='';
			$fullurlsArray='';
			foreach($nodes as $href) {
				//$user_name = substr($href->nodeValue, strrpos($href->nodeValue, '/') + 1);
				//$fullurlsArray[]=$href->nodeValue;
				if(preg_match("/facebook.com/", $href->nodeValue, $matches)) {
					$fullChannelUrls['fb']=$href->nodeValue;
				} else if(preg_match("/twitter.com/", $href->nodeValue, $matches)) {
					$fullChannelUrls['tw']=$href->nodeValue;
				} else if(preg_match("/instagram.com/", $href->nodeValue, $matches)) {
					$fullChannelUrls['in']=$href->nodeValue;
				} else if(preg_match("/plus.google.com/", $href->nodeValue, $matches)) {
					$fullChannelUrls['gp']=$href->nodeValue;
				} else if(preg_match("/vine/", $href->nodeValue, $matches)) {
					$fullChannelUrls['vn']=$href->nodeValue;
				}
			}
		}
		return $fullChannelUrls;
    }

    //get YT Channel social Urls html
    function getSocialChnlHtml($channelid){
		$userGuid      = 'e6b18416-580f-4175-80fe-6f590ab742b5';
		$connectorGuid = '2cab30e3-90c8-4b02-a906-6a57669585ef';
		$apiKey        = 'e6b18416-580f-4175-80fe-6f590ab742b5:oec6Z5pI0jAM1r3oTY/o3OfgtzNsUTk2FFyjqRX/xGBKSZE0Jzrt9bz/X3sVjL30oNxx7TiRTdxxHWBTD6gfpw==';
		$channel_url='https://www.youtube.com/channel/'.$channelid.'/about';
		$url="https://query.import.io/store/connector/" . $connectorGuid . "/_query?_user=" . urlencode($userGuid) . "&_apikey=" . urlencode($apiKey);
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			"Content-Type: application/json",
			"import-io-client: import.io PHP client",
			"import-io-client-version: 2.0.0"
		));
		curl_setopt($ch, CURLOPT_POSTFIELDS,  json_encode(array("input" => array( "webpage/url" => $channel_url))));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$json_data = curl_exec($ch);
		curl_close($ch);
		$decode_json = json_decode($json_data);
		$fullhtml='';
		$fullChannelUrls['fb']=$fullChannelUrls['tw']=$fullChannelUrls['in']=$fullChannelUrls['vn']='';
		if(isset($decode_json->results[0]->html) && $decode_json->results[0]->html!=''){
			$dom = new DOMDocument;
			$dom->loadHTML($decode_json->results[0]->html);
			$xpath = new DOMXPath($dom);
			$nodes = $xpath->query('//a/@href');
			$fbuser=$twuser=$gpuser=$iguser=$vnuser='';
			$fullurlsArray='';
			foreach($nodes as $href) {
				//print_r($href);
				$nodeurl=$href->nodeValue;
				//$user_name = substr($href->nodeValue, strrpos($href->nodeValue, '/') + 1);
				$fullurlsArray[]=$href->nodeValue;
				if(preg_match("/facebook.com/", $href->nodeValue, $matches)) {
					$fullhtml.='<a target="_blank" href="'.$nodeurl.'" class="fb"><i class="fa fa-facebook"></i></a>';
				} else if(preg_match("/twitter.com/", $href->nodeValue, $matches)) {
					$fullhtml.='<a target="_blank" href="'.$nodeurl.'" class="twt"><i class="fa fa-twitter"></i></a>';
				} else if(preg_match("/instagram.com/", $href->nodeValue, $matches)) {
					$fullhtml.='<a target="_blank" href="'.$nodeurl.'" class="inst"><i class="fa fa-instagram"></i></a>';
				} else if(preg_match("/plus.google.com/", $href->nodeValue, $matches)) {
					$fullhtml.='<a target="_blank" href="'.$nodeurl.'" class="gp"><i class="fa fa-google-plus"></i></a>';
				} else if(preg_match("/vine/", $href->nodeValue, $matches)) {
					$fullhtml.='<a target="_blank" href="'.$nodeurl.'" class="vine"><i class="fa fa-vine"></i></a>';
				}
			}

		}
		return $fullhtml;
    }

    //get activities by video category wise
	 function getChannelSubActivityByVidcat($channelid,$fullESipArray,$st=0,$end=20){
		$randkey = array_rand($fullESipArray,1);
		$randIP=$fullESipArray[$randkey];
		$url="http://$randIP:9200/subscriberactivity*/_search?search_type=count";
		if($st && $end){
			$data='{"query":{"filtered":{"query":{"match_all":{}},"filter":{"bool":{"must":[{"term":{"cChannelId":"'.$channelid.'"}},{"range" : {"snippet.publishedAt" : {"gte" : "'.$st.'", "lt" : "'.$end.'"}}}]}}}},"aggs":{"types":{"terms":{"field":"contentDetails.resourceId.categoryId","size":30}}}}';
		}else{
			$data='{"query":{"filtered":{"query":{"match_all":{}},"filter":{"bool":{"must":[{"term":{"cChannelId":"'.$channelid.'"}}]}}}},"aggs":{"types":{"terms":{"field":"contentDetails.resourceId.categoryId","size":30}}}}';
		}
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Content-Length: ' . strlen($data))
		);
		$result = curl_exec($ch);
		$result = json_decode($result, true);
		return $result;
	}
	//get activities by activity type
	 function getChannelSubActivityByActivity($channelid,$fullESipArray,$st=0,$end=0){
		$randkey = array_rand($fullESipArray,1);
		$randIP=$fullESipArray[$randkey];
		$url="http://$randIP:9200/subscriberactivity*/_search?search_type=count";
		if($st && $end){
			$data='{"query":{"filtered":{"query":{"match_all":{}},"filter":{"bool":{"must":[{"term":{"cChannelId":"'.$channelid.'"}},{"range" : {"snippet.publishedAt" : {"gte" : "'.$st.'", "lt" : "'.$end.'"}}}]}}}},"aggs":{"types":{"terms":{"field":"snippet.type","size":20}}}}';
		}else{
			$data='{"query":{"filtered":{"query":{"match_all":{}},"filter":{"bool":{"must":[{"term":{"cChannelId":"'.$channelid.'"}}]}}}},"aggs":{"types":{"terms":{"field":"snippet.type","size":20}}}}';
		}
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Content-Length: ' . strlen($data))
		);
		$result = curl_exec($ch);
		$result = json_decode($result, true);
		return $result;
	}
	//get subscriber activity on video wise
	 function getChannelSubActivityOnVideo($channelid,$fullESipArray){
		$randkey = array_rand($fullESipArray,1);
		$randIP=$fullESipArray[$randkey];
		$url="http://$randIP:9200/subscriberactivity*/_search?search_type=count";
		$data='{"query":{"filtered":{"query":{"match_all":{}},"filter":{"bool":{"must":[{"term":{"cChannelId":"'.$channelid.'"}}],"must_not":[{"term":{"contentDetails.resourceId.channelId":"'.$channelid.'"}}]}}}},"aggs":{"types":{"terms":{"field":"contentDetails.resourceId.videoId","size":50}}}}';
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Content-Length: ' . strlen($data))
		);
		$result = curl_exec($ch);
		$result = json_decode($result, true);
		return $result;
	}
	function get_string_between($string, $start, $end){
		$string = ' ' . $string;
		$ini = strpos($string, $start);
		if ($ini == 0) return '';
		$ini += strlen($start);
		$len = strpos($string, $end, $ini) - $ini;
		return substr($string, $ini, $len);
	}

	//get all channel info
	function getChannelInfo($postarray){
		$mainurl="https://vidooly.com/api.php";
		$params=$postarray;
		$params['case']=1;
		$session = curl_init($mainurl);
		curl_setopt ($session, CURLOPT_POST, true);
		curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
		curl_setopt($session, CURLOPT_HEADER, false);
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($session);
		curl_close($session);
		$results  = json_decode ( $response, TRUE );
		return $results;

	}
	function getTotalChCnt($postarray){
		$mainurl="https://vidooly.com/api.php";
		$params=$postarray;
		$params['case']=2;
		$session = curl_init($mainurl);
		curl_setopt ($session, CURLOPT_POST, true);
		curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
		curl_setopt($session, CURLOPT_HEADER, false);
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($session);
		curl_close($session);
		$results  = json_decode ( $response, TRUE );
		return $results;

	}
	function getTotalMCN($postarray){
		$mainurl="https://vidooly.com/api.php";
		$params=$postarray;
		$params['case']=3;
		$session = curl_init($mainurl);
		curl_setopt ($session, CURLOPT_POST, true);
		curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
		curl_setopt($session, CURLOPT_HEADER, false);
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($session);
		curl_close($session);
		$results  = json_decode ( $response, TRUE );
		return $results;

	}
	function createChannelPagination($limit,$numRows,$page,$fullurl){
		$maxpagination=5;
		$allPages = ceil($numRows / $limit);
		if(($page)>3){
			$stpage=$page-2;
		}else{
			$stpage=1;
		}
		if(($page>3) && (($page+2)<$allPages)){
			$endpage=$page+2;
		}else{
			$endpage=5;
		}
		$start  = ($page - 1) * $limit;
		if($limit<$numRows){
			$paginHTML= "<ul class='pagination mr0'> ";
			if ($page>1) {
				$prev = $page-1;
				$paginHTML .='<li class="paginate_button previous" aria-controls="editable" tabindex="0" id="editable_previous">';
				$paginHTML .= "<a href=\"$fullurl&page=$prev";
				$paginHTML .= "\">Previous</a> </li>";
			}
			for ($i = $stpage; $i <= $endpage; $i++) {
				//$bi=base64_encode($i);
				$paginHTML .= "<li aria-controls='editable' tabindex='0'".(($i==$page)?"class=paginate_button active":"class=paginate_button").">";
				$paginHTML .= "<a href=\"$fullurl&page=$i";
				$paginHTML .= "\">$i</a> </li>";
			}
			if ($page<$allPages) {
				$prev = $page+1;
				//$nprev=base64_encode($prev);
				$paginHTML .='<li class="paginate_button next" aria-controls="editable" tabindex="0" id="editable_next">';
				$paginHTML .= "<a href=\"$fullurl&page=$prev";
				$paginHTML .= "\">Next</a> </li>";
			}
			$paginHTML .= "</ul>";
			return $paginHTML;
		}
	}
        
        /// get access Token form paypal payment gateway
        function getPaypalPaymentAccesToken($clientId, $SecretKey)
        {
            $url = "https://api.sandbox.paypal.com/v1/oauth2/token";
            $ch = curl_init ( $url );
            curl_setopt($ch, CURLOPT_URL, "https://api.sandbox.paypal.com/v1/oauth2/token");
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_USERPWD, $clientId.":".$SecretKey);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
            $result = curl_exec($ch);

            if(empty($result))
            {    
                 $accessToken="Error: No response.";
            }    
            else
            {
            $json = json_decode($result); 
            $accessToken=$json->access_token;
            } 
            return ($accessToken);
        }
        
        
         function getPappalFee($fixe, $percentage, $amount)
                {
                  $rtn=0;
                  if($amount>0)
                  {
                    $amt=(($amount*$percentage)/100) +$fixe;
                    $rtn=$amt;
                  }
                  return $rtn;
                }              
        
                
    function videosRecordsAPI($videoId, $id)
      {
        $url="https://www.googleapis.com/youtube/v3/videos?part=snippet%2Cplayer,statistics&id=$videoId&fields=etag%2CeventId%2Citems%2Ckind%2CnextPageToken%2CpageInfo%2CprevPageToken%2CtokenPagination%2CvisitorId&key=".GOOGLE_DEV_KEY."";
        $result=getYoutubeURIData($url);
        
        $itemsArray=$result['items'];
        if(is_array($itemsArray)){
            foreach($itemsArray as $item){ 
                if($item['kind']=='youtube#video'){                   
                    $arr['id']=$id;
                    $arr['videoId']=$item['id'];
                    $arr['title']=$item['snippet']['title'];
                    $arr['channelId']=$item['snippet']['channelId'];
                    $arr['description']=$item['snippet']['description'];
                    $arr['player']=$item['player']['embedHtml']; 
                    $arr['publishedAt']=$item['snippet']['publishedAt'];
                    $arr['default']=$item['snippet']['thumbnails']['default']['url'];
                    $arr['medium']=$item['snippet']['thumbnails']['medium']['url'];
                    $arr['high']=$item['snippet']['thumbnails']['high']['url'];
                    $arr['categoryId']=$item['snippet']['categoryId'];
                    $arr['channelTitle']=$item['snippet']['channelTitle'];            
                    
                    $arr['viewCount']=$item['statistics']['viewCount'];
                    $arr['likeCount']=$item['statistics']['likeCount'];
                    $arr['dislikeCount']=$item['statistics']['dislikeCount'];
                    $arr['favoriteCount']=$item['statistics']['favoriteCount'];
                    $arr['commentCount']=$item['statistics']['commentCount'];
                    
                }
            }
            return($arr);    
        }         
     } 
     
     
     
      function channelRecordsAPI($channelId, $id)
      {
        $url="https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id=$channelId&key=".GOOGLE_DEV_KEY."";
        $result=getYoutubeURIData($url);
        $itemsArray=$result['items'];
        if(is_array($itemsArray)){
            foreach($itemsArray as $item){ 
                if($item['kind']=='youtube#channel'){
                    //$id=$item['id'];
                    $arr['id']=$id;
                    $arr['title']=$item['snippet']['title'];
                    //$arr['description']=$item['snippet']['description'];
                    //$arr['publishedAt']=$item['snippet']['publishedAt'];
                    $arr['default']=$item['snippet']['thumbnails']['default']['url'];
                    //$arr['medium']=$item['snippet']['thumbnails']['medium']['url'];
                    //$arr['high']=$item['snippet']['thumbnails']['high']['url'];
                    //$arr['country']=$item['snippet']['country'];
                    //$arr['viewCount']=$item['statistics']['viewCount'];
                    //$arr['commentCount']=$item['statistics']['commentCount'];
                    //$arr['subscriberCount']=$item['statistics']['subscriberCount'];
                    //$arr['videoCount']=$item['statistics']['videoCount'];
                }
            }
            return($arr);    
        }
         
     }
     

     function videosMultipleRecordsAPI($videoId, $id)
      {
        $url="https://www.googleapis.com/youtube/v3/videos?part=snippet%2Cplayer,statistics&id=$videoId&fields=etag%2CeventId%2Citems%2Ckind%2CnextPageToken%2CpageInfo%2CprevPageToken%2CtokenPagination%2CvisitorId&key=".GOOGLE_DEV_KEY."";
        $result=getYoutubeURIData($url);
        $itemsArray=$result['items'];
        return($itemsArray);
     } 
     
  
    function getBasicDataHbase($mcnid, $cmsid, $channelids, $st=0, $end=0) {
		$url  = 'http://'.HBASEIP.'/mcnstats/basic_stats.php';
		$key  = hash('sha256', $mcnid);
		$data = "mcnid=$mcnid&cmsid=$cmsid&channelid=$channelids&start_date=$st&end_date=$end&key=$key";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Length: ' . strlen($data))
		);
		$result = curl_exec($ch);
		$result = json_decode($result, true);
		return $result; 
	}

	function getBasicDataHbaseChnlWise($mcnid, $cmsid, $channelids, $st=0, $end=0) {
		$url  = 'http://'.HBASEIP.'/mcnstats/basic_stats.php';
		$key  = hash('sha256', $mcnid);
		$data = "mcnid=$mcnid&cmsid=$cmsid&channelid=$channelids&start_date=$st&end_date=$end&order=channel_id&key=$key";
		$ch   = curl_init($url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Length: ' . strlen($data))
		);
		$result = curl_exec($ch);
		$result = json_decode($result, true);
		return $result; 
	}

	function getDeviceDataHbase($mcnid, $cmsid, $channelids, $st=0, $end=0) {
		$url  = 'http://'.HBASEIP.'/mcnstats/device_stats.php';
		$key  = hash('sha256', $mcnid);
		$data = "mcnid=$mcnid&cmsid=$cmsid&channelid=$channelids&start_date=$st&end_date=$end&key=$key";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Length: ' . strlen($data))
		);
		$result = curl_exec($ch);
		$result = json_decode($result, true);
		return $result; 
	}

	function getTrafficDataHbase($mcnid, $cmsid, $channelids, $st=0, $end=0) {
		$url  = 'http://'.HBASEIP.'/mcnstats/traffic_sources_stats.php';
		$key  = hash('sha256', $mcnid);
		$data = "mcnid=$mcnid&cmsid=$cmsid&channelid=$channelids&start_date=$st&end_date=$end&type=all&key=$key";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Length: ' . strlen($data))
		);
		$result = curl_exec($ch);
		$result = json_decode($result, true);
		return $result; 
	}

	function getExternalDataHbase($mcnid, $cmsid, $channelids, $st=0, $end=0) {
		$url  = 'http://'.HBASEIP.'/mcnstats/traffic_sources_stats.php';
		$key  = hash('sha256', $mcnid);
		$data = "mcnid=$mcnid&cmsid=$cmsid&channelid=$channelids&start_date=$st&end_date=$end&type=embedded&key=$key";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Length: ' . strlen($data))
		);
		$result = curl_exec($ch);
		$result = json_decode($result, true);
		return $result; 
	}

	function getGeoDataHbase($mcnid, $cmsid, $channelids, $st=0, $end=0) {
		$url  = 'http://'.HBASEIP.'/mcnstats/geography_stats.php';
		$key  = hash('sha256', $mcnid);
		$data = "mcnid=$mcnid&cmsid=$cmsid&channelid=$channelids&start_date=$st&end_date=$end&key=$key";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Length: ' . strlen($data))
		);
		$result = curl_exec($ch);
		$result = json_decode($result, true);
		return $result; 
	}

	function getAllDataHbase($mcnid, $cmsid, $channelids) {
		$url  = 'http://'.HBASEIP.'/mcnstats/basic_stats.php';
		$key  = hash('sha256', $mcnid);
		$data = "mcnid=$mcnid&cmsid=$cmsid&channelid=$channelids&key=$key";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Length: ' . strlen($data))
		);
		$result = curl_exec($ch);
		$result = json_decode($result, true);
		return $result; 
	}

	function getChannelHbase($mcnid, $cmsid, $channelids) {
		$url  = 'http://'.HBASEIP.'/mcnstats/monthly_revenue.php';
		$key  = hash('sha256', $mcnid);
		$data = "mcnid=$mcnid&cmsid=$cmsid&channelid=$channelids&key=$key";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Length: ' . strlen($data))
		);
		$result = curl_exec($ch);
		$result = json_decode($result, true);
		return $result; 
	}
        
        
           function priviousRank($lifeTime_views, $lifeTime_subscriberCount, $viewCount,$subscriberCount, $likeCount, $dislikeCount, $commentCount, $sharesCount,$revenueCount, $priviousMonthViewCount, $priviousMonthSubscriberCount)
                {
                    $totalpercent=0; 
                    //Lifetime Views (3%)  
                    $lifetimView=(($lifeTime_views/100)*3);

                    //Lifetime Subscribers (5%)
                    $lifetimesubs=((($lifeTime_subscriberCount)/100)*5);

                    // Monthly Views (12%)
                    $monthelyView=(($viewCount/100)*12);

                    //Absolute Monthly View Growth v/s previous month (20%)
                    $monthelyViewGroath=(($viewCount-$priviousMonthViewCount)/100)*20;

                    //Monthly Subscription (15%)
                    $monthelySubscription=(($subscriberCount/100)*15);  

                    //Absolute Monthly Subscription Growth v/s previous month (20%)
                    $monthelySubscriptionGroath=((($subscriberCount-$priviousMonthSubscriberCount)/100)*20);
                    //Monthly Ratio of Like/Dislike (5%)
                    if($dislikeCount==0){
                       $dislikeCount=1; 
                    }
                    $likeDislike=((($likeCount/$dislikeCount)/100)*5);

                    //Number of Comment in that month (7%)
                    $cmt=($commentCount/100)*7;

                    //Number of Shares in that month (8%)
                    $share=(($sharesCount/100)*8);
                    //Monthly Revenue (5%)
                    $revenue=(($revenueCount/100)*5);                                    
                    $totalpercent=($lifetimView)+($lifetimesubs)+($monthelyView)+($monthelyViewGroath)+($monthelySubscription)+($monthelySubscriptionGroath)+($likeDislike)+($cmt)+($share)+($revenue);
                    return   $totalpercent;                
                }
                    
            

?>
