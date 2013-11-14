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
    
    public function Save(){
        if($this->xnuevo == TRUE){
            $res = $this->db->insert("APODERADOS", $this->toArray());
        }else{
            $this->db->where('RUT', $this->getRut());
            $res = $this->db->update("APODERADOS", $this->toArray());
        }
        return $res;
    }
    
    public function toArray($db = TRUE){
        $array = array();
        if($db){
            $array["RUT"]       = $this->getRut();
            $array["NOMBRE"]    = $this->getNombre();
            $array["APELLIDO"]  = $this->getApellido();
            $array["TELEFONO"]  = $this->getTelefono();
        }else{
            $array["rut"]       = $this->getRut();
            $array["nombre"]    = $this->getNombre();
            $array["apellido"]  = $this->getApellido();
            $array["telefono"]  = $this->getTelefono();
        }
        return $array;
    }
}
?>