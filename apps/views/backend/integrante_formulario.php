<script type="text/javascript" src="<?php echo $base_url;?>js/AjaxUpload.2.0.js"></script>
<script type="text/javascript" src="<?php echo $base_url;?>js/upload/upload.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>js/upload/css/upload.css">

<script type="text/javascript">
    $(document).on("ready", function(){
        $("#upload").upload({
            galery:{
                content : '#galeryZona', /*no opcional*/
                views   : ['120x80'],        /*no opcional*/
                count   : 1
            },
            image:{
                path   : 'integrantes',
                types  : 'jpg,png,jpeg,gif',
                size   : 1000,
                width  : 385,
                height : 385
                //thumb  : ['210x144']
            }
         });
    })
</script>

<form action="" method="POST">
    <div class="bo-form">
        <div class="form-title">
            Foto Perfil
        </div>

        <div class="form-item">
            <label id="upload">Subir Foto</label>
            <?php echo form_error('foto');?>
        </div>
    </div>


    <div class="bo-form span13">
        <div class="form-title">
            Datos Personales
        </div>

        <div class="form-item">
            <label>Rut</label>
            <input type="text" name="rut" placeholder="ej: xxxxxxxx-x"  />
            <?php echo form_error('rut');?>
        </div>

        <div class="form-item">
            <label>Nombre</label>
            <input type="text" name="nombre"  />
            <?php echo form_error('nombre');?>
        </div>

        <div class="form-item">
            <label>Apellido</label>
            <input type="text" name="apellido"  />
            <?php echo form_error('apellido');?>
        </div>

        <div class="form-item">
            <label>Edad</label>
            <input type="text" name="edad"  />
            <?php echo form_error('edad');?>
        </div>

        <div class="form-item">
            <label>Telefono</label>
            <input type="text" name="fono" placeholder="ej: xxxxxxxxx"  />
            <?php echo form_error('fono');?>
        </div>

        <div class="form-item">
            <label>Telefono Auxiliar</label>
            <input type="text" name="fono2" placeholder="ej: xxxxxxxx-x"  />
            <?php echo form_error('fono2');?>
        </div>

        <div class="form-item">
            <label>Direccion</label>
            <input type="text" name="direccion" placeholder="ej: calle #numero, comuna"  />
            <?php echo form_error('direccion');?>
        </div>

        <div class="form-item">
            <label>E-Mail</label>
            <div class="input-prepend">
                <span class="add-on"><i class="icon-envelope"></i></span>
                <input type="text" name="mail" placeholder="ej: algun@email.com"  />
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