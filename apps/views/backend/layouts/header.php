<script>
    $(document).ready(function(){
        
        var html = $("#popover-content").html();
        
        $("#user-info").popover({
            trigger:"click",
            html : true,
            content: html
        });
    });
</script>

<div style="display:none" id="popover-content">
    <div id="user-popover">
        <div><label>User:</label> <?php echo $this->session->userdata("userBo_nombre"); ?></div>
        <div><label>Perfil:</label> <?php echo $this->session->userdata("userBo_type"); ?></div>
        <div><label>Temporada:</label> <?php echo $this->session->userdata("userBo_temporada");?></div>
        <div><label>Ultima Visita:</label> <?php echo $this->session->userdata("userBo_last_login");?></div>
        <hr/>
        <div><a href="javascript:void(0);">Modificar Perfil</a></div>
    </div>
</div>

<figure id="logo_club">
    <img src="<?php echo base_url();?>/images/logo-rejassur.png" alt="Conquistadores Rejas Sur" title="Conquistadores Rejas Sur"    />    
</figure>

<div id="tools">
    <div id="link">      
        <a class="glyphicon glyphicon-user"
           id="user-info"           
           data-container="#tools"
           data-toggle="popover"
           data-placement="auto"
           href="javascript:void(0);"
           title="Perfil de Usuario"
        ></a>
        <a class='glyphicon glyphicon-dashboard' title="Dashboard" href="/bo/home"></a> 
        <a class="glyphicon glyphicon-fullscreen" href="/" target="_blank" title="Ver sitio web"></a>
        <a class="glyphicon glyphicon-cog" href="/" target="_blank" title="Configuración"></a>
        <a class='glyphicon glyphicon-off' href="<?php echo base_url();?>admin/logout" title="Cerrar Sesion"></a>
    </div>
    
    <div id="relog"></div>
</div>
<a id="header-pin" href="javascript:;">pinh</a>