<?php
session_start();
include_once ("../config.php");
include_once("../global.php");

if(isset($_REQUEST['flowtype']))
{
	$flowtype = $_REQUEST['flowtype'];

	if ($flowtype == 1) {
		session_destroy();
		header("location:".ABS_URL);
		die();
	}

} else {
	header("location:".ABS_URL);
	die();
}
        


