<script>
$(function(){
    $("input[type=checkbox]").picker({toggle: true});
});
</script>

<div class="row-fluid">
<div id="error2" class="alert alert-error" style="display: none;">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <div></diV>
</div>
<div id="success2" class="alert alert-success" style="display: none;">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <div></diV>
</div>
    
<?php $cuenta['nombre'] = "";?>    
    
    <form action="/admin/cuentas_form/" method="POST">
        <div class="bo-form span5">
            <div class="form-title">
                Datos Generales
            </div>
            
            <div class="form-item">
                <label>Nombre</label>
                <input class="form-control" type="text" name="nombre" placeholder="ej: Inscripción, Mensualidad, etc" <?php if($cuenta['nombre'] != ''){echo "readonly";}?> value="<?php if($cuenta['nombre'] != ''){echo $cuenta['nombre'];}else{echo set_value('nombre');} ?>" />
                <?php echo form_error('nombre');?>
            </div>
            
            
            <div class="form-item">
                <label>Descripción</label>
                <textarea name="descripcion">
                    
                </textarea>
                <?php echo form_error('descripcion');?>
            </div>
            
            <div class="form-item">
                <label>Monto</label>
                <div class="input-group input-group-form">
                        <span class="input-group-addon">$</span>
                        <input class="form-control" type="text" name="monto" placeholder="ej: 2000" size="10">
                    </div>
                <?php echo form_error('monto');?>
            </div>    
        </div>
        
        
        <div class="bo-form span5">
            <div class="form-title">
                Información Adicional
            </div>
            
            <div class="form-item">
                <label>Tipo de Perido</label>
                <div class="input-group input-group-form">
                    <select class="form-control" name="periodo" >
                        <option value="">Seleccione una opción</option>
                        <?PHP foreach ($periodos as $item => $row){?>
                        <option value="<?php echo $row['id'];?>"><?php echo $row['descripcion'];?></option>
                        <?php }?>
                        
                    </select>                    
                </div>
                <?php echo form_error('periodo');?>
            </div>
            
            
            <div class="form-item">
                <label>Destino</label>
                <div class="input-group input-group-form">
                    <select class="form-control" name="destino" >
                        <option value="">Seleccione una opción</option>
                        <option value="1">Interno</option>
                        <option value="2">Externo</option>                        
                    </select>                    
                </div>
                <?php echo form_error('destino');?>
            </div>
            
            <div class="form-item">
                <label>Inherente</label>
                <div class="input-group input-group-form">
                    <!--<select class="form-control" name="inherente" >
                        <option value="">Seleccione una opción</option>
                        <option value="1">Si</option>
                        <option value="0">No</option>                        
                    </select>-->
                    <fieldset>
                        <label for="inherente">inherente</label>
                        <input type="checkbox" name="inherente" id="inherente" class="picker-element" value="1"  />
                    </fieldset>
                </div>
                <?php echo form_error('inherente');?>
            </div>
            
            <div class="form-item">
                <input type="submit" value="Guardar" class="btn btn-primary"    />
            </div>
            
        </div>
        
    </form>
</div>