<?php


class Integrante_List extends CI_Controller{
    
    var $title;
    
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->title = 'Integrantes';
        $this->layout = array('base'=>'main','meta','header','sidebar','footer');
        $this->session->loginState('userBo_session');
        $this->load->model(array('listado','integrante'));
    }
    
    public function index(){
        $data['base_url']       =   base_url();
        $data['title']          =   $this->title;
        $data['category_title'] =   'Listado de  Integrantes';
        
        $oListado = new $this->listado();
        $oListado->listarIntegrantes();
        $array  =   array();
        //print_r($oListado);
        for ($i = 0; $i < $oListado->count();$i++){
            $array[$i]['rut']       =   $oListado->get($i)->getRut();
            $array[$i]['nombre']    =   $oListado->get($i)->getNombre();
            $array[$i]['apellido']  =   $oListado->get($i)->getApellido();
            $array[$i]['edad']      =   $oListado->get($i)->getEdad();
            $array[$i]['cargo']     =   $oListado->get($i)->getCargo();
            $array[$i]['grado']     =   $oListado->get($i)->getRango();
        }
        $data['integrantes']    =   $array;
        $this->load->view('backend/integrante_listado',$data);
    }
    
    public function eliminar($var){
        unset($this->layout);
        $this->load->library('utils');
        $oUtils = new $this->utils();
        
        if($oUtils->isAjax()){
            $oIntegrante = new $this->integrante();
            $oIntegrante->setRut($var);
            $res = $oIntegrante->delete();
            $data['type']    =  'json';
            $data['content']    =  $res;
            $this->load->view('ajax',$data);
            
        }else{
            $this->session->set_flashdata('error', 'La petición realizada es invalida');
            redirect('index.php/admin/integrantes_list/');
        }
    }
    
    public function editar(){
        
    }
}
?>