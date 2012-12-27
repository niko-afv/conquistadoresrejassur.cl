<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* CodeIgniter   Pm Class
*
* @author		Pedro Montero A.
* @copyright	Copyright (c) 2012.
* @since		Version 1.0
* @filesource
*
**/
class pm{
	
	protected $ci 	= array();
	/*private   $user = array();
	private   $val  = '';*/
	
	public function __construct(){
		 $this->ci =& get_instance();
		 //$this->ci->load->model('md_bo');
	}	
	public function urlAmigable($str) { 
	
		$search = array('&lt;', '&gt;', '&quot;', '&amp;');     
		$str    = str_replace($search, '', $str);		 
		$search = array('&aacute;','&Aacute;','&eacute;','&Eacute;',
						'&iacute;','&Iacute;','&oacute;','&Oacute;',
						'&uacute;','&Uacute;','&ntilde;','&Ntilde;'); 
		$replace = array('a','a','e','e','i','i','o','o','u','u','n','n');		 
		$search  = array('Á', 'É', 'Í', 'Ó', 'Ú', 'á', 'é', 'í', 'ó', 'ú', 'Ü', 'ü', 'Ñ', 'ñ', '_', '-'); 
		$replace = array('a', 'e', 'i', 'o', 'u', 'a', 'e', 'i', 'o', 'u', 'u', 'u', 'n', 'n', ' ', ' '); 
		 
		$str = str_replace($search, $replace, $str); 		 
		$str = preg_replace('/&(?!#[0-9]+;)/s', '', $str);
	
		$search = array(' a ', ' ante ', ' para ', ' con ', 
						' contra ', ' por ', ' entre ', ' en ', 
						' sobre ', ' bajo ', ' y ', ' e ', ' o ', 
						' u ','aquel ', ' la ', ' el ', ' lo ', ' las '); 	
		$str = str_replace($search, ' ', strtolower($str)); 	
		$str = str_replace($search, $replace, strtolower(trim($str))); 
		 
		$str = preg_replace("/[^a-zA-Z0-9\s]/", '', $str); 
		$str = preg_replace('/\s\s+/', ' ', $str); 
		$str = str_replace(' ', '-', $str); 
	
		return  $str; 
	}
	
	public function fecha($fecha){
		$a = substr($fecha, 0, 4);
		$m = substr($fecha, 5, 2);
		$d = substr($fecha, 8, 2);	
		return $d."/".$m."/".$a;
	}
	
	public function hora($fecha){
		$h = substr($fecha, 11, 2);
		$m = substr($fecha, 14, 2);
		return $h.":".$m;
	}	
	public function corte($texto,$largo){
		$salida = '';
		if (trim($texto) != ''){
			$texto2 = str_replace("\r"," ",$texto);
			$texto2 = str_replace("\n"," ",$texto2);
			$atexto = explode(". ",$texto2);
			$salida = $atexto[0];
		}
		if (strlen($salida) > $largo || strlen($salida) == 0){
			$atexto = explode(" ",$texto);
			$salida = '';
			$espacio = '';
			for ($x=0;$x<count($atexto);$x++) {
				$salida .= $espacio . $atexto[$x];
				$espacio = ' ';
				if (strlen($salida) > $largo){
					$salida .= '...';
					$x = count($atexto) + 10;
				}
			}
		}
		return $salida;
	}
	#--------------------------------------------------------
	

	public function SubirArchivo($campo,$carpeta,$exts = "jpg,jpeg,gif,png", $nombreArchivo = ''){
		//damos el archivo
		$newFile = $_FILES[$campo]['name'];
		//validamos extencion
		if ($_FILES[$campo]['name'] != ""){
			$ext = strtolower(substr(strrchr($newFile, "."), 1));
			if (ereg($ext,$exts)){
				//damos el archivo temporal (importante) es el que moveremos con move_uploaded_file
				$tmp_name = $_FILES[$campo]['tmp_name'];
				//el archivo con su ruta
				if (trim($nombreArchivo) == ''){
					#$newFile = preg_replace('/[^a-zA-Z0-9_.\-]/i','',$newFile);
					$newFile = preg_replace('/[^a-zA-Z0-9_.,:;@áéíóúñ\s\-]]/i','',$newFile);
					$arrAcentosA = array("á","é","í","ó","ú","ñ"," ");
					$arrAcentosB = array("a","e","i","o","u","n","_");
					for($i=0; $i < count($arrAcentosA); $i++){
						$newFile = str_replace($arrAcentosA[$i],$arrAcentosB[$i],$newFile);
					}
					$newFile = strtolower(substr(md5(rand() * time()),5, 5) . $newFile);
				}else{
					$newFile = $nombreArchivo .".". $ext;
				}
				
				$uploadFile = $carpeta . $newFile;
				//movemos la imagen upload
				move_uploaded_file($tmp_name, $uploadFile);
				//resultado
				return array('file' => $newFile, 'error' => 'ok');
			}else{
				return array('file' => '', 'error' => 'Error de Formato: '.$ext.'');
			}
		}else{
			return array('file' => '', 'error' => 'Error de Archivo vacio');
		}
	}
	
	#=============================================================#
	
