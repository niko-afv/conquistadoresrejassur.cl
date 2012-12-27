<?php
if($content){
	$type = isset($type)?$type:'';
	switch($type){
		case 'dump':
			echo var_dump($content);
		break;
		case 'json':
			echo json_encode($content);
		break;
		default:
			echo $content;
		break;	
	}
}
?>
