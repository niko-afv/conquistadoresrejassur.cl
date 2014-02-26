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
        <td>N°</td>
        <?php foreach($template['campos'] as $campo){?>
            <th><?php echo $campo['nombre'];?></th>
        <?php }?>
    </tr>
    </thead>
    <tbody>
    <?php $i=0;?>
    <?php foreach($entidad['lista'] as $item){?>
        <?php $i++;?>
        <tr id="">
            <td><?php echo $i;?></td>
            <?php foreach($template['campos'] as $campo){?>
                <td><?php if(isset($item[$campo['nombre']])){ echo $item[$campo['nombre']]; }else{ echo "<input type='text' placeholder='Ingrese un valor' style='width:110px !important;margin-bottom:0'  />";} ?></td>
            <?php }?>

            <!--<td>
                <a href="<?php echo $base_url . '/admin/plantillas_form/modificar/' . $val['id'];?>"><i class='icon-edit'></i></a>
                &nbsp;
                <a class="delete-reg" href='<?php echo $base_url . "/admin/plantillas_list/eliminar/" . $val['id']; ?>'><i class='icon-trash'></i></a>
                &nbsp;
                <a href='<?php echo $base_url . "/admin/listados_form/cargar/" . $val['id']; ?>'><i class='icon-list'></i></a>
            </td>-->
        </tr>
    <?php }?>
    </tbody> 
</table>

<a title="Descargar a PDF" style="float: right;" href="/admin/listados_form/toPdf/<?php echo $id;?>"><img alt="logo-pdf" src="/images/pdf-download-icon.png" /></a>

<div class="clear"></div>