	public function CrearThumbnail($original,$carpeta,$prefijo,$ancho,$alto){
		
		$er = '';
		$ext = strtolower(substr(strrchr($original, "."), 1));
		if (file_exists($carpeta.$original) && ( $ext=="jpg" || $ext=="jpeg"  || $ext=="gif" || $ext=="png" )){
			$xFile = 0;
			$yFile = 0;
			$newAncho = $ancho;
			$newAlto  = $alto;
			$datos = getimagesize($carpeta.$original);
			$widthFile  = $datos[0];
			$heightFile = $datos[1];
			$crear = 0;
			//=======================================================//
			if( $ancho > $widthFile){ $er = 'La imagen no cumple con el ancho minimo solicitado ('. $ancho .'px)'; }
			if( $alto > $heightFile){ $er = 'La imagen no cumple con el alto minimo solicitado ('. $alto .'px)'; }
			if( $alto > $heightFile &&  $ancho > $widthFile ){ $er = 'La imagen no cumple con las medidas solicitadas ('. $ancho .'px X '. $alto .'px)'; }
			
			if ($er == ''){
			//=======================================================//
				if ($widthFile >= $heightFile){
					//=======================================================//
					$newAncho = $ancho;
					$newAlto = round( ($ancho * $heightFile) / $widthFile);
					if ($alto > 0){
						if($newAlto >= $alto){
							$yFile = round(($newAlto - $alto)/2);
						}else{
							$newAncho = round( ( $alto * $widthFile ) / $heightFile );
							$newAlto = $alto;
							$xFile = round( ( $newAncho - $ancho ) / 2 );
							$yFile = 0;
						}
					}else{
						$alto = $newAlto;
					}
					$crear = 1;
					//=======================================================//
				}else{
					//=======================================================//
					$newAncho = round( ( $alto * $widthFile ) / $heightFile );
					$newAlto = $alto;
					if ($ancho > 0){
						if($newAncho >= $ancho){
							$xFile = round( ( $newAncho - $ancho ) / 2 );
						}else{
							$newAncho = $ancho;
							$newAlto = round(($ancho * $heightFile) / $widthFile);
							$xFile = 0;
							$yFile = round(($newAlto - $alto)/2);
						}
					}else{
						$ancho = $newAncho;
					}
					$crear = 1;
					//=======================================================//
				}
			//=======================================================// 
			}
			//=======================================================//
			if ($crear == 1){
				//=======================================================//
				//ruta y nombre para la thumbnail
				$UploadThumbFile =  $carpeta . $prefijo . $original;
				//Creo imagen thumbnail
				if ($ext =="jpg" || $ext =="jpeg") $imagen_thumb = imagecreatefromjpeg($carpeta . $original);
				if ($ext =="gif") $imagen_thumb = imagecreatefromgif($carpeta . $original);
				if ($ext =="png") $imagen_thumb = imagecreatefrompng($carpeta . $original);
				// Creamos una imagen vacia
				$thumb = imagecreatetruecolor($ancho,$alto);
				// Copiamos la thumbnail image a la imagen creada
				imagecopyresampled($thumb,$imagen_thumb,0,0,$xFile,$yFile,$newAncho,$newAlto,$widthFile,$heightFile);
				//damos salida a la imagen thumbnail creada y copiada.
				if ($ext=="jpg" || $ext=="jpeg") imagejpeg($thumb, $UploadThumbFile, 100);
				if ($ext=="gif") imagegif($thumb, $UploadThumbFile);
				if ($ext=="png") imagepng($thumb, $UploadThumbFile, 9);
				// Free from memory
				imagedestroy($thumb);
				//salida
				return array('file' => $prefijo . $original, 'error' => 'ok');
				//=======================================================//
			}else{
				return array('file' => '', 'error' => $er);
			}
		}else{
			return array('file' => '', 'error' => 'Error de archivo o formato no valido');
		}
	}
	public function googleLightbox($w,$h){
		$dominio = "google.";
		if (ereg($dominio,$_SERVER['HTTP_REFERER'])){
			$_SESSION[session_id()."-url"] = "$.fn.colorbox({href:'". $_SERVER['REQUEST_URI'] ."',width:'". $w ."px', height:'". $h ."px', iframe:true});";
			header("Location: /club/");
		}
	}
	
	public function fechaValida($fecha){
			
		if($fecha=="dd-mm-aaaa" || $fecha=="00-00-0000"){
			return true;	
		}
		
		$largo = strlen($fecha);
		
		$dia = (1 * substr($fecha,0,2));
		$mes = (1 * substr($fecha,3,2));
		$ano = (1 * substr($fecha,6,4));
			
		$separador1 = substr($fecha,2,1);
		$separador2 = substr($fecha,5,1);
		
		if($largo != 10){
			return false;	
		}
		elseif($dia < 0 || $dia > 31 || $mes < 0 || $mes > 12 || $ano < 1900 || $ano > date('Y') ){
			return false;	
		}
		elseif( ($separador1 != "-" and $separador1 != "/") || ($separador2 != "-" and $separador2 != "/") ){
			return false;
		}
		
		return true;
	}
	
