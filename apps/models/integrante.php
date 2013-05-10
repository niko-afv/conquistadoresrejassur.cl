<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of integrante
 *
 * @author nks
 */
class Integrante extends CI_Model{
    
    
    private $rut;
    private $nombre;
    private $apellido;
    private $edad;
    private $telefono;
    private $telefono_auxiliar;
    private $direccion;
    private $mail;
    private $foto;
    private $rango;
    private $cargo;
    private $estado = 1;
    private $apoderado;


    private $xnuevo;
    
    public function __construct($xrut = FALSE) {
        parent::__construct();
        $this->xnuevo = FALSE;
        $this->load->model('apoderado','apoderado_m');
        $this->apoderado = new $this->apoderado_m();
        $this->apoderado->setRut('88811111-1');
        if($xrut){
            $this->setRut($xrut);
        }
    }


    public function setRut($value){
        
        $this->rut = $value;
        
        $this->db->where('RUT',  $this->getRut());
        $res = $this->db->get("INTEGRANTES");
        if(count($res->result()) > 0){
            $xintegrante = $res->result();
            $this->setNombre($xintegrante[0]->NOMBRE);
            $this->setApellido($xintegrante[0]->APELLIDO);
            $this->setEdad($xintegrante[0]->EDAD);
            $this->setTelefono($xintegrante[0]->TELEFONO_PRINCIPAL);
            $this->setTelefonoAuxiliar($xintegrante[0]->TELEFONO_AUXILIAR);
            $this->setDireccion($xintegrante[0]->DIRECCION);
            $this->setMail($xintegrante[0]->EMAIL);
            $this->setFoto($xintegrante[0]->FOTO);
            $this->setRango($xintegrante[0]->RANGO);
            $this->setCargo($xintegrante[0]->CARGO);
            $this->setEstado($xintegrante[0]->ESTADO);
            
            $this->apoderado->setRut($xintegrante[0]->RUT_APODERADO);
        }else{
            $this->xnuevo = TRUE;
        }        
    }
    public function setRango($value){
        $this->rango = $value;
        /*$this->db->where('RANGOS',$value);
        $res = $this->db->get('RANGOS');
        if(count($res->result())>0){
            $xrango = $res->result();
            $this->rango = $xrango[0]->NOMBRE;
        }*/
    }
    public function setCargo($value){
        $this->cargo = $value;
        /*$this->db->where('ID',$value);
        $res = $this->db->get('CARGOS');
        if(count($res->result())>0){
            $xcargo = $res->result();
            $this->cargo = $xcargo[0]->NOMBRE;
        }*/
    }
    public function setNombre($value){$this->nombre = $value;}
    public function setApellido($value){$this->apellido = $value;}
    public function setEdad($value){$this->edad = $value;}
    public function setTelefono($value){$this->telefono = $value;}
    public function setTelefonoAuxiliar($value){$this->telefono_auxiliar = $value;}
    public function setDireccion($value){$this->direccion = $value;}
    public function setMail($value){$this->mail = $value;}
    public function setFoto($value){$this->foto = $value;}    
    public function setEstado($value){$this->estado = $value;}
    
    
    public function getRut(){return $this->rut;}
    public function getNombre(){return $this->nombre;}
    public function getApellido(){return $this->apellido;}
    public function getEdad(){return $this->edad;}
    public function getTelefono(){return $this->telefono;}
    public function getTelefonoAuxiliar(){return $this->telefono_auxiliar;}
    public function getDireccion(){return $this->direccion;}
    public function getMail(){return $this->mail;}
    public function getFoto(){return $this->foto;}
    public function getRango(){return $this->rango;}
    public function getCargo(){return $this->cargo;}
    public function getEstado(){return $this->estado;}
    
    public function save(){
        if ($this->xnuevo){
            $res = $this->db->insert("INTEGRANTES",  $this->toArray());
        }  else {
            $this->db->where('RUT',  $this->getRut());
            $res = $this->db->update("INTEGRANTES",  $this->toArray());
        }
        return $res;
    }
    
    public function delete(){
        
    }
    
    
    public function toArray($db = TRUE){
        $array = array();
        if($db){
            $array['RUT'] = $this->getRut();
            $array['NOMBRE'] = $this->getNombre();
            $array['APELLIDO'] = $this->getApellido();
            $array['EDAD'] = $this->getEdad();
            $array['TELEFONO_PRINCIPAL'] = $this->getTelefono();
            $array['TELEFONO_AUXILIAR'] = $this->getTelefonoAuxiliar();
            $array['DIRECCION'] = $this->getDireccion();
            $array['EMAIL'] = $this->getMail();
            $array['FOTO'] = $this->getFoto();
            $array['RANGO'] = $this->getRango();
            $array['CARGO'] = $this->getCargo();
            $array['ESTADO'] = $this->getEstado();
            $array['RUT_APODERADO'] = $this->apoderado->getRut();
            
        }else{
            $array['rut'] = $this->getRut();
            $array['nombre'] = $this->getNombre();
            $array['apellido'] = $this->getApellido();
            $array['edad'] = $this->getEdad();
            $array['telefono_principal'] = $this->getTelefono();
            $array['telefono_auxiliar'] = $this->getTelefonoAuxiliar();
            $array['direccion'] = $this->getDireccion();
            $array['email'] = $this->getMail();
            $array['foto'] = $this->getFoto();
            $array['rango'] = $this->getRango();
            $array['cargo'] = $this->getCargo();
            $array['estado'] = $this->getEstado();
        }
        return $array;
    }
    
}

?>
