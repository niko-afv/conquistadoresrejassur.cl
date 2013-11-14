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
class Rango extends CI_Model{
    
    private $id;
    private $nombre;
    
    public function __construct($idx = NULL) {
        parent::__construct();
        if(! $idx == NULL){
            $this->setID($idx);
        }
    }
    
    public function setID($value){
        $this->id = $value;
        $this->db->where('RANGOS',$value);
        $res = $this->db->get('RANGOS');
        if(count($res->result() > 0)){
            $res = $res->result();
            $this->setNombre($res[0]->NOMBRE);
        }
    }
    public function setNombre($value){$this->nombre = $value;}
    
    public function getId(){return $this->id;}
    public function getNombre(){return $this->nombre;}
}

?>
