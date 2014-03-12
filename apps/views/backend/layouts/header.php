<figure id="logo_club">
    <img src="<?php echo base_url();?>/images/logo-rejassur.png" alt="Conquistadores Rejas Sur" title="Conquistadores Rejas Sur"    />    
</figure>

<div id="tools">
  <div id="link">      
      <a class="glyphicon glyphicon-user" href="javascript:void(0);" title="Usuario: <?php echo $this->session->userdata("userBo_nombre"); ?>"></a>
    <a class='glyphicon glyphicon-dashboard' title="Dashboard" href="/bo/home"></a> 
    <a class="glyphicon glyphicon-fullscreen" href="/" target="_blank" title="Ver sitio web"></a> 
    <a class='glyphicon glyphicon-off' href="<?php echo base_url();?>admin/logout" title="Cerrar Sesion"></a>
  </div>
    
  <div id="relog"></div>
</div>
<a id="header-pin" href="javascript:;">pinh</a>