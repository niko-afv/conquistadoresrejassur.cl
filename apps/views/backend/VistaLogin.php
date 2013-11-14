<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>bo</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo base_url();?>css/login.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.8.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.functions.js"></script>
<script type="text/javascript">
<!--

$(document).ready(function(){
        <?php if($msg){echo 'msg("'.$msg.'");';} ?>
	$("input[name='username']").focus();
});

function ckFormLogin(){	
	if($('[name=user]').val()!='' && $('[name=password]').val()!=''){
		formLogin.submit();
	}else{
		msg('Debe Ingresar Usuario y Clave');
	}
}
-->	
</script>
</head>
<body>
    <div id="login">
        <?php 
            echo validation_errors();			
            $attributes = array('name' => 'formLogin', 'autocomplete' => 'off');
            echo form_open('index.php/admin/login/login', $attributes);
            # User field
            echo form_label('User');
            echo form_input(array('name'=>'username','size'=>'10','maxlenght'=>'10','onkeypress'=>'return IsNombre(event);'));
            # Password field
            echo form_label('Password');
            echo form_password(array('name'=>'password','size'=>'10','maxlenght'=>'10'));
            echo form_close();
        ?>
          <a href="javascript:;" onclick="ckFormLogin()">Enviar</a>
        <div class="clear"></div>
    </div>
    <div id="error">
        <?php   if($this->session->flashdata('msg')){
                    echo $this->session->flashdata('msg');
                }
        ?>
    </div>
</body>
</html>