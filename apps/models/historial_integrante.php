<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of historial_integrante
 *
 * @author nks
 */
class historial_integrante extends CI_Model{
    
    
    private $atributo;
    private $periodo;
    private $valor;
    private $id;

    public function __construct() {
        parent::__construct();
    }
    
    public function getId() {return $this->id;}
    public function getAtributo() {return $this->atributo;}
    public function getPeriodo() {return $this->periodo;}
    public function getValor() {return $this->valor;}
    
    public function setAtributo($atributo) {$this->atributo = $atributo;}
    public function setPeriodo($periodo) {$this->periodo = $periodo;}
    public function setValor($valor) {$this->valor = $valor;}
    public function setId($id) {
        $this->id = $id;
    }
}
