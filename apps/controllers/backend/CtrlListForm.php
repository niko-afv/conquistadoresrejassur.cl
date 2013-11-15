<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CtrlListForm
 *
 * @author nfredes
 */
class CtrlListForm extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->title = 'LIstados';
        $this->layout = array('base'=>'main','meta','header','sidebar','footer');
        $this->session->loginState('userBo_session');
        $this->page = 'Listados';
    }
    public function index(){
        $data['base_url']       =   base_url();
        $data['title']          =   $this->title;
        $data['page']           =   $this->page;
        $data['category_title'] =   'Agregar Integrante';
        $data['entidades']      =   $this->loadEntidades();
        
        $this->load->model('listados_templates');
        $oListadosTemplates = new $this->listados_templates();
        
        $data['listado']      =   $oListadosTemplates->toArray();
        $this->load->view("backend/ViewListForm",$data);
    }
    
    public function carga_detalles_entidad(){
        unset($this->layout);
        $this->load->library('utils');
        $oUtils = new $this->utils();

        if($oUtils->isAjax()){
            if($this->input->post()){
                
                $this->load->model('listados_campos');
                $oListadosCapos = new $this->listados_campos();
                $id_entidad = $this->input->post('entidad');
                $data['content'] = $oListadosCapos->listarCamposTabla($id_entidad);
                $data['type'] = 'json';
                $this->load->view('ajax',$data);
            }
        }else{
            $this->session->set_flashdata('error', 'La petición realizada es invalida');
            redirect('/admin/listados_form/');
        }
    }


    private function loadEntidades(){
        $this->load->model("listado");
        $oListado   =   new $this->listado();
        $oListado->listarEntidades();
        $array      =   array();
        for ($i = 0; $i < $oListado->count();$i++){
            $array[$i]['id']    =   $oListado->get($i)->getId();
            $array[$i]['nombre']    =   $oListado->get($i)->getNombre();
        }
        return $array;
    }
}
