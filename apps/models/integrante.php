<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of integrante
 *
 * @author nks
 */
class Integrante extends CI_Model{
    
    
    private $rut                = '';
    private $nombre             = '';
    private $apellido           = '';
    private $edad               = '';
    private $telefono           = '';
    private $telefono_auxiliar  = '';
    private $direccion          = '';
    private $email              = '';
    private $foto               = '';
    private $rango              = '';
    private $estado             = 1;
    private $apoderado          = '';
    
    private $unidad             = '';
    private $historial          = '';
    private $listCargos             = '';

    private $xnuevo;
    
    public function __construct($xrut = FALSE) {
        parent::__construct();
        $this->xnuevo = FALSE;
        $this->load->model('apoderado','apoderado_m');
        $this->load->model('rango','rango_m');
        $this->load->model('cargo');
        $this->apoderado = new $this->apoderado_m();
        //$this->setApoderado('88811111-1');
        $this->rango = new $this->rango_m();
        $this->listCargos = new ArrayObject();
        if($xrut){
            $this->setRut($xrut);
        }
    }


    public function setRut($value){
        $this->rut = $value;
        
        $this->db->where('RUT',  $this->getRut());
        $res = $this->db->get("INTEGRANTES");
        if(count($res->result()) > 0){
            $xintegrante = $res->result();
            $this->setNombre($xintegrante[0]->NOMBRE);
            $this->setApellido($xintegrante[0]->APELLIDO);
            $this->setEdad($xintegrante[0]->EDAD);
            $this->setTelefono($xintegrante[0]->TELEFONO_PRINCIPAL);
            $this->setTelefonoAuxiliar($xintegrante[0]->TELEFONO_AUXILIAR);
            $this->setDireccion($xintegrante[0]->DIRECCION);
            $this->setMail($xintegrante[0]->EMAIL);
            $this->setFoto($xintegrante[0]->FOTO);
            $this->setRango($xintegrante[0]->RANGO);
            $this->setEstado($xintegrante[0]->ESTADO);
            
            $this->apoderado->setRut($xintegrante[0]->RUT_APODERADO);
            
            $this->db->where("RUT_INTEGRANTE",$this->getRut());
            $this->db->where("ID_TEMPORADA",$this->session->userdata("userBo_temporada_id"));
            $this->db->where("ESTADO",1);
            $res = $this->db->get("INTEGRANTES_CARGOS");
            foreach($res->result() as $item => $cargo){
                $oCargo = new $this->cargo();
                $oCargo->setID($cargo->ID_CARGO);
                $this->addCargo($oCargo);
            }
            
            $this->xnuevo = FALSE;
        }else{
            $this->xnuevo = TRUE;
        }
        $this->getUnidad();
        return $this->xnuevo;
    }
    public function setRango($value){
        $this->rango->setId($value);
    }    
    public function setNombre($value){$this->nombre = $value;}
    public function setApellido($value){$this->apellido = $value;}
    public function setEdad($value){$this->edad = $value;}
    public function setTelefono($value){$this->telefono = $value;}
    public function setTelefonoAuxiliar($value){$this->telefono_auxiliar = $value;}
    public function setDireccion($value){$this->direccion = $value;}
    public function setMail($value){$this->email = $value;}
    public function setFoto($value){$this->foto = $value;}    
    public function setEstado($value){$this->estado = $value;}
    public function setApoderado($value){$this->apoderado->setRut($value);}
    

    
public function getRut(){return $this->rut;}
    public function getNombre($short = FALSE){
        if($short){
            $nombre = explode(" ", $this->nombre);
            return $nombre[0];
        }else{
            return $this->nombre;
        }
    }
    public function getApellido($short = FALSE){
        if($short){
            $apellido = explode(" ", $this->apellido);
            return $apellido[0];
        }else{
            return $this->apellido;
        }
    }
    public function getEdad(){return $this->edad;}
    public function getTelefono(){return $this->telefono;}
    public function getTelefonoAuxiliar(){return $this->telefono_auxiliar;}
    public function getDireccion(){return $this->direccion;}
    public function getMail(){return $this->email;}
    public function getFoto(){return $this->foto;}
    public function getRango(){return $this->rango;}    
    public function getEstado(){return $this->estado;}
    public function getApoderado(){return $this->apoderado;}
    public function getUnidad(){
        $query = "SELECT U.NOMBRE FROM UNIDADES AS U INNER JOIN UNIDADES_TRAYECTORIA AS T ON U.ID = T.ID_UNIDAD INNER JOIN UNIDADES_TRAYECTORIA_INTEGRANTES AS T2 ON T.ID = T2.UNIDADES_TRAYECTORIA_ID WHERE T2.INTEGRANTES_RUT = '".$this->getRut()."'";
        $res = $this->db->query($query);
        if(count($res->result()) >0){
            $res = $res->result();
            return $res[0]->NOMBRE;
        }else{
            return FALSE;
        }
    }

