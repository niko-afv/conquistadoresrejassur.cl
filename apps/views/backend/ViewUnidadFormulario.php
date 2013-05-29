-<div id="error" class="hidden">
    <span><i class='icon-remove-sign'></i></span>
    <div></diV>
</div>
<?php //print_r($unidad);?>
<form action="/conquistadoresrejassur.cl/admin/unidades_form/" method="POST">

    <input type="hidden" name="id" value="<?php if($unidad['id'] != ''){echo $unidad['id'];}?>"  />
    <input type="hidden" name="id_trayectoria" value="<?php if($unidad['trayectoria'][0]['id'] != ''){echo $unidad['trayectoria'][0]['id'];}?>"  />

    <div class="bo-form">
        <div class="form-title">
            Foto Unidad
        </div>

        <div class="form-item">
            <i class="icon-picture img-icon"></i>
            <label id="upload">Subir Foto</label>

            <div id="galeryUnidad">
                <?php if(set_value('imgUpload1') != ''){$unidad['trayectoria'][0]['foto'] = set_value('imgUpload1');}?>
                <?php if($unidad['trayectoria'][0]['foto'] != ''){?>

                    <span style="position: relative; float: left;" class="im">
                    <a class="delete" onclick="deleteImage('imgUpload1');">del</a>
                    <img src="<?php echo $base_url.$unidad['trayectoria'][0]['foto']?>" width="460" height="816">
                    <input type="hidden" id="imgUpload1" name="imgUpload1" value="<?=$unidad['trayectoria'][0]['foto']?>"  />
                </span>
                <?php }else{?>
                    <input type="hidden" id="imgUpload1" name="imgUpload1" value=""  />
                <?}?>
            </div>

            <?php echo form_error('foto');?>
        </div>
    </div>

    <div class="bo-form">
        <div class="form-title">
            Información General
        </div>

        <div class="form-item">
            <label>Nombre</label>
            <input type="text" name="nombre" value="<?php if($unidad['nombre'] != ''){echo $unidad['nombre'];} else { echo set_value('nombre');} ?>"  />
            <?php echo form_error('nombre');?>
        </div>

        <div class="form-item">
            <label>Grito</label>
            <textarea name="grito"> <?php if($unidad['trayectoria'][0]['grito'] != ''){echo $unidad['trayectoria'][0]['grito'];} else { echo set_value('grito');} ?></textarea>
            <?php echo form_error('grito');?>
        </div>

        <div class="form-item">
            <label>Fundado</label>
            <input type="text" name="fundado" value="<?php if($unidad['fundado'] != ''){echo $unidad['fundado'];} else { echo set_value('fundado');} ?>"  />
            <?php echo form_error('fundado');?>
        </div>

        <div class="form-item">
            <input type="submit" value="Guardar" class="btn btn-primary"    />
        </div>
    </div>

    <div class="clear"></div>
</form>