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
                $oUsuario = new $this->usuario();
                $oUsuario->setNombre($this->input->post('username',true));
                $oUsuario->setClave($this->input->post('password',true));
                if($oUsuario->login()){
                    $oTemporada = new $this->temporada();
                    $this->session->set_userdata(array(
                        'userBo_id'             => $oUsuario->getId(),
                        'userBo_nombre'         => $oUsuario->getNombre(),
                        'userBo_last_login'     => $oUsuario->getLast_login(),
                        'userBo_session'        => true,
                        'userBo_type'           => 'Administrador',
                        'userBo_pin'            => array('h'=>1,'v'=>1),
                        'userBo_temporada' 	=> $oTemporada->getAño(),
                        'userBo_temporada_id' 	=> $oTemporada->getId()
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