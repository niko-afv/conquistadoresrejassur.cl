<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* CodeIgniter   Log Class
*
* @author		Pedro Montero A.
* @copyright	Copyright (c) 2012.
* @since		Version 1.0
* @filesource
*
**/
class Log{
	
	protected $object;
	private   $user = array();
	private   $val  = '';
	
	public function __construct(){
		 $this->object =& get_instance();
		 $this->object->load->model('md_bo');
	}
	
	public function user($val = false){
		$this->user = array(
			'userId'		=> $this->object->session->userdata('userBo_id'),//$_SESSION['userBo_id'],
			'userAccion'	=> $val,
			'userIp'		=> $_SERVER['REMOTE_ADDR'],
			'userAgent'		=> $_SERVER['HTTP_USER_AGENT'],
			'userReferer'	=> $_SERVER['HTTP_REFERER'],
			'userDate'		=> date("Y-m-d H:i:s")			
		);
		return $val?$this->object->md_bo->boUserLog($this->user):false;
	}	
}
