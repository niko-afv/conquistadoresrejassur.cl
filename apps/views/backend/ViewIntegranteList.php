<div id="error2" class="alert alert-error" style="display: none;">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <div></div>
</div>

<div id="success2" class="alert alert-success" style="display: none;">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <div></div>
</div>

<table class='table table-hover table-bordered table-condensed'>
    <thead>
        <tr class="form-title">
            <th>N°</th>
            <th>Apellido</th>
            <th>Nombre</th>
            <th>Unidad</th>
            <th>Edad</th>
            <th>Cargo(s)</th>
            <th>Grado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    <?php $i=0;?>
    <?php foreach($integrantes as $item => $val){?>
        <?php $i++;?>
        <tr id="<?php echo $val['rut']; ?>">
            <td><?php echo $i;?></td>
            <td class='lastname'><?php echo $val['apellido']; ?></td>
            <td class='name'><?php echo $val['nombre']; ?></td>
            <td><?php echo $val['unidad']; ?></td>
            <td><?php echo $val['edad']; ?></td>
            <td><?php foreach ($val['cargos'] as $item => $cargo){echo "| " .$cargo . " | ";} ?></td>
            <td><?php echo $val['grado']; ?></td>
            <td>
                <a href="<?php echo $base_url . '/admin/integrantes_form/modificar/' . $val['rut'];?>" class='glyphicon glyphicon-edit'></a>
                &nbsp;
                <a class="delete-reg" href='<?php echo $base_url . "/admin/integrantes_list/eliminar/" . $val['rut']; ?>'><i class='glyphicon glyphicon-trash'></i></a>
                
            </td>
        </tr>
    <?php }?>
    </tbody>
</table>

<a title="Descargar a PDF" style="float: right;" href="toPdf"><img alt="logo-pdf" src="/images/pdf-download-icon.png" /></a>

<div class="clear"></div>
