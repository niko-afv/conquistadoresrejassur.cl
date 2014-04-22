<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CtrlLogin extends CI_Controller{

    var $data;

    public function __construct(){
        parent::__construct();
        $this->load->model('usuario');
        $this->load->model('temporada');
        $this->load->helper(array('form','url'));
    }

    public function index(){
        $data['msg'] = $this->data;
        $this->load->view('backend/VistaLogin',$data);
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
                    $oTemporada = new $this->temporada();
                    $this->session->set_userdata(array(
                        'userBo_id'	 	 => '12345',//$rs[0]->use_id,
                        'userBo_nombre'	 => 'nicolas',//$rs[0]->use_first_name.' '.$rs[0]->use_last_name,
                        'userBo_session' => true,
                        'userBo_type' 	 => 'admin',
                        'userBo_pin' 	 => array('h'=>1,'v'=>1),
                        'temporada' 	 => $oTemporada->getAño(),
                        'temporada_id' 	 => $oTemporada->getId()
                    ));
                    $this->mostrarVistaPrincipal();
                }else{
                    $this->session->set_flashdata('msg','El usuario o pasword son incorrectos 1');
                    redirect('admin/login');
                }
            }else{
                $this->session->set_flashdata('msg','El usuario o pasword son incorrectos 2');
                redirect('admin/login');
            }
        }else{
            $this->session->set_flashdata('msg','Debe ingresar Usuario y Clave');
            redirect('admin/login');
        }
    }
    
    public function mostrarVistaPrincipal(){
        redirect('admin');
    }
    
}