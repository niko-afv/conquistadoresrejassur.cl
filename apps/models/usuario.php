<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of usuario
 *
 * @author nks
 */
class usuario extends CI_Model {
    
    private $nombre;
    private $clave;
    private $estado;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function setNombre($value){$this->nombre = $value;}
    public function setClave($value){$this->clave = $value;}
    public function setEstado($value){$this->estado = $value;}
    
    public function getNombre(){return $this->nombre;}
    public function getClave(){return $this->clave;}
    public function getEstado(){return $this->estado;}
    
    public function Login(){
        $sql = "SELECT * FROM USUARIOS WHERE NOMBRE = '".$this->getNombre()."' AND CLAVE = PASSWORD('".$this->getClave()."')";
        $res = $this->db->query($sql);
        if(count($res->result()) == 0){
            return FALSE;
        }  else {
            return TRUE;
        }
    }
            
}

?>
