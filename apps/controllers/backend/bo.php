<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bo extends CI_Controller {
	
    var $data;

    public function __construct(){
        parent::__construct();
        $this->load->model('md_bo');
        $this->load->model('usuario');
        $this->load->helper(array('form','url'));
        $this->load->library(array('log'));
        $this->data = $this->session->flashdata('msg');

        if(!$this->session->userdata('userBo_id') && $this->uri->segments[2] != 'login'){
            redirect('index.php/admin/login');
        }
    }

    public function index(){
        $this->layout = array('base'=>'main','meta','header','sidebar','footer');
        $data['msg'] = $this->data;
        $data['category_title'] = "Bienvenido al sistema de administración de conquistadores Rejas Sur";
        $data['title'] = "BackOffice - Bienvenida";
        $this->load->view('backend/home',$data);
    }

    public function login(){
        if($this->input->post()){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|min_length[3]|max_length[25]');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|min_length[3]|max_length[25]');
            if($this->form_validation->run() == true){
                $this->usuario->setNombre($this->input->post('username',true));
                $this->usuario->setClave($this->input->post('password',true));
                if($this->usuario->login()){
                    $this->session->set_userdata(array(
                        'userBo_id'	 	 => '12345',//$rs[0]->use_id,
                        'userBo_nombre'	 => 'nicolas',//$rs[0]->use_first_name.' '.$rs[0]->use_last_name,
                        'userBo_session' => true,
                        'userBo_type' 	 => 'admin',
                        'userBo_pin' 	 => array('h'=>1,'v'=>1)
                    ));
                    $redirect = ($this->session->userdata('userBo_url_referida')!="")?$this->session->userdata('url_referida'):'index.php/admin';
                    redirect($redirect);
                }else{
                    $this->session->set_flashdata('msg','El usuario o pasword son incorrectos');
                    redirect('index.php/admin/login');
                }
            }else{
                $this->session->set_flashdata('msg','El usuario o pasword son incorrectos');
                redirect('index.php/admin/login');
            }
        }else{
            $data['msg'] = $this->data;
            $this->load->view('backend/login',$data);
        }
    }

    public function logout(){
        //if($this->log->user('logout')){
        foreach($_SESSION as $k => $d)preg_match('/^userBo/',$k)?$this->session->unset_userdata($k):false;
        $this->session->set_flashdata('msg','Sesión cerrada correctamente');
        redirect('index.php/admin/login');
        //}
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