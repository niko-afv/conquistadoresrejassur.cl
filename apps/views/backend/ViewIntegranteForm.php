<div class="row-fluid">
<div id="error2" class="alert alert-error" style="display: none;">
    <!--<span><i class='icon-remove-sign'></i></span>-->
    <button type="button" class="close" data-dismiss="alert">×</button>
    <div></diV>
</div>
<div id="success2" class="alert alert-success" style="display: none;">
    <!--<span><i class='icon-remove-sign'></i></span>-->
    <button type="button" class="close" data-dismiss="alert">×</button>
    <div></diV>
</div>

<?php //if(isset($integrante)){print_r($unidades);}?>

<form action="/admin/integrantes_form/" method="POST">

    <div class="bo-form span5">
        <div class="form-title">
            Datos Personales
        </div>

        <div class="form-item">
            <label>Rut</label>
            <input class="form-control" type="text" name="rut" placeholder="ej: xxxxxxxx-x" <?php if($integrante['rut'] != ''){echo "readonly";}?> value="<?php if($integrante['rut'] != ''){echo $integrante['rut'];}else{echo set_value('rut');} ?>" />
            <?php echo form_error('rut');?>
        </div>

        <div class="form-item">
            <label>Nombre</label>
            <input class="form-control" type="text" name="nombre" value="<?php if($integrante['nombre'] != ''){echo $integrante['nombre'];}else{echo set_value('nombre');} ?>"  />
            <?php echo form_error('nombre');?>
        </div>

        <div class="form-item">
            <label>Apellido</label>
            <input class="form-control" type="text" name="apellido" value="<?php if($integrante['apellido'] != ''){echo $integrante['apellido'];}else{echo set_value('apellido');} ?>"  />
            <?php echo form_error('apellido');?>
        </div>

        <div class="form-item">
            <label>Edad</label>
            <input class="form-control" type="text" name="edad" value="<?php if($integrante['edad'] != ''){echo $integrante['edad'];}else{echo set_value('edad');} ?>"  />
            <?php echo form_error('edad');?>
        </div>

        <div class="form-item">
            <label>Telefono</label>
            <input class="form-control" type="text" name="fono" placeholder="ej: xxxxxxxxx" value="<?php if($integrante['telefono_principal'] != ''){echo $integrante['telefono_principal'];}else{echo set_value('fono');} ?>"  />
            <?php echo form_error('fono');?>
        </div>

        <div class="form-item">
            <label>Telefono Auxiliar</label>
            <input class="form-control" type="text" name="fono2" placeholder="ej: xxxxxxxxx" value="<?php if($integrante['telefono_auxiliar'] != ''){echo $integrante['telefono_auxiliar'];}else{echo set_value('fono2');} ?>"  />
            <?php echo form_error('fono2');?>
        </div>

        <div class="form-item">
            <label>Direccion</label>
            <input class="form-control" type="text" name="direccion" placeholder="ej: calle #numero, comuna" value="<?php if($integrante['direccion'] != ''){echo $integrante['direccion'];}else{echo set_value('direccion');} ?>"  />
            <?php echo form_error('direccion');?>
        </div>

        <div class="form-item">
            <label>E-Mail</label>
            <div class="input-prepend">
                <span class="add-on"><i class="icon-envelope"></i></span>
                <input class="form-control" type="text" name="mail" placeholder="ej: algun@email.com" value="<?php if($integrante['email'] != ''){echo $integrante['email'];}else{echo set_value('mail');} ?>"  />
            </div>
            <?php echo form_error('mail');?>
        </div>
        
        <div class="form-item">
            <label>Cargo</label>
            <select class="form-control" name="cargo">
                <option value="0">Seleccione Cargo</option>
                <?php foreach ($cargos as $item => $val){?>
                <option value="<?=$val['id'];?>" <?php if($val['id']==$integrante['cargo'] || $val['id'] == set_value('cargo')){echo 'selected';}?> ><?=$val['nombre'];?></option>
                <?php }?>
            </select>
            <?php echo form_error('cargo');?>
        </div>
        
        <div class="form-item">
            <label>Grado</label>
            <select class="form-control" name="grado">
                <option value="0">Seleccione Grado</option>
                <?php foreach ($rangos as $item => $val){?>
                <option value="<?=$val['id'];?>" <?php if($val['id']==$integrante['rango'] || $val['id'] == set_value('grado')){echo 'selected';}?> ><?=$val['nombre'];?></option>
                <?php }?>
            </select>
            <?php echo form_error('grado');?>            
        </div>        

        <div class="form-item">
            <input type="submit" value="Guardar" class="btn btn-primary"    />
        </div>

        <div class="clear"></div>
    </div>
    
    
    <div class="bo-form span5">
        <div class="form-title">
            Foto Perfil
        </div>

        <div class="form-item">
            <i class="icon-picture img-icon"></i>
            <label id="integrante-img">Subir Foto</label>
        
            <div id="galeryIntegrante">
                <?php if(set_value('imgIntegrante-img1') != ''){$integrante['foto'] = set_value('imgIntegrante-img1');}?>
                <?php if($integrante['foto'] != ''){?>
                
                <span style="position: relative; float: left;" class="im span12">
                    <a class="delete" onclick="deleteImage('imgIntegrante-img1','/conquistadoresrejassur.cl/admin/integrantes_form/deleteImage');">del</a>
                    <img src="<?php echo $base_url.$integrante['foto']?>" width="400" height="480">
                    <input type="hidden" id="imgIntegrante-img1" name="imgIntegrante-img1" value="<?=$integrante['foto']?>"  />
                </span>
                <?php }else{?>
                    <input type="hidden" id="imgIntegrante-img1" name="imgIntegrante-img1" value=""  />
                <?php }?>
            </div>
            
            <?php echo form_error('foto');?>
        </div>
    </div>
    
    <div class="hiddenx" id="apoderado-form">
        <div class="bo-form span12">
            <div class="form-title">
                Datos del Apoderado
            </div>

            <div class="form-item">
                <label>Rut Apoderado</label>
                <input class="form-control" type="text" name="rutApoderado" placeholder="ej: xxxxxxxx-x" value="<?php if($integrante['apoderado']['rut'] != ''){echo $integrante['apoderado']['rut'];}else{echo set_value('rutApoderado');} ?>"  />
                <?php echo form_error('rutApoderado');?>
            </div>

            <div class="form-item">
                <label>Nombre Apoderado</label>
                <input class="form-control" type="text" name="nombreApoderado" placeholder="ej: xxxxxxxx-x" value="<?php if($integrante['apoderado']['nombre'] != ''){echo $integrante['apoderado']['nombre'];}else{echo set_value('nombreApoderado');} ?>"  />
                <?php echo form_error('nombreApoderado');?>
            </div>

            <div class="form-item">
                <label>Apellido Apoderado</label>
                <input class="form-control" type="text" name="apellidoApoderado" placeholder="ej: xxxxxxxx-x" value="<?php if($integrante['apoderado']['apellido'] != ''){echo $integrante['apoderado']['apellido'];}else{echo set_value('apellidoApoderado');} ?>"  />
                <?php echo form_error('apellidoApoderado');?>
            </div>

            <div class="form-item">
                <label>Telefono Apoderado</label>
                <input class="form-control" type="text" name="fonoApoderado" placeholder="ej: xxxxxxxx-x" value="<?php if($integrante['apoderado']['telefono'] != ''){echo $integrante['apoderado']['telefono'];}else{echo set_value('fonoApoderado');} ?>"  />
                <?php echo form_error('fonoApoderado');?>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    
    
</form>
<div class="clear"></div>
</div>