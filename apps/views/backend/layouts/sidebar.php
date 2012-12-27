<?php 
# Segmentacion en el mismo controlador
$arrSameControler = array('listas_formularios'); #define controlador para tomar funciones del mismo
$page = in_array($this->uri->segments[2],$arrSameControler)?$this->uri->segments[3]:$this->uri->segments[2];
?>

<ul>
  <li><span><strong>Menú Administrador</strong></span></li>
</ul>
<ul>
  <li> <span <?php echo $page == 'oooo'?'class="current"':'';?>><a href="javascript:;">Administradores</a></span>
    <ul>
      <li><a href="javascript:;">Lista Usuarios</a></li>
      <li><a href="javascript:;">Nuevo Usuarios</a></li>
    </ul>
  </li>
  <li> <span <?php echo $page == 'oooo'?'class="current"':'';?>><a href="javascript:;">Proyectos</a></span>
    <ul>
      <li><a href="javascript:;">Listar</a></li>
    </ul>
  </li>
</ul>
<a id="sidebar-pin" href="javascript:;">pinv</a>