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
class Periodos extends CI_Model{
    
    private $nombre;
    private $monto;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function setNombre($val){$this->nombre = $val;}
    public function setMonto($val){$this->monto = $val;}
    public function getNombre(){return $this->nombre;}
    public function getMonto(){return $this->monto;}
}

?>
