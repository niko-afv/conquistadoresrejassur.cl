<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of periodos
 *
 * @author nks
 */
class Periodo extends CI_Model{
    
    private $id;
    private $descripcion;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function setId($val){
        $this->id = $val;
        $this->db->where('ID',  $this->getId());
        $records = $this->db->get('CUENTAS_PERIODOS');
        $records = $records->result();            
        $this->setDescripcion($records[0]->DESCRIPCION);
    }
    public function setDescripcion($val){$this->descripcion = $val;}
    public function getId(){return $this->id;}
    public function getDescripcion(){return $this->descripcion;}
    
    public function toArray($db = FALSE){
        $array = array();
        if($db){
            $array['ID'] = $this->getId();
            $array['DESCRIPCION'] = $this->getDescripcion();
        }else{
            $array['id'] = $this->getId();
            $array['descripcion'] = $this->getDescripcion();
        }        
        return $array;
    }
}
?>
