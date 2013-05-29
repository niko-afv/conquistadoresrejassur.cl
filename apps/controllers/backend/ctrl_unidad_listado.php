<?php
/**
 * Created by JetBrains PhpStorm.
 * User: nicolas
 * Date: 24-05-13
 * Time: 10:55 AM
 * To change this template use File | Settings | File Templates.
 */

class Ctrl_unidad_listado extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->title = 'Unidades';
        $this->layout = array('base'=>'main','meta','header','sidebar','footer');
        $this->session->loginState('userBo_session');
        $this->load->model(array('listado','unidad'));
    }

    public function index(){
        $data['base_url']       =   base_url();
        $data['title']          =   $this->title;
        $data['category_title'] =   'Listado de  Unidades';

        $oListado = new $this->listado();
        $oListado->listarUnidades();
        $array  =   array();
        //print_r($oListado);
        for ($i = 0; $i < $oListado->count();$i++){
            $array[$i]['id']    =   $oListado->get($i)->getId();
            $array[$i]['nombre']    =   $oListado->get($i)->getNombre();
            $array[$i]['fundado']      =   $oListado->get($i)->getFundado();
            $array[$i]['estado']      =   $oListado->get($i)->getEstado();
        }
        $data['unidades']    =   $array;
        $this->load->view('backend/ViewUnidadListado',$data);
    }

    public function eliminar($var){
        unset($this->layout);
        $this->load->library('utils');
        $oUtils = new $this->utils();

        if($oUtils->isAjax()){
            $oUnidad = new $this->unidad();
            $oUnidad->setId($var);
            $res = $oUnidad->delete();
            $data['type']    =  'json';
            $data['content']    =  $res;
            $this->load->view('ajax',$data);

        }else{
            $this->session->set_flashdata('error', 'La petición realizada es invalida');
            redirect('index.php/admin/unidades_list/');
        }
    }
}