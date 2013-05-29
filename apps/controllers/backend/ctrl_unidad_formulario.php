<?php
/**
 * Created by JetBrains PhpStorm.
 * User: nks
 * Date: 23-05-13
 * Time: 10:50 PM
 * To change this template use File | Settings | File Templates.
 */

class Ctrl_unidad_formulario extends CI_Controller{


    public function __construct(){
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->title = 'Unidades';
        $this->layout = array('base'=>'main','meta','header','sidebar','footer');
        $this->session->loginState('userBo_session');
    }

    public function index(){

        $data['base_url']       =   base_url();
        $data['title']          =   $this->title;
        $data['category_title'] =   'Agregar Unidad';

        $this->load->model('unidad');
        $oUnidad = new $this->unidad();

        if($_POST){
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

            $this->form_validation->set_rules('nombre','Nombre','required|min_length[5]|max_length[25]');
            $this->form_validation->set_rules('grito','Grito','min_length[15]|max_length[255]');
            $this->form_validation->set_rules('fundado','Fundado','required|exact_length[4]|numeric|callback_fundado_check');
            $this->form_validation->set_rules('imgUpload1','Foto de Unidad','min_length[10]');
            
            if($this->form_validation->run()){
                if($this->input->post('id') != ''){
                    $oUnidad->setId($this->input->post('id'));
                }

                $oUnidad->setNombre($this->input->post('nombre'));
                $oUnidad->setFundado($this->input->post('fundado'));

                if($oUnidad->save()){
                    $this->load->model('trayectoria_unidad');
                    $oTrayectoria = new $this->trayectoria_unidad();
                    if($this->input->post('id_trayectoria') != ''){
                        $oTrayectoria->setId($this->input->post('id_trayectoria'));
                    }
                    $oTrayectoria->setTemporada(date('Y'));
                    if($this->input->post('imgUpload1')){
                        $oTrayectoria->setFoto($this->input->post('imgUpload1'));
                    }else{
                        $oTrayectoria->setFoto('');
                    }
                    $oTrayectoria->setGrito($this->input->post('grito'));

                    if($oTrayectoria->save($oUnidad->getId())){
                        $this->session->set_flashdata('success','La unidad se ha guardado con exito!');
                        //redirect('admin/unidades_form');
                    }else{
                        $this->session->set_flashdata('error','Los datos no se han guardado, intentelo mas tarde');
                        redirect('admin/unidades_list');
                    }
                }
            }

        }
        $data['unidad'] = $oUnidad->toArray();
        $this->load->view('backend/ViewUnidadFormulario',$data);
    }

    public function fundado_check($val){
        if ($val > date('Y')){
            $this->form_validation->set_message('fundado_check', 'El campo %s no puede ser mayor al año actual ('. date('Y') .')');
            return FALSE;
        }else{
            return TRUE;
        }
    }


    public function modificar($id){
        $this->load->model('unidad');
        $oUnidad = new $this->unidad();
        $oUnidad->setId($id);

        //print_r($oUnidad);

        $data['base_url']       =   base_url();
        $data['title']          =   $this->title;
        $data['category_title'] =   'Modificar Unidad';

        $data['unidad'] = $oUnidad->toArray(FALSE);

        $this->load->view('backend/ViewUnidadFormulario',$data);
    }

}