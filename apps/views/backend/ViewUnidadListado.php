<div id="error2" style="display: none">
    <div></div>
</div>
<div id="success2" style="display: none">
    <div></div>
</div>
<table class='table table-hover table-bordered table-condensed'>
    <thead>
    <tr class="form-title">
        <th>Nombre</th>
        <th>Fundado</th>
        <th>Integrantes</th>
        <th>Estado</th>
        <th>&nbsp;</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($unidades as $item => $val){?>
        <?php $estado = ($val['estado'] == 1)?'activo':'no activo'?>
        <tr id="<?php echo $val['id']; ?>">
            <td class='name'><?php echo $val['nombre']; ?></td>
            <td><?php echo $val['fundado']; ?></td>
            <td><?php //echo $val['integrantes']; ?></td>
            <td><?php echo $estado; ?></td>
            <td>
                <a href="<?php echo $base_url . '/admin/unidades_form/modificar/' . $val['id'];?>"><i class='icon-edit'></i></a>
                &nbsp;
                <a class="delete-unidad" href='<?php echo $base_url . "/admin/unidades_list/eliminar/" . $val['id']; ?>'><i class='icon-trash'></i></a>

            </td>
        </tr>
    <?php }?>
    </tbody>
</table>

<div class="clear"></div>