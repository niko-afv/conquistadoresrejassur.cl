<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of flujo_caja
 *
 * @author nks
 */
class Flujo_Caja extends CI_Model{
    
    private $id             =   '';
    private $descripcion    =   '';
    private $monto          =   '';
    private $fecha          =   '';
    private $subCategoria   =   '';


    var $xnuevo             =   TRUE;

    public function __construct() {
        parent::__construct();
    }
    
    public function setId($val){
        $this->id = $val;
        
        $this->db->where('ID',  $this->getId());
        $res = $this->db->get('FLUJO_CAJA');
        
        if( count($res->result()) > 0){
            $this->xnuevo = FALSE;
            $xflujo = $res->result();
            $this->setDescripcion($xflujo[0]->DESCRIPCION);
            $this->setMonto($xflujo[0]->MONTO);
            $this->setFecha($xflujo[0]->FECHA);
            $this->setSubCategoria($xflujo[0]->FLUJO_CAJA_CATEGORIA_ID);
        }else{
            $this->xnuevo = TRUE;
        }
    }
    public function setDescripcion($val){$this->descripcion = $val;}
    public function setMonto($val){$this->monto = $val;}
    public function setFecha($val){$this->fecha = $val;}
    public function setSubCategoria($val){$this->subCategoria = $val;}
    
    public function getId(){return $this->id;}
    public function getDescripcion(){return $this->descripcion;}
    public function getMonto(){return $this->monto;}
    public function getFecha(){return $this->fecha;}
    public function getSubCategoria(){return $this->subCategoria;}
    
    public function save(){
        if ($this->xnuevo == TRUE){
            $res = $this->db->insert("FLUJO_CAJA",  $this->toArray(TRUE));
        }  else {
            $this->db->where('ID',  $this->getId());
            $res = $this->db->update("FLUJO_CAJA",  $this->toArray(TRUE));
        }
        return $res;
    }

    public function toArray($db = FALSE){
        $array = array();
        if($db){
            $array['ID'] = $this->getId();
            $array['DESCRIPCION'] = $this->getDescripcion();
            $array['MONTO'] = $this->getMonto();
            $array['FECHA'] = $this->getFecha();
            $array['FLUJO_CAJA_CATEGORIA_ID'] = $this->getSubCategoria();
        }else{
            $array['id'] = $this->getId();
            $array['descripcion'] = $this->getDescripcion();
            $array['monto'] = $this->getMonto();
            $array['fecha'] = $this->getFecha();
            $array['subCategoria'] = $this->getSubCategoria();
        }
        return $array;
    }

    public function getTipoMovimiento(){
        /*$this->db->where('ID',$this->getSubCategoria());
        $this->get('FLUJO_CAJA_CATEGORIAS');*/

        $this->load->model('categoria_flujo_caja');
        $oCategoria = new $this->categoria_flujo_caja();
        $oCategoria->setId($this->getSubCategoria());
        return $oCategoria->getTipo();
    }
}

?>
