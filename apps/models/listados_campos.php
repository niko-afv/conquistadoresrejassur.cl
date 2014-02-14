<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of listados_campos
 *
 * @author nfredes
 */
class Listados_Campos extends CI_Model{

    public function __construct() {
        parent::__construct();
        $this->load->library('utils');
    }

    public function listarCamposTabla($entidad){
        $campos = array();
        
        $this->db->where('ID',$entidad);
        $res = $this->db->get("ENTIDADES");
        if(count($res->result())> 0){
            $resultados = $res->result();
            $tabla = $resultados[0]->TABLA;
            
            $res = $this->db->query("DESCRIBE ".$tabla);
            if(count($res->result()) > 0){
                foreach ($res->result() as $item => $val){
                    $oUtils = new $this->utils();
                    $campos[] = $oUtils->formatString($val->Field);
                }
            }
        }
        print $campos[1];
        die;
        return $campos;
    }
    
}
