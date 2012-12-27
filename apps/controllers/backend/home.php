<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
	var $title;
	
	public function __construct(){
		parent::__construct();
		$this->title = 'Bo';
		$this->layout = array('base'=>'main','meta','header','sidebar','footer');
		$this->session->loginState('userBo_session');	
		#backoffice
		//$this->load->model('backoffice');
		//$this->boLogin = $this->model_backoffice_base->pin('top');
		//$data['query'] = $this->pin;
	}
	
	public function index(){
		$data['title'] = $this->title; //title base to backoffice
		$data['category_title'] = 'Home BackOffice'; //title base to category
		$this->load->view('backend/home',$data);
	}
}