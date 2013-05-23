<div id="error" class="hidden">
    <span><i class='icon-remove-sign'></i></span>
    <div></diV>
</div>

<?php //if(isset($integrante)){print_r($unidades);}?>

<form action="/conquistadoresrejassur.cl/index.php/admin/integrantes_form/" method="POST">
    <div class="bo-form">
        <div class="form-title">
            Foto Perfil
        </div>

        <div class="form-item">
            <i class="icon-picture img-icon"></i>
            <label id="upload">Subir Foto</label>
        
            <div id="galeryIntegrante">
                <?php if(set_value('imgUpload1') != ''){$integrante['foto'] = set_value('imgUpload1');}?>
                <?php if($integrante['foto'] != ''){?>
                
                <span style="position: relative; float: left;" class="im">
                    <a class="delete" onclick="deleteImage('imgUpload1');">del</a>
                    <img src="<?php echo $base_url.$integrante['foto']?>" width="460" height="816">
                    <input type="hidden" id="imgUpload1" name="imgUpload1" value="<?=$integrante['foto']?>"  />
                </span>
                
                <?php }?>
            </div>
            
            <?php echo form_error('foto');?>
        </div>
    </div>


    <div class="bo-form span13">
        <div class="form-title">
            Datos Personales
        </div>

        <div class="form-item">
            <label>Rut</label>
            <input type="text" name="rut" placeholder="ej: xxxxxxxx-x" <?php if($integrante['rut'] != ''){echo "readonly";}?> value="<?php if($integrante['rut'] != ''){echo $integrante['rut'];}else{echo set_value('rut');} ?>" />
            <?php echo form_error('rut');?>
        </div>

        <div class="form-item">
            <label>Nombre</label>
            <input type="text" name="nombre" value="<?php if($integrante['nombre'] != ''){echo $integrante['nombre'];}else{echo set_value('nombre');} ?>"  />
            <?php echo form_error('nombre');?>
        </div>

        <div class="form-item">
            <label>Apellido</label>
            <input type="text" name="apellido" value="<?php if($integrante['apellido'] != ''){echo $integrante['apellido'];}else{echo set_value('apellido');} ?>"  />
            <?php echo form_error('apellido');?>
        </div>

        <div class="form-item">
            <label>Edad</label>
            <input type="text" name="edad" value="<?php if($integrante['edad'] != ''){echo $integrante['edad'];}else{echo set_value('edad');} ?>"  />
            <?php echo form_error('edad');?>
        </div>

        <div class="form-item">
            <label>Telefono</label>
            <input type="text" name="fono" placeholder="ej: xxxxxxxxx" value="<?php if($integrante['telefono_principal'] != ''){echo $integrante['telefono_principal'];}else{echo set_value('telefono_principal');} ?>"  />
            <?php echo form_error('fono');?>
        </div>

        <div class="form-item">
            <label>Telefono Auxiliar</label>
            <input type="text" name="fono2" placeholder="ej: xxxxxxxx-x" value="<?php if($integrante['telefono_auxiliar'] != ''){echo $integrante['telefono_auxiliar'];}else{echo set_value('telefono_auxiliar');} ?>"  />
            <?php echo form_error('fono2');?>
        </div>

        <div class="form-item">
            <label>Direccion</label>
            <input type="text" name="direccion" placeholder="ej: calle #numero, comuna" value="<?php if($integrante['direccion'] != ''){echo $integrante['direccion'];}else{echo set_value('direccion');} ?>"  />
            <?php echo form_error('direccion');?>
        </div>

        <div class="form-item">
            <label>E-Mail</label>
            <div class="input-prepend">
                <span class="add-on"><i class="icon-envelope"></i></span>
                <input type="text" name="mail" placeholder="ej: algun@email.com" value="<?php if($integrante['email'] != ''){echo $integrante['email'];}else{echo set_value('email');} ?>"  />
            </div>
            <?php echo form_error('mail');?>
        </div>
        
        <div class="form-item">
            <label>Cargo</label>
            <select name="cargo">
                <option value="0">Seleccione Cargo</option>
                <?php foreach ($cargos as $item => $val){?>
                <option value="<?=$val['id'];?>" <?php if($val['id']==$integrante['cargo']){echo 'selected';}?> ><?=$val['nombre'];?></option>
                <?php }?>
            </select>
            <?php echo form_error('cargo');?>
        </div>
        
        <div class="form-item">
            <label>Grado</label>
            <select name="rango">
                <option value="0">Seleccione Rango</option>
                <?php foreach ($rangos as $item => $val){?>
                <option value="<?=$val['id'];?>" <?php if($val['id']==$integrante['rango']){echo 'selected';}?> ><?=$val['nombre'];?></option>
                <?php }?>
            </select>
            <?php echo form_error('grado');?>
        </div>
        
        <div class="form-item">
            <label>Unidad</label>
            <select name="rango">
                <option value="0">Seleccione Unidad</option>
                <?php foreach ($unidades as $item => $val){?>
                <option value="<?=$val['id'];?>" <?php if($val['id']==$integrante['unidad']){echo 'selected';}?> ><?=$val['nombre'];?></option>
                <?php }?>
            </select>
            <?php echo form_error('unidad');?>
        </div>
        

        <div class="form-item">
            <input type="submit" value="Guardar" class="btn btn-primary"    />
        </div>

        <div class="clear"></div>
    </div>
</form>
<div class="clear"></div>