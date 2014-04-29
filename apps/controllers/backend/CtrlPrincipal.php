<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CtrlPrincipal extends CI_Controller {
	
    var $data;

    public function __construct(){
        parent::__construct();
        $this->load->model('md_bo');
        $this->load->model('usuario');
        $this->load->helper(array('form','url'));
        $this->load->library(array('log'));
        $this->data = $this->session->flashdata('msg');

        if(!$this->session->userdata('userBo_id') && $this->uri->segments[1] != 'login'){
            redirect('admin/login');
        }
    }

    public function index(){
        $this->layout = array('base'=>'main','meta','header','sidebar','footer');
        $data['base_url']   =   base_url();
        $data['page']       =   '';
        $data['msg'] = $this->data;
        $data['category_title'] = "Bienvenido al sistema de administración de conquistadores Rejas Sur";
        $data['title'] = "BackOffice - Bienvenida";
        $this->load->view('backend/home',$data);
    }    

    public function logout(){        
        $oUsuario = new $this->usuario();
        $oUsuario->setId($this->session->userdata("userBo_id"));
        $oUsuario->updateLastLogin();
        foreach($_SESSION as $k => $d)preg_match('/^userBo/',$k)?$this->session->unset_userdata($k):false;
        $this->session->set_flashdata('msg','Sesión cerrada correctamente');
        redirect('admin/login');
    }
    public function pin(){
        $pin = $this->input->post('pin',true);
        switch ($pin){
            case 'hp':$_SESSION['userBo_pin']['h']=0;break;
            case 'hd':$_SESSION['userBo_pin']['h']=1;break;
            case 'vl':$_SESSION['userBo_pin']['v']=0;break;
            case 'vr':$_SESSION['userBo_pin']['v']=1;break;
        }
    }
}