<?php

/**
 * Description of integrante_form
 *
 * @author nks
 */
class CtrlIntegranteForm extends CI_Controller{
    
    var $title;
    var $page;
    var $edad;
    
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->title = 'Integrantes';
        $this->layout = array('base'=>'main','meta','header','sidebar','footer');
        $this->session->loginState('userBo_session');
        $this->page = 'integrantes';
        /*$this->session->set_userdata(array('userBo_url_referida'=>$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']));
        if(!$this->session->userdata('userBo_id') && $this->uri->segments[2] != 'login'){
            //redirect('index.php/admin/login');
        }*/
    }
    
    public function index(){
        $data['base_url']       =   base_url();
        $data['title']          =   $this->title;
        $data['page']           =   $this->page;
        $data['category_title'] =   'Agregar Integrante';
        $data['cargos']         =   $this->loadCargos();
        $data['rangos']         =   $this->loadRangos();
        $data['unidades']       =   $this->loadUnidades();
        
        $this->load->model('integrante');
        $oIntegrante = new $this->integrante();        
        $data['integrante'] = $oIntegrante->toArray(FALSE);
        if($_POST){
            $this->edad = $this->input->post('edad');
            
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            
            $this->form_validation->set_rules('rut','Rut','required|min_length[9]|max_length[10]');
            $this->form_validation->set_rules('nombre','Nombre','required|min_length[5]|max_length[25]');
            $this->form_validation->set_rules('apellido','Apellido','required|min_length[4]|max_length[25]');
            $this->form_validation->set_rules('edad','Edad','required|exact_length[2]|numeric');
            $this->form_validation->set_rules('fono','Telefono','min_length[7]|max_length[15]');
            $this->form_validation->set_rules('fono2','Telefono Auxiliar','min_length[7]|max_length[15]');
            $this->form_validation->set_rules('direccion','Direccion','min_length[10]|max_length[50]');
            $this->form_validation->set_rules('mail','E-Mail','valid_email');
            $this->form_validation->set_rules('imgIntegrante-img1','Foto de Perfil','min_length[10]');
            $this->form_validation->set_rules('cargos[]','Cargo','required|numeric|callback_verificar_cargo');
            $this->form_validation->set_rules('grado','Grado','numeric|callback_verificar_grado');
            $this->form_validation->set_rules('estado','Estado','alpha');
            if($this->input->post('edad') < 16){
                $this->form_validation->set_rules('rutApoderado','Rut Apoderado','required|min_length[9]|max_length[10]');
                $this->form_validation->set_rules('nombreApoderado','Nombre Apoderado','required|min_length[5]|max_length[25]');
                $this->form_validation->set_rules('apellidoApoderado','Apellido Apoderado','required|min_length[4]|max_length[25]');
                $this->form_validation->set_rules('fonoApoderado','Telefono Apoderado','min_length[7]|max_length[15]');
            }
            
            if($this->form_validation->run()){
                    $oIntegrante->setRut($this->input->post('rut'));
                    $oIntegrante->setNombre($this->input->post('nombre'));
                    $oIntegrante->setApellido($this->input->post('apellido'));
                    $oIntegrante->setEdad($this->input->post('edad'));
                    $oIntegrante->setRango($this->input->post('grado'));
                    $oIntegrante->setEstado(($this->input->post("estado") == "on")?1:0);
                    $this->load->model("cargo");
                    
                    $oIntegrante->setApoderado($this->input->post('rutApoderado'));
                    $oIntegrante->getApoderado()->setNombre($this->input->post('nombreApoderado'));
                    $oIntegrante->getApoderado()->setApellido($this->input->post('apellidoApoderado'));
                    $oIntegrante->getApoderado()->setTelefono($this->input->post('fonoApoderado'));
                    
                    $oIntegrante->deleteCargos();
                    
                    foreach ($this->input->post('cargos') as $item => $cargo){                        
                        $oCargo = new $this->cargo();
                        $oCargo->setID($cargo);
                        $oIntegrante->addCargo($oCargo);
                    }
                    
                    
                    
                    if($this->input->post('imgIntegrante-img1')){
                        $oIntegrante->setFoto($this->input->post('imgIntegrante-img1'));
                    }else{
                        $oIntegrante->setFoto('');
                    }
                    
                    if($this->input->post('fono')){$oIntegrante->setTelefono($this->input->post('fono'));}
                    if($this->input->post('fono2')){$oIntegrante->setTelefonoAuxiliar($this->input->post('fono2'));}
                    if($this->input->post('direccion')){$oIntegrante->setDireccion($this->input->post('direccion'));}
                    if($this->input->post('mail')){$oIntegrante->setMail($this->input->post('mail'));}
                        if($oIntegrante->getApoderado()->save()){
                            if($oIntegrante->save()){
                                $this->load->model('trayectoria_integrante');
                                $oTrayectoria = new $this->trayectoria_integrante();
                                
                                $oTrayectoria->setTemporada($this->session->userdata("userBo_temporada_id"));
                                if($oTrayectoria->save($oIntegrante->getRut())){
                                    $this->session->set_flashdata('success','<strong>¡Bien echo!</strong> El integrante se ha guardado con exito');
                                    redirect('admin/integrantes_list/');
                                }
                            }else{
                                $this->session->set_flashdata('error','<strong>¡Hubo un problema!</strong> Los datos no se han guardado, intentelo mas tarde');
                                //redirect('admin/integrantes_list/');
                            }
                        }else{
                            $this->session->set_flashdata('error','<strong>¡Hubo un problema al añadir el apoderado!</strong> Los datos no se han guardado, intentelo mas tarde');
                            //redirect('admin/integrantes_list/');
                        }
            }
        }
        $this->load->view('backend/ViewIntegranteForm',$data);
    }
    
    public function modificar($rut){
        $this->load->model('integrante');
        $oIntegrante = new $this->integrante();
        $oIntegrante->setRut($rut);
        
        $data['base_url']       =   base_url();
        $data['title']          =   $this->title;
        $data['category_title'] =   'Modificar Integrante';
        $data['page']           =   $this->page;
        $data['cargos']         =   $this->loadCargos();
        $data['rangos']         =   $this->loadRangos();
        
        $data['integrante'] = $oIntegrante->toArray(FALSE);
        $this->load->view('backend/ViewIntegranteForm',$data);
    }
    
    private function loadCargos(){
        $this->load->model("listado");
        $oListado   =   new $this->listado();
        $oListado->listarCargos();
        $array      =   array();
        for ($i = 0; $i < $oListado->count();$i++){
            $array[$i]['id']    =   $oListado->get($i)->getId();
            $array[$i]['nombre']    =   $oListado->get($i)->getNombre();
        }
        return $array;
    }
    private function loadRangos(){
        $this->load->model("listado");
        $oListado   =   new $this->listado();
        $oListado->listarRangos();
        $array      =   array();
        for ($i = 0; $i < $oListado->count();$i++){
            $array[$i]['id']    =   $oListado->get($i)->getId();
            $array[$i]['nombre']    =   $oListado->get($i)->getNombre();
        }
        return $array;
    }
    private function loadUnidades(){
        $this->load->model("listado");
        $oListado   =   new $this->listado();
        $oListado->listarUnidades();
        $array      =   array();
        for ($i = 0; $i < $oListado->count();$i++){
            $array[$i]['id']    =   $oListado->get($i)->getId();
            $array[$i]['nombre']    =   $oListado->get($i)->getNombre();
        }
        return $array;
    }

    public function deleteImage(){
        unset($this->layout);
        $this->load->library('utils');
        $oUtils = new $this->utils();

        if($oUtils->isAjax()){
            $response = $oUtils->deleteImage($this->input->post('img', TRUE));
            $data = array('content' => $response);
            $this->load->view('ajax',$data);
        }else{
            $this->session->set_flashdata('error', 'La petición realizada es invalida');
            redirect('index.php/admin/integrantes_list/');
        }
    }
    
    public function verificar_cargo($cargo){        
        if($this->edad <= 15 && $cargo != 3){
            $this->form_validation->set_message('verificar_cargo', 'El cargo seleccionado solo puede ser asignado a mayores de 15 años de edad');
            return FALSE;
        }else{
            return TRUE;
        }
    }
    
    public function verificar_grado($grado){
        if($this->edad <= 15 && $grado != 1){
            $this->form_validation->set_message('verificar_grado', 'El grado seleccionado solo puede ser asignado a mayores de 15 años de edad');
            return FALSE;
        }  else {
            return TRUE;
        }
    }
    
    public function toPDF($rut){
        unset($this->layout);
        
        $this->load->model('integrante');
        $oIntegrante = new $this->integrante();
        $oIntegrante->setRut($rut);
        
        $data['base_url']       =   base_url();
        $data['title']          =   $this->title;
        $data['category_title'] =   'Ver Integrante';
        $data['page']           =   $this->page;
        
        $data['integrante'] = $oIntegrante->toArray(FALSE);
        $this->load->view('backend/ViewIntegranteProfile',$data);
        
        //$this->load->helper(array('dompdf', 'file'));
        
        /*$html = $this->load->view('backend/ViewIntegrantesListPrint',$data, TRUE);
        pdf_create($html, 'FichaIntegrante');*/
    }
    
    public function searchByRut(){
        unset($this->layout);
        $this->load->library('utils');
        $oUtils = new $this->utils();

        if($oUtils->isAjax()){
            if($_POST){
                $rut = $this->input->post("rut");
                $this->load->model('integrante');
                $oIntegrante = new $this->integrante();
                $oIntegrante->setRut($rut);
                
                $data = array('content' => $oIntegrante->toArray(FALSE),'type'=>'json');
                $this->load->view('ajax',$data);
            }
        }else{
            $this->session->set_flashdata('error', 'La petición realizada es invalida');
            redirect('index.php/admin/integrantes_list/');
        }
    }
    
}
?>