    public function save(){
        if ($this->xnuevo == TRUE){
            $res = $this->db->insert("INTEGRANTES",  $this->toArray());
        }  else {
            $this->db->where('RUT',  $this->getRut());
            $res = $this->db->update("INTEGRANTES",  $this->toArray());
        }
        $this->__DBActualizarCargos();
        return $res;
    }
    
    public function delete(){
        //$res =  $this->db->delete('INTEGRANTES',array('RUT'=>$this->getRut()));
        $res = $this->db->where("RUT", $this->getRut());
        $res = $this->db->update("INTEGRANTES",array("ESTADO"=>0));
        if($res){
            return $res;
        }else{
            $data['error'] = $this->db->_error_message() . " | ". $this->db->_error_number();
            return $data;
        }
    }
    
    
    public function toArray($db = TRUE){
        $array = array();
        if($db){
            $array['RUT']                   = $this->getRut();
            $array['NOMBRE']                = $this->getNombre();
            $array['APELLIDO']              = $this->getApellido();
            $array['EDAD']                  = $this->getEdad();
            $array['TELEFONO_PRINCIPAL']    = $this->getTelefono();
            $array['TELEFONO_AUXILIAR']     = $this->getTelefonoAuxiliar();
            $array['DIRECCION']             = $this->getDireccion();
            $array['EMAIL']                 = $this->getMail();
            $array['FOTO']                  = $this->getFoto();
            $array['RANGO']                 = $this->getRango()->getId();
            //$array['CARGO']                 = $this->getCargo()->getId();
            $array['ESTADO']                = $this->getEstado();
            $array['RUT_APODERADO']         = $this->getApoderado()->getRut();
            
        }else{
            $array['rut']                   = $this->getRut();
            $array['nombre']                = $this->getNombre();
            $array['apellido']              = $this->getApellido();
            $array['edad']                  = $this->getEdad();
            $array['telefono_principal']    = $this->getTelefono();
            $array['telefono_auxiliar']     = $this->getTelefonoAuxiliar();
            $array['direccion']             = $this->getDireccion();
            $array['email']                 = $this->getMail();
            $array['foto']                  = $this->getFoto();
            $array['rango']                 = $this->getRango()->getId();
            $array['estado']                = $this->getEstado();
            $array['unidad']                = $this->getUnidad();
            $array['apoderado']['rut']      = $this->getApoderado()->getRut();
            $array['apoderado']['nombre']   = $this->getApoderado()->getNombre();
            $array['apoderado']['apellido'] = $this->getApoderado()->getApellido();
            $array['apoderado']['telefono'] = $this->getApoderado()->getTelefono();
            
            $array['cargos'] = array();
            for($i=0; $i<$this->countCargos(); $i++){
                $array['cargos'][] = $this->getCargo($i)->getID();
            }
            
        }
        return $array;
    }

    public function getProperty($property){
        $property = strtolower($property);
        return $this->$property;
    }
    
    public function addCargo($cargo){
        $this->listCargos->append($cargo);
    }
    public function getCargo($index){
        return $this->listCargos->offsetGet($index);
    }
    public function countCargos(){
        return $this->listCargos->count();
    }
    public function removeCargo($index){
        $this->listCargos->offsetUnset($index);
    }
    public function deleteCargos(){
        unset($this->listCargos);
        $this->listCargos = new ArrayObject();
    }
    private function __DBActualizarCargos(){
        $cargos_a_quitar = array();
        for($i = 0; $i < $this->countCargos(); $i++){
            $this->db->where("RUT_INTEGRANTE", $this->getRut());
            $this->db->where("ID_TEMPORADA", $this->session->userdata("userBo_temporada_id"));
            $this->db->where("ID_CARGO", $this->getCargo($i)->getID());
            $res = $this->db->get("INTEGRANTES_CARGOS");
            
            if(count($res->result()) < 1){
                $datos = array(
                    'RUT_INTEGRANTE'=>  $this->getRut(),
                    'ID_CARGO'      =>  $this->getCargo($i)->getID(),
                    'ID_TEMPORADA'  =>  $this->session->userdata("userBo_temporada_id"),
                    'ESTADO'        => 1
                );
                $res2 = $this->db->insert("INTEGRANTES_CARGOS", $datos);
            }else{                
                $cargo_integrante = $res->result();                
                $cargos_a_quitar[] = $cargo_integrante[0]->ID;
                $this->db->where("ID",$cargo_integrante[0]->ID);
                $datos = array('ESTADO'=>1);
                $this->db->update("INTEGRANTES_CARGOS",$datos);
            }
        }
        if(count($cargos_a_quitar)>0){
                $this->db->where_not_in("ID",$cargos_a_quitar);
                $this->db->where("RUT_INTEGRANTE",$this->getRut());
                $datos = array('ESTADO'=>0);
                $res3 = $this->db->update("INTEGRANTES_CARGOS",$datos);
        }
        
    }
}

?>