<?php

include_once("meta_model.php");

class Users extends metaModel {
	public function __construct(){
		parent::__construct();
	}

	public function checkEmailExits($email)
	{
		$q = "select id from users where email='".fix_for_mysql($email)."'";
    	$this->setQuery($query);
		if($this->getTotalReturnRows() > 0)
		{
			$result = $this->getSingleRecord();
			return $result['id'];
		} else {
			return 0;
		}
	}

	/*
	public function addNewUser($email,$password) {
		$ip=$_SERVER['REMOTE_ADDR'];
		$case="insert";
		$query="insert into users set email='".fix_for_mysql($email)."',password='".fix_for_mysql($password)."',ip='".fix_for_mysql($ip)."',status=1,date_created=now()";
		$this->setQuery($query);
		if($this->runQuery($case)){
			$userid=$this->getLastInsertId();
			if($userid>0){
				$Month = 2592000 + time();
				$datastring = SALT.':'.$email.':'.$userid.':1:'.USER_TYPE.''; 		
				$datastring = encrypt($datastring);
				setcookie('VIDCOOK',$datastring, $Month, "/",DOMAIN);
			}
			return $userid;
		}
		return 0;
	}
		



                
                //Update payment temp storage data
                public function updateTempNote($id, $note) {			
                        $currentDate=date('Y-m-d H:i:s', strtotime('now'));
                        $rtn=0;                        
                        $query="update payment_temp set note='".fix_for_mysql($note)."' where id=".$id;
                        $this->setQuery($query);
                        if($this->runQuery('update')){                            
                           $rtn=1;       
                        }                        
                        return ($rtn);                     
		} 
                
          */      
                


}
