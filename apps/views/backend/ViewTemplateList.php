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
            <th>Nombre</th>
            <th>Entidad</th>
            <th>Campos</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    <?php $i=0;?>
    <?php foreach($plantillas as $item => $val){?>
        <?php $i++;?>
        <tr id="<?php echo $val['id']; ?>">
            <td><?php echo $i;?></td>
            <td class='name'><?php echo $val['nombre']; ?></td>
            <td><?php echo $val['entidad']; ?></td>
            <td>
                <?php
                    foreach($val['campos'] as $campo => $val2){
                        echo " | ";
                        echo $val2;
                    }
                ?>
            </td>
            <td>
                <a href="<?php echo $base_url . '/admin/plantillas_form/modificar/' . $val['id'];?>"><i class='icon-edit'></i></a>
                &nbsp;
                <a class="delete-reg" href='<?php echo $base_url . "/admin/plantillas_list/eliminar/" . $val['id']; ?>'><i class='icon-trash'></i></a>
                &nbsp;
                <a href='<?php echo $base_url . "/admin/listados_form/" . $val['id']; ?>'><i class='icon-list'></i></a>
            </td>
        </tr>
    <?php }?>
    </tbody>
</table>
<div class="clear"></div>