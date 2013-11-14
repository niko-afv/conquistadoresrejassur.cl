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
            <li><i class='icon-list'></i> &nbsp; <a href="<? echo $base_url;?>admin/integrantes_list/">Listar</a></li>
            <li><i class='icon-plus'></i> &nbsp; <a href="<? echo $base_url;?>admin/integrantes_form/">Nuevo</a></li>
        </ul>
    </li>
    <li> <span <?php echo $page == 'unidades'?'class="current"':'';?>><a href="javascript:;">Unidades</a></span>
        <ul>
            <li><i class='icon-list'></i> &nbsp; <a href="<? echo $base_url;?>admin/unidades_list/">Listar</a></li>
            <li><i class='icon-plus'></i> &nbsp; <a href="<? echo $base_url;?>admin/unidades_form/">Nuevo</a></li>
            <li><i class='icon-plus'></i> &nbsp; <a href="<? echo $base_url;?>admin/agregar_integrantes/">Agregar Integrantes</a></li>
        </ul>
    </li>
    
    <li> <span <?php echo $page == 'tesoreria'?'class="current"':'';?>><a href="javascript:;">Tesoreria</a></span>
        <ul>
            <li><i class='icon-list'></i> &nbsp; <a href="<? echo $base_url;?>admin/flujo_caja/">Flujo de Caja</a></li>
            <li><i class='icon-plus'></i> &nbsp; <a href="<? echo $base_url;?>admin/flujo_caja_form/">Nuevo Movimiento</a></li>
        </ul>
    </li>
</ul>
<a id="sidebar-pin" href="javascript:;">pinv</a>