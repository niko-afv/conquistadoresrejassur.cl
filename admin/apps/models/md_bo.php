<?php
/**
* Model that represents Model_BackOffice_Base at database
* Create  2012-08-30 18:02:00
**/
class md_bo extends CI_Model{
	/**
	* Model Fields	
	**/
	private $sql;
	private $query;
	/**
	* Default Constructor
	**/
	public function __construct(){
		parent::__construct();
	}
	
	public  function boUserLogin($user){		
		$arrException = array();
		foreach($user as $key => $d)$user[$key] = in_array($key,$arrException)?$d:$this->db->escape($d);
		$this->sql = "call spBoUserLogin(".implode(',',$user).")";
		$this->query = $this->db->query($this->sql);
		return $this->query->num_rows()>0?$this->query->result():false;
		
    }
	
	public  function boUserLog($userLog){
		$arrException = array('userId');
		foreach($userLog as $key => $d)$userLog[$key] = in_array($key,$arrException)?$d:$this->db->escape($d);
      	$this->sql = "call spBoUserLog(".implode(',',$userLog).")";
		$this->query = $this->db->query($this->sql);
		return $this->query->num_rows()>0?$this->query->result():false;
    }
}