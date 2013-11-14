<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of categoria_flujo_caja
 *
 * @author nks
 */
class Categoria_Flujo_Caja extends CI_Model{
    
    private $id;
    private $nombre;
    private $tipo;
    private $subCategorias;
    private $total;


    public function __construct() {
        parent::__construct();
        $this->subCategorias = new ArrayObject();
        $this->load->model('sub_categoria_flujo_caja');
    }
    
    
    public function setId($val){
        $this->id = $val;
        $this->db->where('ID',$this->id);
        $res = $this->db->get('FLUJO_CAJA_CATEGORIAS');
        
        if(count($res->result()) > 0){
            $categoria = $res->result();
            $this->setNombre($categoria[0]->NOMBRE);
            $this->setTipo($categoria[0]->TIPO);

            $this->db->select('ID');
            $this->db->where('CATEGORIA_PADRE',$this->id);
            $res2 = $this->db->get('FLUJO_CAJA_CATEGORIAS');
            
            if(count($res2->result()) > 0){
                
                foreach($res2->result() as $item => $val2){
                    $oSubCategoria = new $this->sub_categoria_flujo_caja();
                    $oSubCategoria->setId($val2->ID);                    
                    $this->addSubCategoria($oSubCategoria);
                }
                $this->calculaTotal();
            }
        }
        
    }
    public function setNombre($val){$this->nombre = $val;}
    public function setTipo($val){$this->tipo = $val;}
    public function getId(){return $this->id;}
    public function getNombre(){return $this->nombre;}
    public function getTipo(){return $this->tipo;}
    public function getTotal(){return $this->total;}
    
    public function addSubCategoria($oFlujoCaja){
        $this->subCategorias->append($oFlujoCaja);
    }
    public function countSubCategorias(){
        return $this->subCategorias->count();
    }
    public function getSubCategoria($index){        
        return $this->subCategorias->offsetGet($index);
    }
    public function removeSubCategoria($index){
        $this->subCategoria->offsetUnset($index);
    }
    
    private function calculaTotal(){
        $fecha = date('Y-m',strtotime(date('Y-m')." -5 month"));
        
        for($x = 0; $x <= 5; $x++){
            $xfecha = date('Y-m',strtotime($fecha." +$x month"));
            $monto[$xfecha]  = 0;
        }        

        for($i=0; $i < $this->countSubCategorias(); $i++){
            foreach($this->getSubCategoria($i)->getPeriodos() as $item => $val){
                $monto[$item] += $val['montos'];                
            }
        }
        $this->total = $monto;
    }


    public function toArray(){
        $array = array();
        $array['nombre']        = $this->getNombre();
        $array['id']            = $this->getId();
        $array['total']         = $this->getTotal();
        $array['subCategorias'] = array();
        for($i=0; $i<$this->countSubCategorias(); $i++){
            $array['subCategorias'][$i] = $this->getSubCategoria($i)->toArray();
        }
        return $array;
    }
}

?>
