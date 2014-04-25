<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CtrlCuentaForm
 *
 * @author nks
 */
class CtrlCuentaForm extends CI_Controller{
    
    private $title;
    
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->layout = array('base'=>'main','meta','header','sidebar','footer');
        $this->session->loginState('userBo_session');
        $this->title = "Cuenta de Integrantes";
    }
    
    
    public function index(){
        $data['base_url']       =   base_url();
        $data['title']          =   $this->title;
        $data['category_title'] =   $this->title;
        $data['page']           =   'tesoreria';
        $data['periodos']       =   $this->getPeriodos();
        
        $this->load->model('cuenta');
        $oCuenta = new $this->cuenta();
        
        if($_POST){
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            
            $this->form_validation->set_rules('nombre','Nombre','required|min_length[10]|max_length[20]');
            $this->form_validation->set_rules('descripcion','Descripcion','required|min_length[8]');
            $this->form_validation->set_rules('monto','Monto','required|min_length[4]|max_length[7]');
            $this->form_validation->set_rules('periodo','Periodo','required|exact_length[1]|numeric');
            $this->form_validation->set_rules('destino','Destino','required|exact_length[1]|numeric');
            $this->form_validation->set_rules('inherente','Inherente','required|exact_length[1]|numeric');
            
            if($this->form_validation->run()){
                $oCuenta->setNombre($this->input->post("nombre"));
                $oCuenta->setDescripcion($this->input->post("descripcion"));                
                $oCuenta->setInherente($this->input->post("inherente"));
                $oCuenta->setPeriodo($this->input->post("periodo"));
                $oCuenta->setDestino($this->input->post("destino"));
                $oCuenta->setMonto($this->input->post("monto"));
                
                if($oCuenta->save()){
                    
                    $this->session->set_flashdata('success','<strong>¡Bien echo!</strong> La cuenta se ha guardado con exito');
                    redirect('/admin/cuentas_list/');
                }else{                    
                    die("Hola");
                    $this->session->set_flashdata('error','<strong>¡Hubo un problema!</strong> Los datos no se han guardado, intentelo mas tarde');                    
                }
            }else{
                die("muere");
            }
        }
        
        $this->load->view('backend/ViewCuentaForm',$data);
    }
    
    public function getPeriodos(){
        $this->load->model('listado');
        $oListado = new $this->listado();
        $oListado->listarPeriodos();
        $periodos = array();
        for($i=0; $i < $oListado->count(); $i++){
            $periodos[] = $oListado->get($i)->toArray();
        }
        return $periodos;
    }
}
