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
    private $ultima_visita;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function setNombre($value){$this->nombre = $value;}
    public function setClave($value){$this->clave = $value;}
    public function setEstado($value){$this->estado = $value;}
    public function setUltimaVisita($value){$this->ultima_visita = $value;}
    
    public function getNombre(){return $this->nombre;}
    public function getClave(){return $this->clave;}
    public function getEstado(){return $this->estado;}
    public function getUltimaVisita(){return $this->ultima_visita;}
    
    public function Login(){
        $sql = "SELECT * FROM USUARIOS WHERE NOMBRE = '".$this->nombre."' AND CLAVE = PASSWORD('".$this->clave."')";
        $res = $this->db->query($sql);
        if(count($res->result()) == 0){
            return FALSE;
        }  else {
            return TRUE;
        }
    }
            
}

?>
