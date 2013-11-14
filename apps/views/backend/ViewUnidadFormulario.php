<div class="row-fluid">
    <div id="error" class="hidden">
        <span><i class='icon-remove-sign'></i></span>
        <div></diV>
    </div>
    <?php //print_r($unidad);?>
    <form action="/admin/unidades_form/" method="POST">

        <input type="hidden" name="id" value="<?php if($unidad['id'] != ''){echo $unidad['id'];}?>"  />
        <input type="hidden" name="id_trayectoria" value="<?php if($unidad['trayectoria'][0]['id'] != ''){echo $unidad['trayectoria'][0]['id'];}?>"  />

        <div class="bo-form span5">
            <div class="form-title">
                Foto Unidad
            </div>

            <div class="form-item">
                <i class="icon-picture img-icon"></i>
                <label id="unidad-img">Subir Foto</label>

                <div id="galeryUnidad">
                    <?php if(set_value('imgUnidad-img1') != ''){$unidad['trayectoria'][0]['foto'] = set_value('imgUnidad-img1');}?>
                    <?php if($unidad['trayectoria'][0]['foto'] != ''){?>

                        <span style="position: relative; float: left;" class="im span12">
                        <a class="delete" onclick="deleteImage('imgUnidad-img1');">del</a>
                        <img src="<?php echo $base_url.$unidad['trayectoria'][0]['foto']?>" width="460" height="816">
                        <input type="hidden" id="imgUnidad-img1" name="imgUnidad-img1" value="<?=$unidad['trayectoria'][0]['foto']?>"  />
                    </span>
                    <?php }else{?>
                        <input type="hidden" id="imgUnidad-img1" name="imgUnidad-img1" value=""  />
                    <?php } ?>
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
                <textarea name="grito"><?php if($unidad['trayectoria'][0]['grito'] != ''){echo $unidad['trayectoria'][0]['grito'];} else { echo set_value('grito');} ?></textarea>
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


        <?php if($unidad['trayectoria'][0]['id'] != ''){?>
            <div class="bo-form span8">
                <div class="form-title">
                    Inegrantes de la Unidad
                    <a id="link-add" href="<? echo $base_url;?>admin/agregar_integrantes/">Agregar Integrantes</a>
                </div>

                <div class="form-item">
                    <div id="integrantes-container" class="span12">
                        <div id="background" class="span12">
                            &nbsp;
                        </div>
                        <ul class="sortable-list ui-sortable span12" id="0">
                            <?php foreach($integrantes as $item => $integrante){?>
                                <?php //if($integrante['unidad'] == FALSE){?>
                                    <li class="integrante-unidad integrante-card " id='card-<?php echo $integrante['rut']?>'>

                                        <img src="<?php echo $base_url.str_replace('400x480','150x180',$integrante['foto']);?>" width='83'    />
                                        <div class='info'>
                                            <div class="item">
                                                <label>Nombre</label> <span><?php echo $integrante['nombre']. ' ' .$integrante['apellido'];?></span>
                                            </div>

                                            <div class="item">
                                                <label>Edad</label> <span><?php echo $integrante['edad']; ?></span>
                                            </div>

                                            <div class="item">
                                                <label>Cargo</label> <span><?php echo $integrante['cargo'];?></span>
                                            </div>

                                            <div class="item">
                                                <label>Grado</label> <span><?php echo $integrante['grado']; ?></span>
                                            </div>
                                        </div>
                                    </li>
                                <?php //}?>
                            <?php }?>
                        </ul>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <div class="clear"></div>
    </form>
</div>