<div class="row-fluid">

    <div id="error2" class="hidden">
        <span><i class='icon-remove-sign'></i></span>
        <div></diV>
    </div>
    <div id="success2" class="alert alert-success" style="display:none">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <div></diV>
    </div>

    <div class="bo-form span11">
        <div class="form-title">
            Integrantes
        </div>

        <div class="form-item">
            <div class="span12" id="select-integrantes">
                <ul class="sortable-list ui-sortable span12" id="0">
                    <?php foreach($integrantes as $item => $integrante){?>
                    <?php if($integrante['unidad'] == FALSE){?>
                    <li class="integrante integrante-card sortable-item" id='card-<?php echo $integrante['rut']?>'>

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
                    <?php }?>
                <?php }?>
                </ul>
            </div>
        </div>
    </div>


    <div class="bo-form span11">
        <div class="form-title">
            Unidades
        </div>

        <div class="form-item">

            <?php foreach($unidades as $item => $val){?>
            <div class="drop-unidad">
                <div class="unidad-titulo">
                    <h3><?php echo $val['nombre'];?></h3>
                </div>
                <ul class="unidad sortable-list ui-sortable" id="<?php echo $val['id'];?>">
                    <?php foreach($integrantes as $item => $integrante){?>
                    <?php if($integrante['unidad'] == $val['nombre']){?>
                        <li class="integrante integrante-card sortable-item" id='card-<?php echo $integrante['rut']?>'>
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
                    <?php }?>
                    <?php }?>
                </ul>
            </div>
            <?php }?>
        </div>
    </div>
</div>