<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * type  Hooks
 * class CI Layout   
 * code  Pedro Montero
 * date  05/2012
 */ 
 
class Layout extends CI_Hooks{
	
	public function index(){
		
        global $OUT;
		global $parentPath;
		
        $CI =& get_instance();
		 
        // get default output generated by CI
        $output = $CI->output->get_output();
		
		// get first path in view folder		
		$parentPath = explode('/',$CI->router->directory);
			
		if(isset($CI->layout) && !empty($CI->layout)){
			
			$baseName = $layoutIn = $layoutPt = '';	
			$baseName = $CI->layout['base'];		
			
			$baseContent = str_replace($baseName,'content',$baseName);
			
			if(count($CI->layout)){	
				// charge component of layout (meta, header, footer) in array 			
				foreach($CI->layout as $incFile){
					
					// include extension if not bring
					if (!preg_match('/(.+).php$/', $incFile))$incFile .= '.php';
					
					// this will be the requested layout
					$requested  = APPPATH . 'views/'.$parentPath[0].'/layouts/' . $incFile;
					
					// recover name for create key array
					$incFile =  str_replace('.php','',$incFile);
					
					// check te files of components exists		
					if (file_exists($requested)){
						$layoutPt = $CI->load->file($requested, true);
						$arrayAux [$incFile] = $layoutPt;
						
					}else{
						// some potential file errors								
						if($incFile == '.php'){							
							die('Error, check set layout<br>');							
						}else{							
							die("Error, file  <b>'".$incFile."'</b> doesn't exist <br>");
						}
					}						
				}				
				// charge base layout 
				$default  = APPPATH . 'views/'.$parentPath[0].'/layouts/'.$baseName.'.php';				
				
				if (file_exists($default)){
					$layoutBase = $CI->load->file($default, true);
					
					// charge components in base layout					
					foreach($arrayAux as $name => $components){
						
						$layoutBase = str_replace('{'.$name.'}', $components, $layoutBase);		
					}
					
				}else{
					die("Error, file <b>'".$baseName."'</b> doesn't exist<br>");
				}				
				// finaly charge ouput in base layout 
				$view = str_replace('{'.$baseContent.'}', $output, $layoutBase);
				
			}else{
				
				if(!is_array($CI->layout)){
					die("Error, array component doesn't exist<br>");
				}
				if(!empty($baseName)){				
					$default  = APPPATH . 'views/'.$parentPath[0].'/layouts/'.$baseName.'.php';	
					if (file_exists($default)){
						$layoutBase = $CI->load->file($default, true);
						$view = str_replace('{'.$baseContent.'}', $output, $layoutBase);	
					}else{
						die("Error, file <b>'".$baseName."'</b> doesn't exist<br>");
					}
				}else{				
					$view = $output;
				}				
			}
		}else{
			
			$view = $output;
		}	
       $OUT->_display($view);
    }
}