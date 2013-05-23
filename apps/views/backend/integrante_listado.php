<table class='table table-hover table-bordered table-condensed'>
    <thead>
        <tr class="form-title">
            <th>Rut</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Edad</th>
            <th>Cargo</th>
            <th>Grado</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($integrantes as $item => $val){?>
        <tr id="<?php echo $val['rut']; ?>">
            <td><?php echo $val['rut']; ?></td>
            <td class='name'><?php echo $val['nombre']; ?></td>
            <td class='lastname'><?php echo $val['apellido']; ?></td>
            <td><?php echo $val['edad']; ?></td>
            <td><?php echo $val['cargo']; ?></td>
            <td><?php echo $val['grado']; ?></td>
            <td>
                <a href="<?php echo $base_url . 'index.php/admin/integrantes_form/modificar/' . $val['rut'];?>"><i class='icon-edit'></i></a>
                &nbsp;
                <a class="delete-reg" href='<?php echo $base_url . "index.php/admin/integrantes_list/eliminar/" . $val['rut']; ?>'><i class='icon-trash'></i></a>
                
            </td>
        </tr>
    <?php }?>
    </tbody>
</table>

<div class="clear"></div>