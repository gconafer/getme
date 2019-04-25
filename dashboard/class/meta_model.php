<?php

class metaModel {

    private $_conn;
    private $_query;
    var $_errormsg;
    var $_errorno;
    private $_resultconn;

    public function __construct() 
    {
		
			$this->_conn = DBConnection();
    }

    public function setQuery($query) 
    {
        $this->_query = $query;
    }

    public function getQuery() 
    {
        return $this->_query;
    }

    public function runQuery($state = null) 
    {

        $this->_resultconn = mysqli_query($this->_conn, $this->_query);

        if (!empty($state)) 
        {
            switch ($state) {
                case 'update':
                    if (mysqli_affected_rows($this->_conn) > 0) {
                        $this->_resultconn = true;
                    } else {
                        $this->_resultconn = false;
                    }
                    break;
                case 'insert':
                    if (mysqli_insert_id($this->_conn) > 0) {
                        $this->_resultconn = true;
                    } else {
                        $this->_resultconn = false;
                    }
                    break;
            }
        }
        if ($this->_resultconn) {
            return true;
        } else {
            $this->_errormsg = mysqli_error($this->_conn);
            $this->_errorno = mysqli_error($this->_conn);
            return false;
        }
    }

    public function getTotalRecordInArray() 
    {
        $returnarr = array();
        if ($this->runQuery()) {
            if (mysqli_num_rows($this->_resultconn) > 0) {
                while ($row = mysqli_fetch_assoc($this->_resultconn)) {
                    $returnarr[] = $row;
                }
            }
        }
        return $returnarr;
    }

    public function getSingleRecord() 
    {
        $returnarr = array();
        if ($this->runQuery()) {
            if (mysqli_num_rows($this->_resultconn) > 0) {
                return $row = mysqli_fetch_assoc($this->_resultconn);
            }
        }
        return $returnarr;
    }

    public function getTotalReturnRows() 
    {
        $returnarr = 0;
        if ($this->runQuery()) {
            return mysqli_num_rows($this->_resultconn);
        }
        return $returnarr;
    }

    public function getError() 
    {
        return $this->_errormsg;
    }

    public function getLastInsertId() 
    {
        return mysqli_insert_id($this->_conn);
    }

    public function getAffectedRows() 
    {
        return mysqli_affected_rows($this->_conn);
    }

    public function fix_for_mysqli($value) 
    {
        if (get_magic_quotes_gpc())
        $value = trim($value);
        $value = strip_tags($value);
        $value = stripslashes($value);
        $value = mysqli_real_escape_string($this->_conn, $value);
        return $value;
    }

    public function __destruct() {
        
    }

}

