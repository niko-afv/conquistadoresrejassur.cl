<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of form_apoderado
 *
 * @author nks
 */
class Apoderado_Form extends CI_Controller{
    
    var $title;

    public function __construct() {
        parent::__construct();
        $this->title = 'Apoderado';
        $this->layout = array('base'=>'main','meta','header','sidebar','footer');
        $this->session->loginState('userBo_session');	
    }

    public function agregar(){
        
        $data = array(
            'title' => $this->title,
            'category_title'    =>  'Agregar Apoderado'
        );
        $this->load->view('backend/apoderado_formulario',$data);
    }
}
?>