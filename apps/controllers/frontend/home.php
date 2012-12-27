<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
	var $title;
	
	public function __construct(){
		parent::__construct();
		$this->title = 'pm';
		$this->layout = array('base'=>'main','meta','header','footer');
	}
	
	public function index(){
		$data['title'] = $this->title; 
		$this->load->view('frontend/home',$data);
	}
}