<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pruebas
 *
 * @author nks
 */
class pruebas extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model('md_bo');
        $this->load->model('usuario');
        $this->load->helper(array('form','url'));	
        $this->load->library(array('log'));
        $this->data = $this->session->flashdata('msg');
        
        if(!$this->session->userdata('userBo_id') && $this->uri->segments[2] != 'login'){
            redirect('index.php/admin/login');
        }
    }




    public function unidad(){
        $this->load->model('unidad');
        
        $Ounidad = new $this->unidad();
        $Ounidad->setId(10);
        
        $data = array(
            'res'    =>  $Ounidad
            
        );
        
        $this->load->view('backend/pruebas/pruebas',$data);
    }
    
    public function addUnidad(){
        $this->load->model('unidad');
        
        $Ounidad = new $this->unidad();
        
        $Ounidad->setNombre("unidad de prueba4");
        $Ounidad->setFundado("2013");
        $res = $Ounidad->save();
        $data = array(
            'unidad' => $res
        );
        $this->load->view('backend/pruebas/unidad2',$data);
    }
    
    public function integrantex(){
        $this->load->model('integrante');
        $oIntegrante = new $this->integrante();
        $oIntegrante->setRut('11111111-1');
        $data = array(
            'integrante'    =>  $oIntegrante,
        );
        $this->load->view('backend/pruebas/integrante',$data);
    }
 
    public function addIntegrante(){
        $this->load->model('integrante');
        $oIntegrante = new $this->integrante();
        
        $oIntegrante->setRut("11111111-1");
        $oIntegrante->setNombre("ASDF");
        $oIntegrante->setApellido("QWERTY");
        $oIntegrante->setEdad("1");
        $oIntegrante->setDireccion("alameda");
        $oIntegrante->setMail("ASDF@QUERTY.CL");
        $oIntegrante->setTelefono("1234567");
        $oIntegrante->setTelefonoAuxiliar("12345678");
        $oIntegrante->setRango("RANGO");
        $oIntegrante->setFoto("RUTA/FOTO");
        
        $data = array(
            'res'   =>  $oIntegrante->save()
        );
        
        $this->load->view('backend/pruebas/integrante2',$data);
    }
    
    public function apoderado(){
        $this->load->model('apoderado');
        $oApoderado = new $this->apoderado();
        
        $oApoderado->setRut("88811111-1");
        $data = array(
            'res'   =>  $oApoderado
        );
        $this->load->view('backend/pruebas/pruebas',$data);
    }
    
    public function trayectoriax(){
        $this->load->model('trayectoria_unidad');
        $oTrayactoria = new $this->trayectoria_unidad();
        $oTrayactoria->setId('3');
        $data = array(
            'res'    =>  $oTrayactoria,
        );
        $this->load->view('backend/pruebas/pruebas',$data);
    }
}
?>