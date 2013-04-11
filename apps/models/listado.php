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

    private function listarIntegrantes(){
        $this->load->model('Integrante');
        $this->db->select('RUT');
        $records = $this->db->get('INTEGRANTES');
        foreach ($records->result() as $item => $val){
            $oIntegrante = new $this->Integrante($val->getRut());
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
            $oRango = new $this->cargo($val->RANGOS);
            $this->add($oRango);
        }
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
