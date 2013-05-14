<div id="error" class="hidden">
    <span><i class='icon-remove-sign'></i></span>
    <div></diV>
</div>

<form action="" method="POST">
    <div class="bo-form">
        <div class="form-title">
            Foto Perfil
        </div>

        <div class="form-item">
            <i class="icon-picture img-icon"></i>
            <label id="upload">Subir Foto</label>
        
            <div id="galeryIntegrante"></div>
            
            <?php echo form_error('foto');?>
        </div>
    </div>


    <div class="bo-form span13">
        <div class="form-title">
            Datos Personales
        </div>

        <div class="form-item">
            <label>Rut</label>
            <input type="text" name="rut" placeholder="ej: xxxxxxxx-x" value='<?php echo set_value('rut'); ?>'  />
            <?php echo form_error('rut');?>
        </div>

        <div class="form-item">
            <label>Nombre</label>
            <input type="text" name="nombre" value='<?php echo set_value('nombre');?>'  />
            <?php echo form_error('nombre');?>
        </div>

        <div class="form-item">
            <label>Apellido</label>
            <input type="text" name="apellido" value='<?php echo set_value('apellido');?>'  />
            <?php echo form_error('apellido');?>
        </div>

        <div class="form-item">
            <label>Edad</label>
            <input type="text" name="edad" value='<?php echo set_value('edad');?>'  />
            <?php echo form_error('edad');?>
        </div>

        <div class="form-item">
            <label>Telefono</label>
            <input type="text" name="fono" placeholder="ej: xxxxxxxxx" value='<?php echo set_value('fono');?>'  />
            <?php echo form_error('fono');?>
        </div>

        <div class="form-item">
            <label>Telefono Auxiliar</label>
            <input type="text" name="fono2" placeholder="ej: xxxxxxxx-x" value='<?php echo set_value('fono2');?>'  />
            <?php echo form_error('fono2');?>
        </div>

        <div class="form-item">
            <label>Direccion</label>
            <input type="text" name="direccion" placeholder="ej: calle #numero, comuna" value='<?php echo set_value('direccion');?>'  />
            <?php echo form_error('direccion');?>
        </div>

        <div class="form-item">
            <label>E-Mail</label>
            <div class="input-prepend">
                <span class="add-on"><i class="icon-envelope"></i></span>
                <input type="text" name="mail" placeholder="ej: algun@email.com" value='<?php echo set_value('mail');?>'  />
            </div>
            <?php echo form_error('mail');?>
        </div>
        
        <div class="form-item">
            <label>Cargo</label>
            <select name="cargo">
                <option value="0">Seleccione Cargo</option>
                <?php foreach ($cargos as $item => $val){?>
                <option value="<?=$val['id'];?>"><?=$val['nombre'];?></option>
                <?php }?>
            </select>
            <?php echo form_error('mail');?>
        </div>
        
        <div class="form-item">
            <label>Grado</label>
            <select name="rango">
                <option value="0">Seleccione Rango</option>
                <?php foreach ($rangos as $item => $val){?>
                <option value="<?=$val['id'];?>"><?=$val['nombre'];?></option>
                <?php }?>
            </select>
            <?php echo form_error('mail');?>
        </div>
        

        <div class="form-item">
            <input type="submit" value="Guardar" class="btn btn-primary"    />
        </div>

        <div class="clear"></div>
    </div>
</form>
<div class="clear"></div>