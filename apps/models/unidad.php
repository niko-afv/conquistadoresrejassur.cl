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

    private $historic;
    private $xnuevo;


    public function __construct($historic = FALSE) {
        parent::__construct();
        $this->xnuevo = TRUE;
        $this->trayectorias = new ArrayObject();
        $this->load->model('trayectoria_unidad');
        $xTrayectoria = new $this->trayectoria_unidad();
        $this->addTrayectoria($xTrayectoria);
        $this->historic = $historic;
    }
    
    public function setId($value){
        $this->id = $value;
        
        $this->db->where('ID',  $this->getId());
        $res = $this->db->get('UNIDADES');
        
        if(count($res->result()) == 0){
            $this->xnuevo = TRUE;            
        }else{
            $this->xnuevo = FALSE;
            $xunidad = $res->result();            
            $this->setNombre($xunidad[0]->NOMBRE);
            $this->setFundado($xunidad[0]->FUNDADO);
            $this->setEstado($xunidad[0]->ESTADO);
            
            $this->db->where('ID_UNIDAD',  $this->getId());
            $res = $this->db->get('UNIDADES_TRAYECTORIA');

            if( count($res->result()) > 0 ){

                $this->removeTrayectoria(0);
                foreach($res->result() as $item => $val){
                    $xTrayectoria = new $this->trayectoria_unidad();
                    $xTrayectoria->setId($val->ID);
                    $this->addTrayectoria($xTrayectoria);
                }
            }
        }
        return $this;
    }
    public function setNombre($value){$this->nombre = $value;}
    public function setFundado($value){$this->fundado = $value;}
    public function setEstado($value){$this->estado = $value;}
    public function setNuevo($value){$this->nuevo = $value;}
    
    public function getId(){return $this->id;}
    public function getNombre(){return $this->nombre;}
    public function getFundado(){return $this->fundado;}
    public function getEstado(){return $this->estado;}
    public function getNuevo(){return $this->xnuevo;}


    
    public function save(){
        $data = array(
            'NOMBRE'    =>  $this->getNombre(),
            'FUNDADO'   => $this->getFundado()
        );
        if($this->getNuevo()){
            $res = $this->db->insert("UNIDADES",$data);
            $this->id = $this->db->insert_id();
        }  else {
            $this->db->where('ID',  $this->getId());
            $res = $this->db->update("UNIDADES",$data);
        }
        return $res;
    }

    public function delete(){
        //$this->db->query("TRUNCATE TABLE UNIDADES_TRAYECTORIA_INTEGRANTES");
        $dlt = $this->db->delete('UNIDADES',array('ID'=>$this->getId()));
        if($dlt){
            return $this->db->delete('UNIDADES_TRAYECTORIA',array('ID_UNIDAD'=>$this->getId()));
        }else{
            return 0;
        }
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
    public function trayectoriaExist($index){
        return $this->trayectorias->offsetExists($index);
    }

    public function toArray($db = FALSE){
        $array = array();
        if($db){

        }else{
            $array['id']  = $this->getId();
            $array['nombre']  = $this->getNombre();
            $array['fundado']  = $this->getFundado();
            $array['estado']  = $this->getEstado();
            for($i =0; $i <= $this->countTrayectorias(); $i++){
                if($this->trayectoriaExist($i)){
                    $array['trayectoria'][]  = $this->getTrayectoria($i)->toArray();
                }
            }
        }
        return $array;
   }

    public function getProperty($property){
        $property = strtolower($property);
        return $this->$property;
    }
    
}

?>
