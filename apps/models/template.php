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
        $listados_templates = $this->db->get('LISTADOS_TEMPLATES');
        if(count($listados_templates->result()) > 0){
            $xtemplate = $listados_templates->result();
            $this->setNombre($xtemplate[0]->NOMBRE);
            
            $this->setEntidad($xtemplate[0]->ID_ENTIDAD);
            
            $this->db->where('ID_LISTADO_TEMPLATE', $id);
            $listados_campos_templates = $this->db->get('LISTADOS_CAMPOS_TEMPLATES');
            foreach($listados_campos_templates->result() as $row => $val){
                $this->db->where('ID', $val-> 	ID_LISTADO_CAMPO);
                $listados_campos = $this->db->get('LISTADOS_CAMPOS');
                foreach($listados_campos->result() as $row2 => $val2){
                    $this->addCampo($val2->NOMBRE);
                }
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
                $id_template = $this->db->insert_id();
                for($i=0;$i<$this->countCampos();$i++){
                    if($this->verifyCampo($this->getCampo($i))){
                        $id_campo = $this->verifyCampo($this->getCampo($i));
                        $ok = TRUE;
                    }else{
                        $array = array(
                            'NOMBRE'    =>  $this->getCampo($i)
                        );
                        $ins2 = $this->db->insert("LISTADOS_CAMPOS",$array);
                        if($ins2){
                            $id_campo = $this->db->insert_id();
                            $ok = TRUE;
                        }else{
                            $ok = FALSE;
                        }
                    }

                    if($ok){
                        $array = array(
                            'ID_LISTADO_TEMPLATE'   =>    $id_template,
                            'ID_LISTADO_CAMPO'   =>    $id_campo,
                        );
                        $ins3 = $this->db->insert("LISTADOS_CAMPOS_TEMPLATES",$array);
                    }
                }
            }
            $res = TRUE;
        }else{
            
        }
        return $res;
    }

    public function delete(){
        $res = $this->destroyAllCampos();
        if($res){
            $res2 =  $this->db->delete('LISTADOS_TEMPLATES',array('ID'=>$this->getId()));
        }
        if($res2){
            return $res2;
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

    /**
     * @param $campo = id del campo a eliminar
     * @return mixed
     * Destruye la relación entre el campo recibido y el template
     */
    public function destroyCampo($campo){
        $res    =   $this->db->delete('LISTADOS_CAMPOS_TEMPLATES',array('ID_LISTADO_CAMPO'=>$campo));
        if($res){
            return $res;
        }else{
            $data['error'] = $this->db->_error_message() . " | ". $this->db->_error_number();
            return $data;
        }
    }

    /**
     * @return mixed
     * Destruye la relación que el template tiene con todos sus campos
     */
    private function destroyAllCampos(){
        $res    =   $this->db->delete('LISTADOS_CAMPOS_TEMPLATES',array('ID_LISTADO_TEMPLATE'=>$this->getId()));
        if($res){
            return $res;
        }else{
            $data['error'] = $this->db->_error_message() . " | ". $this->db->_error_number();
            return $data;
        }
    }

    /**
     * @param $nombreCampo Nombre del campo a verificar
     * @return bool|id_campo
     * Verifica la existencia de un campo en la DB
     */
    public function verifyCampo($nombreCampo){
        $this->db->where('NOMBRE', $nombreCampo);
        $listados_campos    =    $this->db->get('LISTADOS_CAMPOS');
        if(count($listados_campos->result()) > 0){
            $xcampo = $listados_campos->result();
            return $xcampo[0]->ID;
        }else{
            return FALSE;
        }
    }

    public function autocompletar($abuscar){
        $this->db->select('NOMBRE');
        $this->db->like('NOMBRE',$abuscar,'both');
        $this->db->order_by('NOMBRE','ASC');

        $resultados = $this->db->get('LISTADOS_CAMPOS', 12);

        if(count($resultados->result()) > 0){
            foreach($resultados->result() as $row){
                $datos[] = $row->NOMBRE;
            }
            return $datos;
        }else{
            return FALSE;
        }
    }
}
