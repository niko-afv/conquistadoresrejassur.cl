<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of unidad
 *
 * @author nks
 */
class unidad extends CI_Model{

    private $id;
    private $nombre;
    private $fundado;
    private $estado;
    
    private $nuevo;


    public function __construct() {
        parent::__construct();
        $this->nuevo = FALSE;
    }
    
    public function setId($value){
        $this->id = $value;
        
        $this->db->where('ID',  $this->getId());
        $res = $this->db->get('UNIDADES');
        
        if(count($res->result()) > 0){
            $xunidad = $res->result();            
            $this->setNombre($xunidad[0]->NOMBRE);
            $this->setFundado($xunidad[0]->FUNDADO);
            $this->setEstado($xunidad[0]->ESTADO);
        }else{
            $this->nuevo = TRUE;
        }
        return $this;
    }
    public function setNombre($value){$this->nombre = $value;}
    public function setFundado($value){$this->fundado = $value;}
    public function setEstado($value){$this->estado = $value;}
    
    public function getId(){return $this->id;}
    public function getNombre(){return $this->nombre;}
    public function getFundado(){return $this->fundado;}
    public function getEstado(){return $this->estado;}
    
    public function save(){
        $data = array(
            'NOMBRE'    =>  $this->getNombre(),
            'FUNDADO'   => $this->getFundado()
        );
        if($this->nuevo){
            $res = $this->db->insert("UNIDADES",$data);
        }  else {
            $this->db->where('NOMBRE',  $this->getNombre());
            $res = $this->db->update("UNIDADES",$data);
        }
        return $res;
    }
    
    
    
}

?>
