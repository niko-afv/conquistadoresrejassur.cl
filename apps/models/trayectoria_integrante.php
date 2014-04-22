<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of trayectoria_integrante
 *
 * @author nfredes
 */
class trayectoria_integrante extends CI_Model{

    private $id;
    private $temporada;
    
    public function __construct () {
        parent::__construct();
    }

    public function save($integrante){
        $array['ID_TEMPORADA']          =   $this->getTemporada();
        $array['RUT_INTEGRANTE']        =   $integrante;
        $res = $this->db->insert('INTEGRANTES_TRAYECTORIA',$array);
        return $res;
    }
    
    public function setId ($id) {
        $this->id = $id;
        $this->db->where("ID",$id);
        $res = $this->db->get("INTEGRANTES_TRAYECTORIA");
        
        if(count($res->result()) > 0){            
            $xtrayectoria = $res->result();
            $this->setTemporada($xtrayectoria[0]->TEMPORADA);
        }
    }    
    public function setTemporada ($temporada) {$this->temporada = $temporada;}

    public function getId () {return $this->id;}
    public function getTemporada () {return $this->temporada;}
}
