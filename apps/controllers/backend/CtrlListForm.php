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
        $this->page = 'Listados';
    }
    public function cargar($template_id){
        $this->load->model('template');
        $this->load->model('listado');

        $data['base_url']       =   base_url();
        $data['title']          =   $this->title;
        $data['page']           =   $this->page;
        $data['category_title'] =   'Configuración del Listado';
        $data['entidad']        =   array();


        $oTemplate  =   new $this->template($template_id);
        $oListado   =   new $this->listado();

        $template   =   $oTemplate->toArray();
        $oListado->customList($template['entidad']['Tabla'],$template['campos']);
        //print_r($oListado->get(0));
        for($i=0; $i < $oListado->count(); $i++){
            foreach($template['campos'] as $campo){
                if($campo['tipo'] == 1){
                    $xcampo = $campo['nombre'];
                    $data['entidad']['lista'][] =   array(
                        $xcampo    => $oListado->get($i)->getProperty($xcampo)
                    );
                }
            }
        }

        $data['template']   =   $oTemplate->toArray();
        $this->load->view("backend/ViewListForm",$data);
    }

}
