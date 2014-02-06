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
class CtrlTemplateForm extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->title = 'Plantillas';
        $this->layout = array('base'=>'main','meta','header','sidebar','footer');
        $this->session->loginState('userBo_session');
        $this->page = 'plantillas';
    }
    public function index(){
        $data['base_url']       =   base_url();
        $data['title']          =   $this->title;
        $data['page']           =   $this->page;
        $data['category_title'] =   'Creación de Plantillas';
        $data['entidades']      =   $this->loadEntidades();
        $this->load->model('template');
        $oTemplates = new $this->template();
        $data['template']      =   $oTemplates->toArray();
        if($_POST){
            
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            
            $this->form_validation->set_rules('nombre','Nombre','required|min_length[5]|max_length[30]');
            $this->form_validation->set_rules('entidad','Entidad','required|min_length[1]|max_length[2]');
            $this->form_validation->set_rules('campos','Campos','callback_contar_campos');
            
            if($this->input->post('dCampos')){
                //$this->form_validation->set_rules('dCampos','Campos Dinamicos','callback_validar_campos');
            }
            
            if($this->form_validation->run()){
                $oTemplates->setNombre($this->input->post('nombre'));
                $oTemplates->setEntidad($this->input->post('entidad'));
                
                $xcampos = $this->input->post('campos');
                for($i = 0; $i< count($xcampos); $i++){
                    if(strlen(trim($xcampos[$i])) > 0){
                        $oTemplates->addCampo($xcampos[$i]);
                    }
                }
                if($this->input->post('dCampos')){
                    $xcampos = $this->input->post('dCampos');
                    for($i = 0; $i< count($xcampos); $i++){
                        if(strlen(trim($xcampos[$i])) > 0){
                            $oTemplates->addCampo($xcampos[$i]);
                        }
                    }
                }
                
                
                if($oTemplates->save()){
                    $this->session->set_flashdata('success','<strong>¡Bien echo!</strong> Los datos se han guardado con exito');
                    redirect('/admin/plantillas_list');
                }else{
                    $this->session->set_flashdata('error','<strong>¡Hubo un problema!</strong> Los datos no se han guardado, intentelo mas tarde');
                    redirect('/admin/plantillas_list');
                }
            }
            
        }
        $this->load->view("backend/ViewTemplateForm",$data);
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
    
    
    public function contar_campos($campos){
        if(count($campos) == 0 ){
            $this->form_validation->set_message('validar_campos', 'Debe seleccionar al menos un campo');
            return FALSE;
        }else{
            return TRUE;
        }
    }
}
