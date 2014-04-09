<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CtrlCuentaForm
 *
 * @author nks
 */
class CtrlCuentaForm extends CI_Controller{
    
    private $title;
    
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->layout = array('base'=>'main','meta','header','sidebar','footer');
        $this->session->loginState('userBo_session');
        $this->title = "Cuenta de Integrantes";
    }
    
    
    public function index(){
        $data['base_url']       =   base_url();
        $data['title']          =   $this->title;
        $data['category_title'] =   $this->title;
        $data['page']           =   'tesoreria';
        
        if($_POST){
            
        }
        
        $this->load->view('backend/ViewCuentaForm',$data);
    }
}
