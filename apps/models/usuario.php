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
    
    private $id;
    private $nombre;
    private $clave;
    private $estado;
    private $last_login;

    public function __construct() {
        parent::__construct();
    }
    
    public function setId($value){$this->id = $value;}
    public function setNombre($value){$this->nombre = $value;}
    public function setClave($value){$this->clave = $value;}
    public function setEstado($value){$this->estado = $value;}
    public function setLast_login ($last_login) {$this->last_login = $last_login;}
    
    public function getId(){return $this->id;}
    public function getNombre(){return $this->nombre;}
    public function getClave(){return $this->clave;}
    public function getEstado(){return $this->estado;}
    public function getLast_login () {return $this->last_login;}
    
    public function Login(){
        $sql = "SELECT * FROM USUARIOS WHERE NOMBRE = '".$this->getNombre()."' AND CLAVE = PASSWORD('".$this->getClave()."')";
        $res = $this->db->query($sql);
        if(count($res->result()) == 0){
            return FALSE;
        }  else {
            $xuser = $res->result();
            $this->setId($xuser[0]->ID);
            $this->setLast_login($xuser[0]->ULTIMA_VISITA);
            return TRUE;
        }
    }
    
    public function updateLastLogin(){
        $this->db->where("ID", $this->getId());
        return $this->db->update("USUARIOS",array("ULTIMA_VISITA"=>date("Y-m-d")));
    }
            
}

?>
