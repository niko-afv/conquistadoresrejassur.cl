<?php


class CtrlTemplateList extends CI_Controller{
    
    var $title;
    
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->title = 'Plantillas';
        $this->layout = array('base'=>'main','meta','header','sidebar','footer');
        $this->session->loginState('userBo_session');
        $this->load->model(array('template', 'listado'));
    }
    
    public function index(){
        $data['base_url']       =   base_url();
        $data['title']          =   $this->title;
        $data['page']           =   'plantillas';
        $data['category_title'] =   'Listado de  Plantillas';
        
        $oListado = new $this->listado();
        $oListado->listarPlantillas();
        $array  =   array();
        
        if($oListado->count() > 0){
            for ($i = 0; $i < $oListado->count();$i++){
                $array[$i]['id']        =   $oListado->get($i)->getId();
                $array[$i]['nombre']    =   $oListado->get($i)->getNombre();
                $array[$i]['entidad']   =   $oListado->get($i)->getEntidad()->getNombre();
                for($x=0; $x < $oListado->get($i)->countCampos(); $x++){
                    $array[$i]['campos'][]  =   $oListado->get($i)->getCampo($x);
                }
            }
            $data['plantillas']    =   $array;
            $this->load->view('backend/ViewTemplateList',$data);
        }else{
            $this->session->set_flashdata('error', '<strong>¡Hubo un problema!</strong> No hay plantillas para listar, favor cree una.');
            redirect('/admin/plantillas_form/');
        }
    }
    
    public function eliminar($var){
        unset($this->layout);
        $this->load->library('utils');
        $oUtils = new $this->utils();
        
        if($oUtils->isAjax()){
            $oTemplate = new $this->template();
            $oTemplate->setId($var);
            $res = $oTemplate->delete();
            $data['type']    =  'json';
            $data['content']    =  $res;
            $this->load->view('ajax',$data);
        }else{
            $this->session->set_flashdata('error', 'La petición realizada es invalida');
            redirect('/admin/integrantes_list/');
        }
    }
    
    /*public function toPdf($convertir = 0){
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
    }*/
}
