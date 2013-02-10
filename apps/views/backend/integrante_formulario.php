<form action="" method="POST">
    <div class="bo-form">
        <div class="form-title">
            Foto Perfil
        </div>

        <div class="form-item">
            <label>Subir Foto</label>
            <?php echo form_error('foto');?>
        </div>
    </div>


    <div class="bo-form">
        <div class="form-title">
            Datos Personales
        </div>    

        <div class="form-item">
            <label>Rut</label>
            <input type="text" name="rut"  />
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
            <input type="text" name="fono"  />
            <?php echo form_error('fono');?>
        </div>

        <div class="form-item">
            <label>Telefono Auxiliar</label>
            <input type="text" name="fono2"  />
            <?php echo form_error('fono2');?>
        </div>

        <div class="form-item">
            <label>Direccion</label>
            <input type="text" name="direccion"  />
            <?php echo form_error('direccion');?>
        </div>

        <div class="form-item">
            <label>E-Mail</label>
            <input type="text" name="mail"  />
            <?php echo form_error('mail');?>
        </div>

        <div class="form-item">
            <input type="submit" value="Guardar"    />
        </div>

        <div c  lass="clear"></div>
    </div>
</form>
<div class="clear"></div>