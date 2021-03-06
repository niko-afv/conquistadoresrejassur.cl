<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cargo
 *
 * @author nks
 */
class Cargo extends CI_Model{
    
    private $id;
    private $nombre;
    private $estado;
    
    public function __construct($idx = NULL) {
        parent::__construct();
        if(! $idx == NULL){
            $this->setID($idx);
        }
    }
    
    public function setID($value){
        $this->id = $value;
        $this->db->where('ID',$value);
        $res = $this->db->get('CARGOS');
        if(count($res->result() > 0)){
            $res = $res->result();
            $this->setNombre($res[0]->NOMBRE);
        }
    }
    public function setNombre($value){$this->nombre = $value;}
    public function setEstado($value){$this->estado = $value;}
    
    public function getId(){return $this->id;}
    public function getNombre(){return $this->nombre;}
    public function getEstado(){return $this->estado;}
}

?>
