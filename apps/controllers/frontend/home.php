<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
	var $title;
	
	public function __construct(){
		parent::__construct();
		$this->title = 'Conquistadores Rejas Sur';
		//$this->layout = array('base'=>'main','meta','header','footer');
	}
	
	public function index(){
		$data['title'] = $this->title; 
		$this->load->view('frontend/home',$data);
	}

    public function contact(){
        //print_r($this->input->post());
        $this->load->library('email');

        $this->email->from('contacto@conquis.com', 'Website Rejas Sur');
        $this->email->to('niko.afv@gmail.com');
        //$this->email->cc('another@another-example.com');
        //$this->email->bcc('them@their-example.com');

        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');

        $this->email->send();

        echo $this->email->print_debugger();
    }
}