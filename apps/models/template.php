<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of listadosTemplates
 *
 * @author nfredes
 */
class Template extends CI_Model{
    
    private $id;
    private $nombre;
    private $entidad;
    
    private $listaCampos;
    
    private $xnuevo;
    
    public function __construct() {
        parent::__construct();
        $this->xnuevo = TRUE;
        $this->listaCampos = new ArrayObject();
        $this->load->model('entidad','xentidad');
        $this->entidad = new $this->xentidad();
    }
    
    public function getNombre() {
        return $this->nombre;
    }

    public function getEntidad() {
        return $this->entidad;
    }
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        
        $this->db->where('ID', $id);
        $res = $this->db->get('LISTADOS_TEMPLATES');
        if(count($res->result()) > 0){
            $xtemplate = $res->result();
            $this->setNombre($xtemplate[0]->NOMBRE);
            
            $this->setEntidad($xtemplate[0]->ID_ENTIDAD);
            
            $this->db->where('ID_LISTADO_TEMPLATE', $id);
            $res = $this->db->get('LISTADOS_CAMPOS');
            foreach($res->result() as $xcampo => $val){
                $this->addCampo($val->NOMBRE);
            }
        }
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setEntidad($entidad) {
        $this->entidad->setId($entidad);
    }
    
    public function save(){
        if($this->xnuevo){
            $ins = $this->db->insert('LISTADOS_TEMPLATES', $this->toArray(TRUE));
            if($ins){
                $id = $this->db->insert_id();
                for($i=0;$i<$this->countCampos();$i++){
                    $array = array(
                        'ID_LISTADO_TEMPLATE'   =>    $id,
                        'NOMBRE'                => $this->getCampo($i)
                    );
                    $this->db->insert("LISTADOS_CAMPOS",$array);
                }
            }
            $res = TRUE;
        }else{
            
        }
        return $res;
    }
    public function delete(){
        $res =  $this->db->delete('LISTADOS_TEMPLATES',array('ID'=>$this->getId()));
        if($res){
            return $res;
        }else{
            $data['error'] = $this->db->_error_message() . " | ". $this->db->_error_number();
            return $data;
        }
    }

    public function toArray($db = FALSE){
        $array = array();
        if(!$db){
            $array['id'] = $this->getId();
            $array['nombre'] = $this->getNombre();
            $array['entidad'] = $this->getEntidad();
            for($i = 0; $i < $this->countCampos();$i++){
                $array['campos'][] = $this->getCampo($i);
            }
        }else{
            $array['NOMBRE'] = $this->getNombre();
            $array['ID_ENTIDAD'] = $this->getEntidad()->getId();
        }
        return $array;
    }
    
    public function addCampo($campo){
        $this->listaCampos->append($campo);
    }
    public function countCampos(){
        return $this->listaCampos->count();
    }
    public function getCampo($index){
        return $this->listaCampos->offsetGet($index);
    }
    public function deleteCampo($index){
        $this->listaCampos->offsetUnset($index);
    }
}
