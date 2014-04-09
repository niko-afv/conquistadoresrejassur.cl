<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cuenta
 *
 * @author nks
 */
class Cuenta extends CI_Model{
    
    private $nombre;
    private $descripcion;
    private $monto;
    private $periodo;
    private $destino;
    private $inherente;
    
    public function __construct() {
        parent::__construct();
    }
    
    
    public function save(){
        
    }
    
    public function delete(){
        
    }
    
    public function toArray($db = TRUE){
        $array = array();
        
        if($db){
            $array[['NOMBRE']]      = $this->getNombre();
            $array[['DESCRIPCION']] = $this->getDescripcion();
            $array[['MONTO']]       = $this->getMonto();
            $array[['PERIODO']]     = $this->getPeriodo();
            $array[['DESTINO']]     = $this->getDestino();
            $array[['INHERENTE']]   = $this->getInherente();
        }else{
            $array[['nombre']]      = $this->getNombre();
            $array[['descripcion']] = $this->getDescripcion();
            $array[['monto']]       = $this->getMonto();
            $array[['periodo']]     = $this->getPeriodo();
            $array[['destino']]     = $this->getDestino();
            $array[['inherente']]   = $this->getInherente();
        }
    }
    
    public function getNombre() {return $this->nombre;}
    public function getDescripcion() {return $this->descripcion;}
    public function getMonto() {return $this->monto;}
    public function getPeriodo() {return $this->periodo;}
    public function getDestino() {return $this->destino;}
    public function getInherente() {return $this->inherente;}

    public function setNombre($nombre) {$this->nombre = $nombre;}
    public function setDescripcion($descripcion) {$this->descripcion = $descripcion;}
    public function setMonto($monto) {$this->monto = $monto;}
    public function setPeriodo($periodo) {$this->periodo = $periodo;}
    public function setDestino($destino) {$this->destino = $destino;}
    public function setInherente($inherente) {$this->inherente = $inherente;}


}
