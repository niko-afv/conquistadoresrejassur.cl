<?php


class CtrlIntegranteList extends CI_Controller{
    
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
        $data['page']           =   'integrantes';
        $data['category_title'] =   'Listado de  Integrantes';
        
        $oListado = new $this->listado();
        $oListado->listarIntegrantes();
        $array  =   array();
        
        if($oListado->count() > 0){
            for ($i = 0; $i < $oListado->count();$i++){
                $array[$i]['rut']       =   $oListado->get($i)->getRut();
                $array[$i]['nombre']    =   $oListado->get($i)->getNombre();
                $array[$i]['apellido']  =   $oListado->get($i)->getApellido();
                $array[$i]['unidad']    =   $oListado->get($i)->getUnidad();
                $array[$i]['edad']      =   $oListado->get($i)->getEdad();
                $array[$i]['grado']     =   $oListado->get($i)->getRango()->getNombre();
                $array[$i]['cargos']    =   array();
                for($x =0; $x < $oListado->get($i)->countCargos();$x++){
                    $array[$i]['cargos'][]  =   $oListado->get($i)->getCargo($x)->getNombre();
                }
            }
            /*print_r($array[0]['cargos']);
            die();*/
            $data['integrantes']    =   $array;
            $this->load->view('backend/ViewIntegranteList',$data);
        }else{
            $this->session->set_flashdata('error', '<strong>¡Hubo un problema!</strong> No hay integrantes para listar, favor cree uno.');
            redirect('/admin/integrantes_form/');
        }
    }
    
    public function eliminar($var){
        unset($this->layout);
        $this->load->library('utils');
        $oUtils = new $this->utils();
        
        if($oUtils->isAjax()){
            $oIntegrante = new $this->integrante();
            $oIntegrante->setRut($var);
            $imagen = $oIntegrante->getFoto();
            $res = $oIntegrante->delete();
            if($res && $imagen != ""){
                $oUtils->deleteImage($imagen);
            }
            $data['type']    =  'json';
            $data['content']    =  $res;
            
            $this->load->view('ajax',$data);
        }else{
            $this->session->set_flashdata('error', 'La petición realizada es invalida');
            redirect('/admin/integrantes_list/');
        }
    }
    
    public function toPdf($convertir = 0){
        unset($this->layout);
        
        $data['base_url']       =   base_url();
        $data['title']          =   $this->title;
        $data['page']           =   'integrantes';
        $data['category_title'] =   'Listado de  Integrantes';
        
        
        $oListado = new $this->listado();
        $oListado->listarIntegrantes();
        $array  =   array();
        for ($i = 0; $i < $oListado->count();$i++){
            $array[$i]['rut']       =   $oListado->get($i)->getRut();
            $array[$i]['nombre']    =   $oListado->get($i)->getNombre();
            $array[$i]['apellido']  =   $oListado->get($i)->getApellido();
            $array[$i]['unidad']    =   $oListado->get($i)->getUnidad();
            $array[$i]['edad']      =   $oListado->get($i)->getEdad();
            $array[$i]['cargo']     =   $oListado->get($i)->getCargo()->getNombre();
            $array[$i]['grado']     =   $oListado->get($i)->getRango()->getNombre();
        }
        $data['num_rows'] =   $oListado->count();
        $data['integrantes']    =   $array;
        
        $this->load->helper(array('dompdf', 'file'));
        
        $html = $this->load->view('backend/ViewIntegrantesListPrint',$data, TRUE);
        pdf_create($html, 'ListaIntegrantes');
    }
}
?>