<?php

class Common {

	public function checkStringSanitize($string)
	{
		if(!empty($string)) 
		{
			$string = ucwords($string);
			$string = trim($string);
			return $string;
		} else {
			return '';
		}
	}

	public function seofriendlyurl($title) 
	{
		$title = preg_replace("!\s+!", " ", $title);
		$title = str_replace(" ","-",strtolower($title));
	    $title = str_replace('"','',strtolower($title));
	    $title = str_replace("'","",strtolower($title));
	    $title = str_replace("&","and",strtolower($title));
	    $title = str_replace(" ? ","-",strtolower($title));
	    $title = str_replace("?","-",strtolower($title));
	    $title = str_replace(":","",strtolower($title));
	    $title = str_replace(",","",strtolower($title));
	    $title = str_replace(";","",strtolower($title));
	    $title = str_replace(".","",strtolower($title));
	    $title = str_replace("(","",strtolower($title));
	    $title = str_replace(")","",strtolower($title));
	    $title = preg_replace("/-+/", "-", $title);
	    return $title;
	}

	function isValidEmail($email) {
		return preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", $email);
	}

}
