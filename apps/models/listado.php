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
        
        //$res = $this->db->get('UNIDADES');
        //print_r($res->result());
        //exit;
        
        parent::__construct();
        $this->lista = new ArrayObject();
        switch ($tipox){
            case "cargos":
                $this->listarCargos();
            case "rangos":
                $this->listarRangos();
        }
    }

    public function listarIntegrantes(){
        $this->load->model('Integrante');
        $this->db->select('RUT');
        $this->db->order_by('APELLIDO');
        $records = $this->db->get('INTEGRANTES');
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
