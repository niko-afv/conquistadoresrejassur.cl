<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends CI_Controller {
	
	var $data;
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}
	
	public function index(){
		redirect('bo');
	}
	
	public function file(){
		
	}
	
    public function image(){
		unset($this->layout);
		$responsePath = IMAGE;	
		#---------- Recepcion de variables Imagen
		$image['path'] 	 =	$this->input->post('path',true);
		$image['types']  =  $this->input->post('types',true);
		$image['size'] 	 =  $this->input->post('size',true);
		$image['width']  =  $this->input->post('width',true);
		$image['height'] =  $this->input->post('height',true);
		
		#----- Recepcion variables thumbnail			
		$image['thumb'] =  $this->input->post('thumb',true);		
		
		#---------- Limpiar nombre de imagen de caracteres no validos						
		$search  = array('Á', 'É', 'Í', 'Ó', 'Ú', 'á', 'é', 'í', 'ó', 'ú', 'Ü', 'ü', 'Ñ', 'ñ', ' ', ' ',"'",'´'); 
   		$replace = array('A', 'E', 'I', 'O', 'U', 'a', 'e', 'i', 'o', 'u', 'U', 'u', 'N', 'n', '_', '-', '', '');
		$fileName = str_replace($search, $replace,$_FILES['userfile']['name']);
		
		#---------- Asignacion de nombre random (primeros 5 caracteres)		
		$_FILES['userfile']['name'] =  RANDOM_NAME.$fileName;	
			
		#---------- Revision de dimension de imagenes
		list($withImage, $heightImage) = getimagesize($_FILES['userfile']['tmp_name']);
		if($withImage!=$image['width'] || $heightImage!=$image['height']){
			/*[E][IMAGE_ZIZE]*/
			$responseError[] = 'La imagen no cumple con el dimensiones '.$image['width'].' x '.$image['height'];	
		}
		#---------- Revision de tamaño de imagen
        $config['max_size'] = $image['size'];
				
		#---------- Asignacion y creacion de carpeta
		if($image['path']){
			$responsePath .= $image['path'].'/'; 
			$realPath = IMAGE_PATH.$image['path'].'/'; 
			$config['upload_path'] = $realPath;	
		}else{
        	$config['upload_path'] = $realPath = IMAGE_PATH;
		}
		#-------- revisar si el path existe sino crearlo con permisos
		
		if(!is_dir($realPath)){	
			mkdir($realPath, 0777, false);
			chmod($realPath, 0777);
		}
		#---------- Asignacion extensiones permitidas
        $config['allowed_types'] = str_replace(',','|',$image['types']);		
		
		#--------- Cargando parametros en la librería
        $this->load->library('upload',$config);
		
		if(!$this->upload->do_upload('userfile')){		
			/*[E][UPLOAD CLASS RESPONSE ERROR]*/	
			$responseError[] = $this->upload->display_errors();
		}
		#-------------------------------------------------------
		#----------------- CREATE THUMBNAIL --------------------	
		#-------------------------------------------------------	
		if($image['thumb']){
			
			#---  Revisar dimensiones de los thumb y crear array para armarlos
			$arrThumbnails = explode(',',$image['thumb']);
			foreach($arrThumbnails as $k => $thumbs){
				if($k==0)$firstThumbsPath = $thumbs.'/';
				list($wis,$hes) = explode('x',$thumbs);				
				$arrWidth[$wis] = $hes; 				
			}
			#--- Variable de retorno con thumbnail a mostrar en backoffice
			$responsePath .= 'thumb/'; 
			$responsePath .= $firstThumbsPath;
			$realthumbPath = $config['upload_path'].'thumb/'; 		
			
			#--- Crear directorio de thumbnails
			if(!is_dir($realthumbPath)){	
				mkdir($realthumbPath, 0777, false);
				chmod($realthumbPath, 0777);
			}
			#---  Create thumbs		
			foreach($arrWidth as $w => $h){
				
				$thumb['image_library'] = 'gd2';
				$thumb['source_image'] = $config['upload_path'].$this->upload->file_name;
				$thumb['create_thumb'] = TRUE;
				$thumb['thumb_marker'] = '';			
				$thumb['maintain_ratio'] = FALSE;
				$thumbPaths = $realthumbPath.$w.'x'.$h.'/';
				
				#--- Creacion directorios por medida de thumbnails
				if(!is_dir($thumbPaths)){	
					mkdir($thumbPaths, 0777);
					chmod($thumbPaths, 0777);
				}
				
				#-- Configuracion de directorio y medidas para los thumbnails
				$thumb['new_image'] = $thumbPaths;
				$thumb['width'] = $w;
				$thumb['height'] = $h;
				
				$this->load->library('image_lib', $thumb); 
				$this->image_lib->initialize($thumb);
				if(!$this->image_lib->resize()){
					/*[E][THUMBNAIL CLASS RESPONSE ERROR]*/
					$responseError[]= $this->image_lib->display_errors();
				}
				$this->image_lib->clear();
			}
		}		
		#-------------------------------------------------------	
		#-------------------------------------------------------	
		#-------------------------------------------------------	
				
		if(empty($responseError)){	
			$er = 'ok,';
		}else{
			$er = strip_tags($responseError[0]).',';
		}
		$data = array('content'=>$er.$responsePath.$this->upload->file_name);
		$this->load->view('ajax',$data);
		
		
    }  
	public function delete(){
        	unset($this->layout);
        	$img = $this->input->post('img',true);
							
 			$all =  explode('/',$img);
			$co =   count($all);
			$imageDelete = end($all);					
			
			if($all[$co-4]=='images'){
				$pathDeleteThumbs = IMAGE_PATH.'thumb/';
				$pathDeleteImage = IMAGE_PATH;
			}else{
				$pathDeleteImage = IMAGE_PATH.$all[$co-4].'/';
				$pathDeleteThumbs = IMAGE_PATH.$all[$co-4].'/thumb/';
			}
			$delete = false;
			$carpeta = opendir($pathDeleteThumbs);
			while($subFolders = readdir($carpeta)){		
				if ($subFolders !='.' && $subFolders !='..' ){
					@unlink($pathDeleteThumbs.$subFolders.'/'.$imageDelete);
				}		
			}
			$delete = @unlink($pathDeleteImage.$imageDelete);
			$data = array('content' => $delete);			
			$this->load->view('ajax',$data);
	}
}