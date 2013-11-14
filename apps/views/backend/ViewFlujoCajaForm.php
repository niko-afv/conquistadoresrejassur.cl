<div class="row-fluid">
    <div id="error2" class="hidden alert alert-error">
        <!--<span><i class='icon-remove-sign'></i></span>-->
        <button type="button" class="close" data-dismiss="alert">×</button>
        <div></div>
    </div>

    <form action="/admin/flujo_caja_form" method="POST">
        <div class="bo-form span5">
            <div class="form-title">
                Seleccione Cuenta
            </div>

            <div class="form-item">
                <label>Cuenta</label>
                <select name="cuenta">
                    <optgroup class="titulo" label="Ingresos">
                    </optgroup>
                    <?php foreach($cuentas['ingresos'] as $item => $val){?>
                    <optgroup label="<?php echo $val['nombre'];?>">
                        <?php foreach ($val['subCategorias'] as $item2 => $val2){?>
                            <option value="<?php echo $val2['id'];?>"><?php echo $val2['nombre'];?></option>
                        <?php }?>
                    </optgroup>
                    <?php }?>
                    
                    <optgroup class="titulo" label="Egresos">
                    </optgroup>
                    <?php foreach($cuentas['egresos'] as $item => $val){?>
                    <optgroup label="<?php echo $val['nombre'];?>">
                        <?php foreach ($val['subCategorias'] as $item2 => $val2){?>
                            <option value="<?php echo $val2['id'];?>"><?php echo $val2['nombre'];?></option>
                        <?php }?>
                    </optgroup>
                    <?php }?>
                </select>
                <?php echo form_error('cuenta');?>
            </div>
        </div>

        <div class="bo-form span5">
            <div class="form-title">
                Información del Flujo
            </div>

            <div class="form-item">
                <label>Descripción</label>
                <input type="text" name="descripcion" placeholder="ej: 5 Pagos de Inscripcion" <?php //if($integrante['rut'] != ''){echo "readonly";}?> value="<?php //if($integrante['rut'] != ''){echo $integrante['rut'];}else{echo set_value('rut');} ?>" />
                <?php echo form_error('descripcion');?>
            </div>

            <div class="form-item">
                <label>Monto</label>
                <div class="input-prepend input-append span7">
                    <span class="add-on">$</span>
                    <input class="span12" id="appendedPrependedInput" type="text" name="monto" placeholder="ej: 5000" size="10">
                </div>
                <?php echo form_error('monto');?>            
            </div>

            <div class="form-item">
                <input type="submit" value="Guardar" class="btn btn-primary"    />
            </div>
        </div>
    </form>
</div>