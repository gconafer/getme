<?php 
session_start();
include_once ("../config.php");
include_once("../global.php");
include_once("../class/batch_class.php");

if((isset($_REQUEST['flowtype'])) && (isset($_POST)) && (isset($_SESSION['id'])) && (isset($_SESSION['instituate_id'])))
{
	$Batch = new Batch();
	$flowtype = $_REQUEST['flowtype'];

	if(isset($_POST) && $flowtype == 1)
	{
		if(isset($_POST['type']) && ($_POST['type'] == 'add' || $_POST['type'] == 'edit') && ($_POST['batch_id']) && ($_POST['course_id']) && ($_POST['duration']) && ($_POST['start_date'])) {
			$BatchId = base64_decode(trim($_POST['batch_id']));
			if($BatchId) {
				$BatchDetailArray = $Batch->getBatchDetail($_SESSION['instituate_id'], $BatchId);
				if(is_array($BatchDetailArray) && !empty($BatchDetailArray)) {
					$Bid = $Batch->updateBatch($BatchDetailArray['id'], $_POST['course_id'], $_POST['start_date'], $_POST['timing'], $_POST['class_duration'], $_POST['duration'], $_POST['description']);
					if($Bid) {
						$array = array('status' => 'success');
					} else {
						$array = array('status' => 'error');
					}
				} else {
					$array = array('status' => 'error');
				}
			} else {
				$Bid = $Batch->insertBatch($_SESSION['instituate_id'], $_POST['course_id'], $_POST['start_date'], $_POST['timing'], $_POST['class_duration'], $_POST['duration'], $_POST['description']);
				if($Bid) {
					$array = array('status' => 'success');
				} else {
					$array = array('status' => 'error');
				}
			}
		} else {
			$array = array('status' => 'error');
		}
		echo json_encode($array);

	} else if(isset($_POST) && $flowtype == 2) {

		if(isset($_POST['batch_id']) && !empty($_POST['batch_id'])) {
			$BatchId = base64_decode(trim($_POST['batch_id']));
			$BatchDetailArray = $Batch->getBatchDetail($_SESSION['instituate_id'], $BatchId);
			if($BatchId && is_array($BatchDetailArray) && !empty($BatchDetailArray)) {
				$Bid = $Batch->deleteBatch($BatchDetailArray['id']);
				if($Bid) {
					$array = array('status' => 'success');
				} else {
					$array = array('status' => 'error');
				}
			} else {
				$array = array('status' => 'error');
			}
		} else {
			$array = array('status' => 'error');
		}
		echo json_encode($array);
	}

} else {
	header("location:".DASH_URL);
	die();
}
        


