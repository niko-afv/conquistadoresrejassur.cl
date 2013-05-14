<?php

/**
 * Description of integrante_form
 *
 * @author nks
 */
class Integrante_Form extends CI_Controller{
    
    var $title;
    
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->title = 'Integrantes';
        $this->layout = array('base'=>'main','meta','header','sidebar','footer');
        $this->session->loginState('userBo_session');
        /*$this->session->set_userdata(array('userBo_url_referida'=>$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']));
        if(!$this->session->userdata('userBo_id') && $this->uri->segments[2] != 'login'){
            //redirect('index.php/admin/login');
        }*/
    }

    /*public function index(){
        echo "Hola";
    }*/
    
    public function index(){
        $data['base_url']       =   base_url();
        $data['title']          =   $this->title;
        $data['category_title'] =   'Agregar Integrante';
        $data['cargos']         =   $this->loadCargos();
        $data['rangos']         =   $this->loadRangos();
        if($_POST){
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            
            $this->form_validation->set_rules('rut','Rut','required|min_length[9]|max_length[10]');
            $this->form_validation->set_rules('nombre','Nombre','required|min_length[5]|max_length[25]');
            $this->form_validation->set_rules('apellido','Apellido','required|min_length[5]|max_length[25]');
            $this->form_validation->set_rules('edad','Edad','required|exact_length[2]|numeric');
            $this->form_validation->set_rules('fono','Telefono','min_length[7]|max_length[15]');
            $this->form_validation->set_rules('fono2','Telefono Auxiliar','min_length[7]|max_length[15]');
            $this->form_validation->set_rules('direccion','Direccion','min_length[10]|max_length[50]');
            $this->form_validation->set_rules('mail','E-Mail','valid_email');
            $this->form_validation->set_rules('foto','Foto de Perfil','min_length[10]');
            
            if($this->form_validation->run()){
                $this->load->model('integrante');
                $oIntegrante = new $this->integrante();
                $oIntegrante->setRut($this->input->post('rut'));
                $oIntegrante->setNombre($this->input->post('nombre'));
                $oIntegrante->setApellido($this->input->post('apellido'));
                $oIntegrante->setEdad($this->input->post('edad'));
                $oIntegrante->setCargo($this->input->post('cargo'));
                $oIntegrante->setRango($this->input->post('rango'));
                if($this->input->post('fono')){$oIntegrante->setTelefono($this->input->post('fono'));}
                if($this->input->post('fono2')){$oIntegrante->setTelefonoAuxiliar($this->input->post('fono2'));}
                if($this->input->post('direccion')){$oIntegrante->setDireccion($this->input->post('direccion'));}
                if($this->input->post('mail')){$oIntegrante->setMail($this->input->post('mail'));}
                if($oIntegrante->save()){
                    redirect('index.php/admin/integrantes_list/');
                }else{
                    echo "Error de DB";
                }
            }
        }
        $this->load->view('backend/integrante_formulario',$data);
    }
    
    private function loadCargos(){
        $this->load->model("listado");
        $oListado   =   new $this->listado();
        $oListado->listarCargos();
        $array      =   array();
        for ($i = 0; $i < $oListado->count();$i++){
            $array[$i]['id']    =   $oListado->get($i)->getId();
            $array[$i]['nombre']    =   $oListado->get($i)->getNombre();
        }
        return $array;
    }
    private function loadRangos(){
        $this->load->model("listado");
        $oListado   =   new $this->listado();
        $oListado->listarRangos();
        $array      =   array();
        for ($i = 0; $i < $oListado->count();$i++){
            $array[$i]['id']    =   $oListado->get($i)->getId();
            $array[$i]['nombre']    =   $oListado->get($i)->getNombre();
        }
        return $array;
    }
}
?>