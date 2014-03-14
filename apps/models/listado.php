<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Listado
 *
 * @author nks
 */
class Listado extends CI_Model{
    
    private $lista;
    
    
    public function __construct($tipox = NULL) {        
        parent::__construct();
        $this->lista = new ArrayObject();
        switch ($tipox){
            case "cargos":
                $this->listarCargos();
            case "rangos":
                $this->listarRangos();
        }
    }

    public function listarIntegrantes($columnas = FALSE){
        $this->db->select('RUT');
        if($columnas){
            $this->db->select($columnas);
        }
        $this->db->order_by('APELLIDO');
        $records = $this->db->get('INTEGRANTES');

        $this->load->model('Integrante');
        foreach ($records->result() as $item => $val){            
            $oIntegrante = new $this->Integrante($val->RUT);
            $this->add($oIntegrante);
        }
    }
    
    public function listarCargos(){
        $this->load->model('cargo');
        $this->db->select('ID, NOMBRE');
        $records = $this->db->get('CARGOS');
        foreach ($records->result() as $item => $val){
            $oCargo = new $this->cargo($val->ID);
            $this->add($oCargo);
        }
    }
    
    public function listarRangos(){
        $this->load->model('rango');
        $this->db->select('RANGOS, NOMBRE');
        $records = $this->db->get('RANGOS');
        foreach ($records->result() as $item => $val){
            $oRango = new $this->rango($val->RANGOS);
            $this->add($oRango);
        }
    }
    
    public function listarUnidades(){
        $this->load->model('unidad');
        $this->db->select('ID, NOMBRE');
        $records = $this->db->get('UNIDADES');
        foreach ($records->result() as $item => $val){
            $oUnidad = new $this->unidad();
            $oUnidad->setId($val->ID);
            $this->add($oUnidad);
        }
    }
    
    public function listarCuentas($tipo){
        $this->load->model('categoria_flujo_caja');
        $this->db->select('ID, NOMBRE, TIPO');
        $this->db->where('CATEGORIA_PADRE',0);
        $this->db->where('TIPO',$tipo);
        $records = $this->db->get('FLUJO_CAJA_CATEGORIAS');
        foreach ($records->result() as $item => $val){
            $oCFlujoCaja = new $this->categoria_flujo_caja();
            $oCFlujoCaja->setId($val->ID);
            $this->add($oCFlujoCaja);
        }
    }
    
    public function listarEntidades(){
        $this->load->model('entidad');
        $this->db->select('ID, NOMBRE');
        $records = $this->db->get('ENTIDADES');
        foreach ($records->result() as $item => $val){
            $oEntidad = new $this->entidad();
            $oEntidad->setId($val->ID);
            $this->add($oEntidad);
        }
    }
    
    public function listarPlantillas(){
        $this->load->model('template');
        $this->db->select('ID, NOMBRE');
        $records = $this->db->get('LISTADOS_TEMPLATES');
        foreach ($records->result() as $item => $val){
            $oTemplate = new $this->template();
            $oTemplate->setId($val->ID);
            $this->add($oTemplate);
        }
    }

    public function customList($tabla = "", $xcolumnas = array()){
        foreach($xcolumnas as $columna => $val){
            if($val['tipo'] == 1){
                $columnas[] =  strtoupper($val['nombre']);
            }
        }
        switch($tabla){
            case 'INTEGRANTES':
                $this->listarIntegrantes($columnas);
                break;
            case 'CARGOS':
                $this->listarCargos();
                break;
            case 'RANGOS':
                $this->listarRangos();
                break;
            case 'UNIDADES':
                $this->listarUnidades();
                break;
            /*case 'CUENTAS':
                $this->listarCuentas();
                break;*/
            case 'ENTIDADES':
                $this->listarEntidades();
                break;
            case 'PLANTILLAS':
                $this->listarPlantillas();
                break;
        }
    }

    public function limpiar(){
        unset($this->lista);
        $this->lista = new ArrayObject();
    }

    public function add($objeto){
        $this->lista->append($objeto);
    }
    public function count(){
        return $this->lista->count();
    }
    public function get($index){
        return $this->lista->offsetGet($index);
    }
    public function delete($index){
        $this->lista->offsetUnset($index);
    }
}

?>
