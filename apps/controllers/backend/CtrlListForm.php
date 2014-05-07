<?php
/**
 * Description of CtrlListForm
 *
 * @author nfredes
 */
class CtrlListForm extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->title = 'Listados';
        $this->layout = array('base'=>'main','meta','header','sidebar','footer');
        $this->session->loginState('userBo_session');
        $this->page = 'plantillas';
    }
    public function cargar($template_id = NULL){
        
        if($template_id == NULL){
            $this->session->set_flashdata('error', 'La petición realizada es invalida');
            redirect('/admin/plantillas_list/');
        }
        
        $this->load->model('template');
        $this->load->model('listado');

        $data['base_url']       =   base_url();
        $data['title']          =   $this->title;
        $data['page']           =   $this->page;
        $data['category_title'] =   'Configuración del Listado';


        $oTemplate  =   new $this->template($template_id);
        $oListado   =   new $this->listado();

        $template   =   $oTemplate->toArray();
        $oListado->customList($template['entidad']['Tabla'],$template['campos']);

        $data['entidad']    =   array(
                'nombre'    =>  $template['nombre'],
                'entidad'   =>  array(
                    'nombre'    =>  $template['entidad']['Nombre']
                )
        );

        for($i=0; $i < $oListado->count(); $i++){
            foreach($template['campos'] as $campo){
                if($campo['tipo'] == 1){
                    $xcampo = $campo['nombre'];
                    $data['entidad']['lista'][$i][$xcampo] =$oListado->get($i)->getProperty($xcampo);
                    
                }
            }
        }       
        
        $data['template']   =   $oTemplate->toArray();
        $data['id']         =   $template_id; 
        $this->load->view("backend/ViewListForm",$data);
    }
    
    public function toPDF($template_id = NULL){
        
        unset($this->layout);
        
        if($template_id == NULL){
            $this->session->set_flashdata('error', 'La petición realizada es invalida');
            redirect('/admin/plantillas_list/');
        }
        
        $this->load->model('template');
        $this->load->model('listado');

        $data['base_url']       =   base_url();
        $data['title']          =   $this->title;
        $data['page']           =   $this->page;
        $data['category_title'] =   'Configuración del Listado';


        $oTemplate  =   new $this->template($template_id);
        $oListado   =   new $this->listado();

        $template   =   $oTemplate->toArray();
        $oListado->customList($template['entidad']['Tabla'],$template['campos']);

        $data['entidad']        =   array(
                    'nombre'    =>  $template['nombre'],
                    'entidad'   =>  array(
                        'nombre'    =>  $template['entidad']['Nombre']
            )
        );

        for($i=0; $i < $oListado->count(); $i++){
            foreach($template['campos'] as $campo){
                if($campo['tipo'] == 1){
                    $xcampo = $campo['nombre'];
                    $data['entidad']['lista'][$i][$xcampo] =$oListado->get($i)->getProperty($xcampo);
                }
            }
        }
        
        $data['template']   =   $oTemplate->toArray();
        $data['campos_extra'] = $this->input->post();
        $html = $this->load->view("backend/ViewListPrint",$data, TRUE);
        
        $this->load->helper(array('dompdf', 'file'));
        $pdf_string = pdf_create($html, $oTemplate->getNombre(), FALSE);
        $final_file = PDF_PATH . $oTemplate->getNombre() . ".pdf";
        $file_url = PDF . $oTemplate->getNombre() . ".pdf";
        $file = fopen($final_file, "a");
        fwrite($file, $pdf_string);
        fclose($file);
        
        $json = array(
            'success' => TRUE,
            'file'  => $file_url
        );
        
        $data = array(
            'content' => $json,
            'type'  => 'json'
        );
        $this->load->view("ajax",$data);
    }
}