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

        $this->email->from('no-reply@conquistadoresrejassur.cl', 'Website Rejas Sur');
        $this->email->to('niko.afv@gmail.com');
        //$this->email->cc('another@another-example.com');
        //$this->email->bcc('them@their-example.com');

        $this->email->subject('Email Test');
        $this->email->message($this->input->post('name') . " - " . $this->input->post('email') . " - " . $this->input->post('subject') . " - " . $this->input->post('message'));

        $this->email->send();

        echo $this->email->print_debugger();
    }
}