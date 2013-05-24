<!--<figure id="logo_club">
    <img src="<?php echo base_url();?>/images/logo_club.png" alt="Conquistadores Rejas Sur" title="Conquistadores Rejas Sur" width="100" height="100"    />    
</figure>-->

<div id="tools">
  <div id="link">
  <strong><?php echo $this->session->userdata("userBo_nombre"); ?></strong>
  &bull; <a href="/bo/home" >Escritorio</a> 
  &bull; <a href="/" target="_blank">Ver sitio web</a> 
  &bull; <a href="<?php echo base_url();?>admin/logout">Cerrar Sesión</a></div>
  <div id="relog"></div>
</div>
<a id="header-pin" href="javascript:;">pinh</a>