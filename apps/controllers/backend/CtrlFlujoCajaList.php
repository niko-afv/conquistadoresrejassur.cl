<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CtrlFlujoCajaList
 *
 * @author nks
 */
class CtrlFlujoCajaList extends CI_Controller{

    var $title;

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->layout = array('base'=>'main','meta','header','sidebar','footer');
        $this->session->loginState('userBo_session');
        $this->title = "Flujo de Caja";
    }

    public function index(){
        $data['base_url']       =   base_url();
        $data['title']          =   $this->title;
        $data['category_title'] =   'Flujo de Caja';
        $data['page']           =   'tesoreria';
        
        $ms                     = date('m');
        $data['hasta']          = $ms*1-1;
        $data['desde']          = $ms*1-6;
        $data['fecha']          = date('Y-m',strtotime(date('Y-m')." -5 month"));
        $data['meses']          = array(
                        'enero','febrero','marzo','abril','mayo','junio','julio',
                        'agosto','septiembre','octubre','noviembre','diciembre');

        $this->load->model('listado');
        $oListado = new $this->listado();

        $oListado->listarCuentas(1);
        $array  =   array();
        for($i = 0; $i < $oListado->count(); $i++){
            $array[$i] = $oListado->get($i)->toArray();
        }
        $data['cuentas']['ingresos'] = $array;
        $oListado->limpiar();
        unset($array);

        $oListado->listarCuentas(0);
        $array2  =   array();
        for($i = 0; $i < $oListado->count(); $i++){
            $array2[$i] = $oListado->get($i)->toArray();
        }
        $data['cuentas']['egresos'] = $array2;
        unset($array);

        $this->load->view('backend/ViewFlujoCajaList',$data);
    }
    
    public function printPDF(){
        unset($this->layout);
        $data['base_url']       =   base_url();
        $data['title']          =   $this->title;
        $data['category_title'] =   'Flujo de Caja';
        $data['page']           =   'tesoreria';
        
        $ms                     = date('m');
        $data['hasta']          = $ms*1-1;
        $data['desde']          = $ms*1-6;
        $data['fecha']          = date('Y-m',strtotime(date('Y-m')." -5 month"));
        $data['meses']          = array(
                        'enero','febrero','marzo','abril','mayo','junio','julio',
                        'agosto','septiembre','octubre','noviembre','diciembre');

        $this->load->model('listado');
        $oListado = new $this->listado();

        $oListado->listarCuentas(1);
        $array  =   array();
        for($i = 0; $i < $oListado->count(); $i++){
            $array[$i] = $oListado->get($i)->toArray();
        }
        $data['cuentas']['ingresos'] = $array;
        $oListado->limpiar();
        unset($array);

        $oListado->listarCuentas(0);
        $array2  =   array();
        for($i = 0; $i < $oListado->count(); $i++){
            $array2[$i] = $oListado->get($i)->toArray();
        }
        $data['cuentas']['egresos'] = $array2;
        unset($array);
        $this->load->view("backend/ViewFlujoCajaPrint",$data);
    }
    
    public function toPdf(){
        unset($this->layout);
        
        $data['base_url']       =   base_url();
        $data['title']          =   $this->title;
        $data['category_title'] =   'Flujo de Caja';
        $data['page']           =   'tesoreria';
        
        $ms                     = date('m');
        $data['hasta']          = $ms*1-1;
        $data['desde']          = $ms*1-6;
        $data['fecha']          = date('Y-m',strtotime(date('Y-m')." -5 month"));
        $data['meses']          = array(
                        'enero','febrero','marzo','abril','mayo','junio','julio',
                        'agosto','septiembre','octubre','noviembre','diciembre');
        
        $this->load->model('listado');
        $oListado = new $this->listado();
        
        $oListado->listarCuentas(1);
        $array  =   array();
        for($i = 0; $i < $oListado->count(); $i++){
            $array[$i] = $oListado->get($i)->toArray();
        }
        $data['cuentas']['ingresos'] = $array;
        $oListado->limpiar();
        unset($array);

        $oListado->listarCuentas(0);
        $array2  =   array();
        for($i = 0; $i < $oListado->count(); $i++){
            $array2[$i] = $oListado->get($i)->toArray();
        }
        $data['cuentas']['egresos'] = $array2;
        unset($array);
        
        $this->load->helper(array('dompdf', 'file'));
        
        // page info here, db calls, etc.     */
        $html = $this->load->view('backend/ViewFlujoCajaPrint', $data, true);
        
        
        pdf_create($html, 'flujoDeCaja');
        echo $html;
    }
    
    
    public function apiWeb2Pdf(){
        
        $html = $this->toPdf();
        echo $html;
        return;
        $postdata =  array('OutputFileName' => 'FlujoDeCaja.pdf', 'ApiKey' => '258596886', 'CUrl'=>$html, 'PrintType '=>FALSE);
        
        $curl_handle = curl_init('http://do.convertapi.com/Web2Pdf');
        
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_HEADER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $postdata);
        
        $buffer = curl_exec($curl_handle);
        $headers= curl_getinfo($curl_handle);
        
        $header=$this->ParseHeader(substr($buffer,0,$headers["header_size"]));
        $body=substr($buffer, $headers["header_size"]);
        curl_close($curl_handle);
        
        header('Content-type: ' . $headers['content_type']);
        header('Content-Length: '.strlen($body));
        header('Content-Disposition: attachment; filename="FlujoDeCaja.pdf"');
        echo $body;
        //echo $buffer;
    }
    
    function ParseHeader($header=''){
	$resArr = array();
	$headerArr = explode("\n",$header);
	foreach ($headerArr as $key => $value) {
	$tmpArr=explode(": ",$value);
	if (count($tmpArr)<1) continue;
	$resArr = array_merge($resArr, array($tmpArr[0] => count($tmpArr) < 2 ? "" : $tmpArr[1]));
	}
	return $resArr;
        }
}
?>