<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of apoderado
 *
 * @author nks
 */
class Apoderado extends CI_Model{
    
    private $rut;
    private $nombre;
    private $apellido;
    private $telefono;
    
    private $xnuevo;


    public function __construct() {
        parent::__construct();
        $this->xnuevo = FALSE;
    }
    
    public function setRut($value){
        $this->rut = $value;
        
        $this->db->where('RUT',  $this->getRut());
        $res = $this->db->get('APODERADOS');
        
        if(count($res->result()) > 0){
            $xapoderado = $res->result();
            $this->setNombre($xapoderado[0]->NOMBRE);
            $this->setApellido($xapoderado[0]->APELLIDO);
            $this->setTelefono($xapoderado[0]->TELEFONO);
        }  else {
            $this->xnuevo = TRUE;
        }
    }
    public function setNombre($value){$this->nombre = $value;}
    public function setApellido($value){$this->apellido = $value;}
    public function setTelefono($value){$this->telefono = $value;}
    
    public function getRut(){return $this->rut;}
    public function getNombre(){return $this->nombre;}
    public function getApellido(){return $this->apellido;}
    public function getTelefono(){return $this->telefono;}   
}
?>
