<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CtrlFlujoCajaForm
 *
 * @author nks
 */
class CtrlFlujoCajaForm extends CI_Controller{
    
    private $title;
    
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->layout = array('base'=>'main','meta','header','sidebar','footer');
        $this->session->loginState('userBo_session');
        $this->title = "Flujo de Caja";
    }
    
    public function index(){
        $data['base_url']       =   base_url();
        $data['title']          =   $this->title;
        $data['category_title'] =   'Flujo de Caja';
        $data['page']           =   'tesoreria';
        
        
        if($_POST){
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            
            $this->form_validation->set_rules('descripcion','Descripción','required|min_length[5]|max_length[|100]');
            $this->form_validation->set_rules('fecha','Fecha','required|exact_length[10]');
            $this->form_validation->set_rules('monto','Monto','required|min_length[1]|max_length[10]|numeric');
            $this->form_validation->set_rules('cuenta','Cuenta','required|numeric');
            
            if($this->form_validation->run()){
                $this->load->model('flujo_caja');
                $oFlujoCaja = new $this->flujo_caja();
                $oFlujoCaja->setDescripcion($this->input->post('descripcion'));
                $oFlujoCaja->setFecha($this->input->post('fecha'));
                $oFlujoCaja->setMonto($this->input->post('monto'));
                $oFlujoCaja->setSubCategoria($this->input->post('cuenta'));
                if($oFlujoCaja->save()){
                    $this->session->set_flashdata('success','<strong>¡Bien echo!</strong> El movimiento se ha guardado con exito');
                    redirect('admin/flujo_caja');
                }else{
                    $this->session->set_flashdata('error','<strong>¡Hubo un problema!</strong> Los datos no se han guardado, intentelo mas tarde');
                    redirect('admin/flujo_caja');
                }
            }
        }

        $this->load->view('backend/ViewFlujoCajaForm',$data);
    }
    
    public function getCuentas(){
        unset($this->layout);
        $this->load->model('listado');
        $oListado = new $this->listado();
        
        $value = $this->input->get('selected');
        
        $oListado->listarCuentas($value);
        $array  =   array();
        for($i = 0; $i < $oListado->count(); $i++){
            $array[$i] = $oListado->get($i)->toArray();
        }
        $data['cuentas'] = $array;
        $oListado->limpiar();
        unset($array);
        
        $data = array(
            'content'   => $data,
            'type'      => 'json'
            );
        $this->load->view('ajax',$data);
    }
}
?>