<?php
/**
 * Created by JetBrains PhpStorm.
 * User: nks
 * Date: 12-06-13
 * Time: 12:21 AM
 * To change this template use File | Settings | File Templates.
 */

class CtrlUnidadIntegrantes extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->title = 'Agregar Integrantes a Unidades';
        $this->layout = array('base'=>'main','meta','header','sidebar','footer');
        $this->session->loginState('userBo_session');
        $this->load->model(array('listado','unidad'));
    }

    public function index(){
        $data['base_url']       =   base_url();
        $data['title']          =   $this->title;
        $data['category_title'] =   'Listado de  Unidades';
        $data['page']           =   'unidades';

        $this->load->model('listado');
        $oListado = new $this->listado();
        $oListado->listarIntegrantes();

        $array  =   array();
        for ($i = 0; $i < $oListado->count();$i++){
                $array[$i]['rut']       =   $oListado->get($i)->getRut();
                $array[$i]['nombre']    =   $oListado->get($i)->getNombre(TRUE);
                $array[$i]['apellido']  =   $oListado->get($i)->getApellido(TRUE);
                $array[$i]['edad']      =   $oListado->get($i)->getEdad();
                $array[$i]['fono']      =   $oListado->get($i)->getTelefono();
                $array[$i]['email']     =   $oListado->get($i)->getMail();
                $array[$i]['foto']      =   $oListado->get($i)->getFoto();
                $array[$i]['unidad']    =   $oListado->get($i)->getUnidad();
                $array[$i]['cargo']     =   $oListado->get($i)->getCargo()->getNombre();
                $array[$i]['grado']     =   $oListado->get($i)->getRango()->getNombre();
        }
        $data['integrantes']    =   $array;
        unset($array);

        $oListado->limpiar();
        $oListado->listarUnidades();

        $array  =   array();
        for ($i = 0; $i < $oListado->count();$i++){
            $array[$i]['id']        =   $oListado->get($i)->getId();
            $array[$i]['nombre']    =   $oListado->get($i)->getNombre();
            $array[$i]['fundado']   =   $oListado->get($i)->getFundado();
            $array[$i]['estado']    =   $oListado->get($i)->getEstado();
        }
        $data['unidades']    =   $array;


        $this->load->view('backend/ViewUnidadIntegrantes',$data);
    }

    public function agregarIntegrante(){
        unset($this->layout);
        $this->load->library('utils');
        $oUtils = new $this->utils();

        if($oUtils->isAjax()){
            $rut = $this->input->post('integrante_rut');
            $unidad_id = $this->input->post('unidad_id');
            $anterior_id = $this->input->post('anterior_id');

            $this->load->model('unidad','integrante');

            $ointegrante = new $this->integrante();
            $ointegrante->setRut($rut);
            if($anterior_id != 0){
                $oUnidad = new $this->unidad();
                $oUnidad->setId($anterior_id);
                $res = $oUnidad->getTrayectoria($oUnidad->countTrayectorias())->deleteIntegrante($rut);
            }else                         
            if($unidad_id != 0){
                $oUnidad = new $this->unidad();
                $oUnidad->setId($unidad_id);
                $oUnidad->getTrayectoria($oUnidad->countTrayectorias())->addIntegrante($ointegrante);
                $res = $oUnidad->getTrayectoria($oUnidad->countTrayectorias())->save($unidad_id);
            }

            $data['type']    =  'json';
            $data['content']    =  $res;
            $this->load->view('ajax',$data);
        }else{
            $this->session->set_flashdata('error', 'La petición realizada es invalida');
            redirect('index.php/admin/unidades_list/');
        }

    }

}