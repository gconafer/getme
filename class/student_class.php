<?php

include_once("meta_model.php");

class Student extends metaModel {
	public function __construct() {
		parent::__construct();
	}

	public function getStudentByEmail($Email, $type)
	{
		if ($type == 1) {
			$q = "SELECT * FROM entrepreneur where email = '".$this->fix_for_mysqli($Email)."'";
		} else {
			$q = "SELECT * FROM investor where email = '".$this->fix_for_mysqli($Email)."'";
		}
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result;
		} else {
			return array();
		}
	}
	

	public function getStudentById($Id, $type)
	{
		if ($type == 1) {
			$q = "SELECT * FROM entrepreneur where id = '".$this->fix_for_mysqli($Id)."'";
		} else {
			$q = "SELECT * FROM investor where id = '".$this->fix_for_mysqli($Id)."'";
		}
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result;
		} else {
			return array();
		}
	}

	public function getStudentByEmailAndPassword($Email, $Password, $type)
	{
		if ($type == 1) {
			$q = "SELECT * FROM entrepreneur where email = '".$this->fix_for_mysqli($Email)."' and password = '".$this->fix_for_mysqli($Password)."'";
		} else {
			$q = "SELECT * FROM investor where email = '".$this->fix_for_mysqli($Email)."' and password = '".$this->fix_for_mysqli($Password)."'";
		}

		
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result;
		} else {
			return array();
		}
	}

	public function checkOldPassword($id, $type, $old_password)
	{
		if ($type == 1) {
			$q = "SELECT * FROM entrepreneur where id = ".$this->fix_for_mysqli($id)." and password = '".$this->fix_for_mysqli($old_password)."'";
		} else {
			$q = "SELECT * FROM investor where id = ".$this->fix_for_mysqli($id)." and password = '".$this->fix_for_mysqli($old_password)."'";
		}
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result;
		} else {
			return array();
		}
	}

	public function insertStudent($name, $email, $password, $type)
	{
		$case = "insert";
		if ($type == 1) {
			$q = "Insert into entrepreneur set name = '".$this->fix_for_mysqli($name)."', email = '".$this->fix_for_mysqli($email)."', password = '".$this->fix_for_mysqli($password)."', loginType = 1, formNumber = 1";
		} else {
			$q = "Insert into investor set name = '".$this->fix_for_mysqli($name)."', email = '".$this->fix_for_mysqli($email)."', password = '".$this->fix_for_mysqli($password)."', loginType = 1, formNumber = 1";
		}
		$this->setQuery($q);
		if($this->runQuery($case)) {
			$Id = $this->getLastInsertId();
			if($Id > 0) {
				return $Id;
			} else {
				return 0;
			}
		}
	}

	public function updateStudent($name, $email, $password, $type, $contact_no, $image, $gender, $fb_link, $gplus_link, $email_status, $status, $id)
	{
		$q = "";
		$case = "update";
		if(!empty($name)) $q.= "name = '".$this->fix_for_mysqli($name)."', ";
		if(!empty($email)) $q.= "email = '".$this->fix_for_mysqli($email)."', ";
		if(!empty($password)) $q.= "password = '".$this->fix_for_mysqli($password)."', ";
		if(!empty($type)) $q.= "type = '".$this->fix_for_mysqli($type)."', ";
		if(!empty($contact_no)) $q.= "name = '".$this->fix_for_mysqli($contact_no)."', ";
		if(!empty($image)) $q.= "image = '".$this->fix_for_mysqli($image)."', ";
		if(!empty($gender)) $q.= "gender = '".$this->fix_for_mysqli($gender)."', ";
		if(!empty($fb_link)) $q.= "fb_link = '".$this->fix_for_mysqli($fb_link)."', ";
		if(!empty($gplus_link)) $q.= "gplus_link = '".$this->fix_for_mysqli($gplus_link)."', ";
		if(!empty($email_status)) $q.= "email_status = '".$this->fix_for_mysqli($email_status)."', ";
		if(!empty($status)) $q.= "status = '".$this->fix_for_mysqli($status)."', ";

		$query = "update Student set ".$q." modified_on = '".date('Y-m-d H:i:s')."' where id = ".$this->fix_for_mysqli($id);
		$this->setQuery($query);
		if($this->runQuery($case)) {
			return true;
		} else {
			return false;
		}
	}

	public function updateStudentPassword($password, $id)
	{
		$case = "update";
		$q = "update Student set password = '".$this->fix_for_mysqli($password)."', modified_on = '".date('Y-m-d H:i:s')."' where id = ".$this->fix_for_mysqli($id);
		$this->setQuery($q);
		if($this->runQuery($case)) {
			return true;
		} else {
			return false;
		}
	}

	public function updateUserPassword($id, $type, $password)
	{
		$case = "update";
		if ($type == 1) {
			$q = "update entrepreneur set password = ".$this->fix_for_mysqli($password)." where id = ".$this->fix_for_mysqli($id);
		} else {
			$q = "update investor set password = ".$this->fix_for_mysqli($password)." where id = ".$this->fix_for_mysqli($id);
		}
		$this->setQuery($q);
		if($this->runQuery($case)) {
			return true;
		} else {
			return false;
		}
	}

	public function getFN($id) {
		$q = "SELECT * FROM entrepreneur where id = ".$this->fix_for_mysqli($id);
    	$this->setQuery($q);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result['formNumber'];
		} else {
			return array();
		}
	}

	public function formOne($id, $pphone, $sname, $website, $cofounder, $member)
	{
		$N = $this->getFN($id);
		if(!$N) {
			$N = 0;
		} else {
			$N = 2;
		}
		$case = "update";
		$q = "update entrepreneur set contactNo = '".$this->fix_for_mysqli($pphone)."', startupName = '".$this->fix_for_mysqli($sname)."', websiteUrl = '".$this->fix_for_mysqli($website)."', noOfCofounder = '".$this->fix_for_mysqli($cofounder)."', noOfTeamMember = '".$this->fix_for_mysqli($member)."', formNumber = '".$this->fix_for_mysqli($N)."' where id = ".$this->fix_for_mysqli($id);
		$this->setQuery($q);
		if($this->runQuery($case)) {
			return true;
		} else {
			return false;
		}
	}

	public function formTwo($id, $cregistered, $dataofinception, $location, $competitorname, $sector, $tstartup, $fundingraised, $stage)
	{
		$N = $this->getFN($id);
		if(!$N) {
			$N = 0;
		} else {
			$N = 3;
		}
		$case = "update";
		$q = "update entrepreneur set inceptionDate = '".$this->fix_for_mysqli($dataofinception)."', registered = '".$this->fix_for_mysqli($cregistered)."', sectorId = '".$this->fix_for_mysqli($sector)."', startupType = '".$this->fix_for_mysqli($tstartup)."', stageId = '".$this->fix_for_mysqli($stage)."', fundingRaisedAlready = '".$this->fix_for_mysqli($fundingraised)."',nearestCompetitorName = '".$this->fix_for_mysqli($competitorname)."', locationName = '".$this->fix_for_mysqli($location)."', formNumber = '".$this->fix_for_mysqli($N)."' where id = ".$this->fix_for_mysqli($id);
		$this->setQuery($q);
		if($this->runQuery($case)) {
			return true;
		} else {
			return false;
		}
	}

	public function formThree($id, $avgM, $totalR, $expM, $amtW, $equD, $amtI)
	{
		$N = $this->getFN($id);
		if(!$N) {
			$N = 0;
		} else {
			$N = 4;
		}
		$case = "update";
		$q = "update entrepreneur set avgMonthlyRevenue = '".$this->fix_for_mysqli($avgM)."', totalRevenueTillNow = '".$this->fix_for_mysqli($totalR)."', revenueNextFiveYears = '".$this->fix_for_mysqli($expM)."', lookingToRaise = '".$this->fix_for_mysqli($amtW)."', equityDilutedForAboveAmount = '".$this->fix_for_mysqli($equD)."', amountInvestedAlready = '".$this->fix_for_mysqli($amtI)."', formNumber = '".$this->fix_for_mysqli($N)."' where id = ".$this->fix_for_mysqli($id);
		$this->setQuery($q);
		if($this->runQuery($case)) {
			return true;
		} else {
			return false;
		}
	}

	public function formFour($id, $abtS, $tags)
	{
		$case = "update";
		$q = "update entrepreneur set aboutUs = '".$this->fix_for_mysqli($abtS)."', tags = '".$this->fix_for_mysqli($tags)."', formNumber = 0 where id = ".$this->fix_for_mysqli($id);
		$this->setQuery($q);
		if($this->runQuery($case)) {
			return true;
		} else {
			return false;
		}
	}

}
?>