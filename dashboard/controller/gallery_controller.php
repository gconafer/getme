<?php
session_start();
include_once ("../config.php");
include_once("../global.php");
include_once ("../class/gallery_class.php");

if((isset($_REQUEST['flowtype'])) && (isset($_POST)) && (isset($_SESSION['id'])) && (isset($_SESSION['instituate_id'])))
{
	$Gallery = new Gallery();
	$flowtype = $_REQUEST['flowtype'];

	if(isset($_POST) && $flowtype == 1)
	{

		$valid_formats = array("jpg", "png", "jpeg", "PNG", "JPG", "JPEG","gif","GIF");
		if(!empty($_FILES['image']['name']) && !empty($_FILES['image']['type']) && $_FILES['image']['size'] > 0) {
			$i = strrpos($_FILES['image']['name'], ".");
			$l = strlen($_FILES['image']['name']) - $i;
      		$ext = substr($_FILES['image']['name'], $i+1, $l);
  			if(in_array($ext, $valid_formats) && $_FILES['image']['size'] < (20*1024*1024)) {
  				$GalleryArray = $Gallery->getInstituteFeatureGallery($_SESSION['instituate_id'], 1);
  				if(is_array($GalleryArray) && !empty($GalleryArray)) {
  					$featured_status = 0;
  				} else {
  					$featured_status = 1;
  				}
  				$imageName = 'image_'.time().'.'.$ext;
  				if(move_uploaded_file($_FILES['image']['tmp_name'], ABS_I_IMG_DIR.'/'.$imageName)) {
  					$GIid = $Gallery->insertGallery($_SESSION['instituate_id'], 0, 1, $featured_status, $imageName);
  					if($GIid) {
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
		} else {
			$array = array('status' => 'error');
		}
		echo json_encode($array);

	} else if(isset($_POST) && $flowtype == 2) {

        if(isset($_POST['gallery_id']) && !empty($_POST['gallery_id'])) {
            $GalleryId = base64_decode(trim($_POST['gallery_id']));
            $type = base64_decode(trim($_POST['type']));
            $GalleryDetailArray = $Gallery->getGalleryDetail($_SESSION['instituate_id'], $GalleryId, $type);
            if($GalleryId && is_array($GalleryDetailArray) && !empty($GalleryDetailArray)) {
                $Gid = $Gallery->deleteGallery($GalleryDetailArray['id']);
                if($Gid) {
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
    } else if(isset($_POST) && $flowtype == 3) {

        if(isset($_POST['yt']) && !empty($_POST['yt'])) {
            $GalleryArray = $Gallery->getInstituteFeatureGallery($_SESSION['instituate_id'], 2);
            if(is_array($GalleryArray) && !empty($GalleryArray)) {
                $featured_status = 0;
            } else {
                $featured_status = 1;
            }

            $GIid = $Gallery->insertGallery($_SESSION['instituate_id'], 0, 2, $featured_status, trim($_POST['yt']));
            if($GIid) {
                $array = array('status' => 'success');
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
        


