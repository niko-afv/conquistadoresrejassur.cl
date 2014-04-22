<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of temporada
 *
 * @author nfredes
 */
class temporada extends CI_Model{
    
    private $id;
    private $año;
    private $inicio;
    private $fin;
    private $estado;
    
    public function __construct ($active = TRUE) {
        parent::__construct();
        $this->setId($this->getActiveTemporada());
    }
    public function setId ($id) {
        $this->id = $id;
        
        $this->db->where("ID", $id);
        $res = $this->db->get("TEMPORADAS");
        if(count($res->result()) > 0){
            $xtemporada = $res->result();
            $this->setAño($xtemporada[0]->ANIO);
            $this->setInicio($xtemporada[0]->INICIO);
            $this->setFin($xtemporada[0]->FIN);
            $this->setEstado($xtemporada[0]->ESTADO);
        }
    }
    public function setAño ($año) {$this->año = $año;}
    public function setInicio ($inicio) {$this->inicio = $inicio;}
    public function setFin ($fin) {$this->fin = $fin;}
    public function setEstado ($estado) {$this->estado = $estado;}
    
    public function getId () {return $this->id;}
    public function getAño () {return $this->año;}
    public function getInicio () {return $this->inicio;}
    public function getFin () {return $this->fin;}
    public function getEstado () {return $this->estado;}
    
    public function getActiveTemporada(){
        $this->db->where("ESTADO",1);
        $this->db->select("ID");
        $res = $this->db->get("TEMPORADAS");
        
        if(count($res->result()) > 0){
            $xtemporada = $res->result();
            return $xtemporada[0]->ID;
        }
    }
}
