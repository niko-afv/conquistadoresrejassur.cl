<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of entidad
 *
 * @author nfredes
 */
class Entidad extends CI_Model{
    
    private $id;
    private $nombre;
    private $tabla;
    
    private $xnuevo;
            
    function __construct() {
        parent::__construct();
    }
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        
        $this->db->where('ID',  $this->getId());
        $res = $this->db->get('ENTIDADES');
        
        if(count($res->result()) == 0){
            $this->xnuevo = TRUE;            
        }else{
            $this->xnuevo = FALSE;
            $xentidad = $res->result();            
            $this->setNombre($xentidad[0]->NOMBRE);
            $this->setTabla($xentidad[0]->TABLA);
        }
        return $this;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getTabla() {
        return $this->tabla;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setTabla($tabla) {
        $this->tabla = $tabla;
    }


}
