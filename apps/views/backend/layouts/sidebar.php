<?php 
# Segmentacion en el mismo controlador
//$arrSameControler = array('listas_formularios'); #define controlador para tomar funciones del mismo
//$page = in_array($this->uri->segments[2],$arrSameControler)?$this->uri->segments[3]:$this->uri->segments[2];

?>

<ul>
    <li><span><strong>Menú Administrador</strong></span></li>
</ul>
<ul>
    <li> <span <?php echo $page == 'integrantes'?'class="current"':'';?>><a href="javascript:;">Integrantes</a></span>
        <ul>
            <li><i class='icon-list'></i> &nbsp; <a href="<? echo $base_url;?>admin/integrantes_list/">Listar Integrantes</a></li>
            <li><i class='icon-plus'></i> &nbsp; <a href="<? echo $base_url;?>admin/integrantes_form/">Nuevo Integrante</a></li>
        </ul>
    </li>
    <li> <span <?php echo $page == 'unidades'?'class="current"':'';?>><a href="javascript:;">Unidades</a></span>
        <ul>
            <li><i class='icon-list'></i> &nbsp; <a href="<? echo $base_url;?>admin/unidades_list/">Listar Unidades</a></li>
            <li><i class='icon-plus'></i> &nbsp; <a href="<? echo $base_url;?>admin/unidades_form/">Nueva Unidad</a></li>
            <li><i class='icon-user'></i> &nbsp; <a href="<? echo $base_url;?>admin/agregar_integrantes/">Añadir a Unidad</a></li>
        </ul>
    </li>
    
    <li> <span <?php echo $page == 'tesoreria'?'class="current"':'';?>><a href="javascript:;">Tesoreria</a></span>
        <ul>
            <li><i class='icon-th'></i> &nbsp; <a href="<? echo $base_url;?>admin/flujo_caja/">Ver Resumen</a></li>
            <li><i class='icon-plus'></i> &nbsp; <a href="<? echo $base_url;?>admin/flujo_caja_form/">Nuevo Flujo</a></li>
        </ul>
    </li>
    <li> <span <?php echo $page == 'plantillas'?'class="current"':'';?>><a href="javascript:;">Listados</a></span>
        <ul>
            <li><i class='icon-plus-sign'></i> &nbsp; <a href="<? echo $base_url;?>admin/plantillas_list">Crear Listado</a></li>
            <li><i class='icon-plus'></i> &nbsp; <a href="<? echo $base_url;?>admin/plantillas_form">Nueva Plantilla</a></li>
        </ul>
    </li>
</ul>
<a id="sidebar-pin" href="javascript:;">pinv</a>