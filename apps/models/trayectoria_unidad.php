<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of trayectoriaUnidad
 *
 * @author nks
 */
class Trayectoria_Unidad extends CI_Model{
    
    private $id;
    private $temporada;
    private $foto;
    private $grito;
    
    private $integrantes;

    private $nuevo;


    public function __construct() {
        parent::__construct();
        $this->load->model('integrante');
        $this->integrantes = new ArrayObject();
        $this->nuevo = TRUE;
    }
    
    public function setId($value){
        $this->id = $value;
        
        $this->db->where('ID',  $this->getId());
        $res = $this->db->get('UNIDADES_TRAYECTORIA');
        
        if( count($res->result()) > 0){
            $this->nuevo = FALSE;
            $xtrayectoria = $res->result();
            $this->setTemporada($xtrayectoria[0]->TEMPORADA);
            $this->setFoto($xtrayectoria[0]->FOTO_UNIDAD);
            $this->setGrito($xtrayectoria[0]->GRITO_UNIDAD);

            $this->db->where('UNIDADES_TRAYECTORIA_ID',  $this->getId());
            $res = $this->db->get('UNIDADES_TRAYECTORIA_INTEGRANTES');

            if( count($res->result()) > 0 ){
                foreach($res->result() as $item => $val){
                    $xintegrante = new $this->integrante();
                    $xintegrante->setRut($val->INTEGRANTES_RUT);
                    $this->addIntegrante($xintegrante);
                }
            }
        }else{
            $this->nuevo = TRUE;
        }
    }
    public function setTemporada($value){$this->temporada = $value;}
    public function setFoto($value){$this->foto = $value;}
    public function setGrito($value){$this->grito = $value;}
    
    public function getId(){return $this->id;}
    public function getTemporada(){return $this->temporada;}
    public function getFoto(){return $this->foto;}
    public function getGrito(){return $this->grito;}
    
    
    public function addIntegrante($xintegrante){
        $this->integrantes->append($xintegrante);
    }
    public function getIntegrante($index){
        return $this->integrantes->offsetGet($index);
    }
    public function countIntegrantes(){
        return $this->integrantes->count();
    }
    public function removeIntegrantes($index){
        $this->integrantes->offsetUnset($index);
    }


    public function save($unidad){
        $array['TEMPORADA'] =   $this->getTemporada();
        $array['FOTO_UNIDAD']      =   $this->getFoto();
        $array['GRITO_UNIDAD']     =   $this->getGrito();
        $array['ID_UNIDAD']  =   $unidad;
        if($this->nuevo){
            $res = $this->db->insert('UNIDADES_TRAYECTORIA',$array);
        }else{
            $this->db->where('ID',$this->getId());
            $res = $this->db->update('UNIDADES_TRAYECTORIA',$array);
        }
        return $res;
    }

    public function toArray($db = FALSE){
        $array = array();
        if($db){
            $array['TEMPORADA'] =   $this->getTemporada();
            $array['FOTO_UNIDAD']      =   $this->getFoto();
            $array['GRITO_UNIDAD']     =   $this->getGrito();
        }else{
            $array['id']        =   $this->getId();
            $array['temporada'] =   $this->getTemporada();
            $array['foto']      =   $this->getFoto();
            $array['grito']     =   $this->getGrito();
        }
        return $array;
    }
}

?>
