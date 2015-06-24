<?php
/**
 * Created by PhpStorm.
 * User: nks
 * Date: 20-12-14
 * Time: 12:52 AM
 */

class flujo_caja_resumen extends CI_Model{

    private $id;
    private $mes;
    private $saldo_inicial;
    private $saldo_final;
    private $total_ingresos;
    private $total_egresos;

    private $xnuevo = TRUE;
    private $lista_flujos;

    public function __construct($month = NULL){
        parent::__construct();
        $this->lista_flujos = new ArrayObject();
        if(!is_null($month)){
            $this->setMes($month);
        }
    }

    public function getId(){return $this->id;}
    public function getMes(){return $this->mes;}
    public function getSaldoInicial(){return $this->saldo_inicial;}
    public function getSaldoFinal(){return $this->saldo_final;}
    public function getTotalEgresos(){return $this->total_egresos;}
    public function getTotalIngresos(){return $this->total_ingresos;}

    public function setId($id){$this->id = $id;}
    public function setMes($mes){
        $this->mes = $mes;
        $this->db->where('MES',$mes);
        $res = $this->db->get('FLUJO_CAJA_RESUMEN');

        if( count($res->result()) > 0){
            $this->xnuevo = FALSE;
            $xresumen = $res->result();
            $this->setId($xresumen[0]->ID);
            $this->setSaldoInicial($xresumen[0]->SALDO_INICIAL);
            $this->setSaldoFinal($xresumen[0]->SALDO_FINAL);
            $this->setTotalIngresos($xresumen[0]->TOTAL_INGRESO);
            $this->setTotalEgresos($xresumen[0]->TOTAL_EGRESO);

            /***__ Carga listado de flujos asociados __***/

            $this->db->where('FLUJO_CAJA_RESUMEN_ID',$this->getId());
            $res2 = $this->db->get('FLUJO_CAJA');

            if( count($res2->result()) > 0){
                $flujos = $res2->result();

                $this->load->model('flujo_caja');
                foreach ($flujos as $flujo => $val) {
                    $oFlujoCaja = new $this->flujo_caja();
                    $oFlujoCaja->setId($val->ID);
                    $this->addFlujo($oFlujoCaja);
                }
            }

        }else{
            $this->xnuevo = TRUE;
        }

    }
    public function setSaldoInicial($saldo_inicial){$this->saldo_inicial = $saldo_inicial;}
    public function setSaldoFinal($saldo_final){$this->saldo_final = $saldo_final;}
    public function setTotalEgresos($total_egresos){$this->total_egresos = $total_egresos;}
    public function setTotalIngresos($total_ingresos){$this->total_ingresos = $total_ingresos;}

    public function addFlujo($oFlujo){
        $this->lista_flujos->append($oFlujo);
    }
    public function countFlujos(){
        return $this->lista_flujos->count();
    }
    public function getFlujo($index){
        return $this->lista_flujos->offsetGet($index);
    }
    public function deleteFlujo($index){
        $this->lista_flujos->offsetUnset($index);
    }

    public function toArray(){
        $array = array();

        $array['id'] = $this->getId();
        $array['mes'] = $this->getMes();
        $array['saldo_inicial'] = $this->getSaldoInicial();
        $array['saldo_final'] = $this->getSaldoFinal();
        $array['total_ingresos'] = $this->getTotalIngresos();
        $array['total_egresos'] = $this->getTotalEgresos();
        return $array;
    }

}