<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of listadosTemplates
 *
 * @author nfredes
 */
class Listados_Templates extends CI_Model{
    
    private $id;
    private $nombre;
    private $entidad;
    
    public function __construct() {
        parent::__construct();
    }
    public function getNombre() {
        return $this->nombre;
    }

    public function getEntidad() {
        return $this->entidad;
    }
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

        public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setEntidad($entidad) {
        $this->entidad = $entidad;
    }

    public function toArray(){
        $array = array();
        $array['id'] = $this->getId();
        $array['nombre'] = $this->getNombre();
        $array['entidad'] = $this->getEntidad();
        return $array;
    }
    
}