	public function valida_fecha_hora(){
		if(strtotime(date('d/m/Y H:i'))>strtotime('21/12/2010 09:00') and strtotime(date('d/m/Y H:i'))<strtotime('21/12/2010 21:00')){
			return true;
		}else{
			return false;
		}
	}
	public function dateadd($date, $dia=0, $mes=0, $anio=0, $hora=0, $min=0, $seg=0){// dia, mes, año, hora, min, seg
		$fecha_op    = mktime((substr($date,11,2)+$hora),
							(substr($date,14,2)+$min),
							(substr($date,17,2)+$seg),
							(substr($date,5,2)+$mes),
							(substr($date,8,2)+$dia),
							(substr($date,0,4)+$anio));
		$date_result = date("Y-m-d H:i:s",$fecha_op); // solo le da formato
		return $date_result;
	}
	
	#------------------ FINANCIEROS
	
	public function redondeado ($numero, $decimales){
	   $factor = pow(10, $decimales);
	   return (round($numero*$factor)/$factor); 
	} 
	
	public function PmtValor($VP, $i, $n){
		return $VP*((pow(1+$i,$n) * $i)/(pow(1+$i,$n)-1));
	}

	public function redondear_dos_decimal($valor) {
	   $float_redondeado=round($valor * 100) / 100;
	   return $float_redondeado;
	}
	
	public function calcularDividendo($capital_pesos, $pie_pesos, $plazo_agnos, $tasa_anual, $uf_valor, $tipo){
		$tasa_mensual    = pow(1 + ($tasa_anual / 100), (1 / 12)) - 1;		
		$plazo_meses     = $plazo_agnos * 12;		
		$tasa_mensual_1  = $tasa_mensual + 1;		
		$capital_tasa    = $capital_pesos / $tasa_mensual; 		
		$tasa_plazo      = pow($tasa_mensual_1, $plazo_meses);		
		$tasa_plazo_1    = $tasa_plazo - 1;		
		$tasa_division   = $tasa_plazo_1 / $tasa_plazo;		
		$tasa_multiplica = $tasa_division * $capital_tasa;
		return $tipo == "uf"? redondear_dos_decimal($tasa_multiplica / $uf_valor):round($tasa_multiplica);  
	}
	
	public function calcularCredito($capital_uf, $pie_uf, $plazo_agnos, $tasa_anual, $uf_valor, $tipo){
		$capital_pesos   = $capital_uf * $uf_valor;
		$pie_pesos       = $pie_uf * $uf_valor;
		$plazo_meses     = $plazo_agnos * 12;
		$tasa_mensual    = pow(1 + ($tasa_anual / 100), (1 / 12)) - 1;	
		$credito_uf      = $capital_uf - $pie_uf;
		$credito_pesos   = $credito_uf * $uf_valor;		
		$desgra_uf       = 0;
		$incendio_uf     = 0;
		$cesantia_uf     = 0;		
		$desgra_pesos    = $desgra_uf * $uf_valor;
		$incendio_pesos  = $incendio_uf * $uf_valor;
		$cesantia_pesos  = $cesantia_uf * $uf_valor;
		$pmt_pesos       = PmtValor(round($capital_pesos -  $pie_pesos), $tasa_mensual, $plazo_meses);
		$pmt_uf          = $pmt_pesos / $uf_valor;
		$dividendo_uf    = $pmt_uf + $desgra_uf + $incendio_uf + $cesantia_uf;
		$dividendo_pesos = $pmt_pesos + $desgra_pesos + $incendio_pesos + $cesantia_pesos;		
		return $tipo == "uf"?$dividendo_uf :round($dividendo_pesos);  
	}
	
	public function calculoBasicoDividendo($valorTotal){
	   
	   $sqlD = "select top 1 porcentaje_pie, tasa, agnos from tbl_param_financiamiento";
		$resD = dbQuery($sqlD,$conector);
		$rsD  = dbFetchAssoc($resD);
		$valorUf = obtenerUF();
		$plazoAnos = $rsD['agnos'];
		$tasaInteres = $rsD['tasa'];
		$pie = (($valorTotal * (round($rsD['porcentaje_pie']*100))) / 100); // 10% del valor
		// echo '<br>'.$rsD['agnos'].'===='.$rsD['tasa'].'===='.(round($rsD['porcentaje_pie']*100)).'<br>';
	   
		return calcularCredito($valorTotal, $pie, $plazoAnos, $tasaInteres, $valorUf, "pesos");
	}
	
	
	public function calcularCreditoMaximo($dividendo,$plazoAnos,$tasaInteres,$retorno='uf'){
		$uf = obtenerUF();
		return calcularDividendo($dividendo, 0, $plazoAnos, $tasaInteres, $uf, $retorno);
			//   calcularDividendo($capital_pesos, $pie_pesos, $plazo_agnos, $tasa_anual, $uf_valor, $tipo)
	}	
	
	public function obtieneValorUf(){
		
		$indicadores = simplexml_load_file('http://www.fusiona.cl/indicadores/indicadores.xml');
		$uf = number_format($indicadores->indicador[0]->valor, 2, '.', '');
		return ($uf);
	
	}
}
