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
class Unidad extends CI_Model{

    private $id;
    private $nombre;
    private $fundado;
    private $estado;
    
    private $trayectorias;


    private $xnuevo;


    public function __construct() {
        parent::__construct();
        $this->xnuevo = FALSE;
        $this->trayectorias = new ArrayObject();
        $this->load->model('trayectoria_unidad');
    }
    
    public function setId($value){
        $this->id = $value;
        
        $this->db->where('ID',  $this->getId());
        $res = $this->db->get('UNIDADES');
        
        if(count($res->result()) == 0){
            $this->xnuevo = TRUE;            
        }else{            
            $xunidad = $res->result();            
            $this->setNombre($xunidad[0]->NOMBRE);
            $this->setFundado($xunidad[0]->FUNDADO);
            $this->setEstado($xunidad[0]->ESTADO);
            
            $this->db->where('ID_UNIDAD',  $this->getId());
            $res = $this->db->get('UNIDADES_TRAYECTORIA');
            
            if( count($res->result()) > 0 ){
                foreach($res->result() as $item => $val){
                    /*$xTrayectoria = new $this->trayectoria_unidad();
                    /*$xTrayectoria->setId($val->ID);
                    $this->addTrayectoria($xTrayectoria);*/
                }
            }
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
    
    public function addTrayectoria($xtrayectoria){
        $this->trayectorias->append($xtrayectoria);
    }
    public function getTrayectoria($index){
        return $this->trayectorias->offsetGet($index);
    }
    public function countTrayectorias(){
        return $this->trayectorias->count();
    }
    public function removeTrayectoria($index){
        $this->trayectorias->offsetUnset($index);
    }
    
}

?>
