<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sub_categoria_flujo_caja
 *
 * @author nks
 */
class Sub_Categoria_Flujo_Caja extends CI_Model{
    
    private $id;
    private $nombre;
    private $flujos;
    private $periodos = array();
    private $totalIngreso;
    private $totalEgreso;


    public function __construct() {
        parent::__construct();
        $this->flujos = new ArrayObject();
        $this->load->model('flujo_caja');
    }
    
    
    public function setId($val){
        $this->id = $val;
        $this->db->where('ID',$this->id);
        $res = $this->db->get('FLUJO_CAJA_CATEGORIAS');
        
        if(count($res->result()) > 0){
            $categoria = $res->result();
            $this->setNombre($categoria[0]->NOMBRE);
            
            $this->db->select('ID');
            $this->db->where('FLUJO_CAJA_CATEGORIA_ID',$this->id);
            $res2 = $this->db->get('FLUJO_CAJA');
            if(count($res2->result()) > 0){
                foreach($res2->result() as $item => $val2){
                    $oFlujoCaja = new $this->flujo_caja();
                    $oFlujoCaja->setId($val2->ID);
                    $this->addFlujo($oFlujoCaja);
                }
                
            }
            $this->calculaTotal();
        }
        
    }
    
    public function setNombre($val){$this->nombre = $val;}
    public function setTotalIngreso($val){$this->totalIngreso = $val;}
    public function setTotalEgreso($val){$this->totalEgreso = $val;}
    
    public function getId(){return $this->id;}
    public function getNombre(){return $this->nombre;}
    public function getTotalIngreso(){return $this->totalIngreso;}
    public function getTotalEgreso(){return $this->totalEgreso;}
    public function getPeriodos(){return $this->periodos;}
    
    public function addFlujo($oFlujoCaja){
        $this->flujos->append($oFlujoCaja);
    }
    public function countFlujos(){
        return $this->flujos->count();
    }
    public function getFlujo($index){        
        return $this->flujos->offsetGet($index);
    }
    public function removeFlujo($index){
        $this->flujos->offsetUnset($index);
    }
    
    private function calculaTotal(){
        $fecha = date('Y-m',strtotime(date('Y-m')." -5 month"));
        
        for($x = 0; $x <= 5; $x++){
            $fechaPlus = date("Y-m", strtotime($fecha." +$x month"));
            
            $this->periodos[$fechaPlus]['montos'] = 0;
            $monto   =   0;
            
            for($i = 0; $i < $this->countFlujos(); $i++){
                if(strstr($this->getFlujo($i)->getFecha(),$fechaPlus)){
                    $monto += $this->getFlujo($i)->getMonto(); 
                }
            }
            $this->periodos[$fechaPlus]['montos'] = $monto;
        }
        
    }

    public function toArray(){
        $array = array();
        $array['nombre']    = $this->getNombre();
        $array['id']        = $this->getId();
        $array['periodos']  = $this->periodos;
        $array['flujos']    = array();
        for($i=0; $i<$this->countFlujos(); $i++){
            $array['flujos'][$i] = $this->getFlujo($i)->toArray();
        }
        return $array;
    }
}

?>
