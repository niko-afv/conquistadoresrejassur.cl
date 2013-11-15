<script>
    $(function(){
        $("select[name='entidad']").on('change', function(){
            var entidad =   $(this).val();
            var url     =   "/admin/listados_form/carga_detalles_entidad/";
            
            $.post(url, {'entidad':entidad}, function(data){
                var html = "";
                obj = JSON.parse(data);                
                for(var i = 0; i< obj.length; i++){
                    html += "<div class='form-item'><label for='"+i+"'>"+obj[i]+"</label>";
                    html += "<input type='checkbox' id='"+i+"' value='"+obj[i]+"' /></div>";
                }
                $("#step2 #campos").html(html);
                $("#step1").fadeOut("slow", function(){
                    $("#step2").fadeIn(1000);
                });
            });
        });
    });
</script>

<div class="row-fluid">
    <div id="error" class="hidden">
        <span><i class='icon-remove-sign'></i></span>
        <div></diV>
    </div>
    <form action="/admin/unidades_form/" method="POST">

        <input type="hidden" name="id" value="<?php if($listado['id'] != ''){echo $listado['id'];}?>"  />

        <div class="bo-form" id="step1">
            <div class="form-title">
                Información General
            </div>

            <div class="form-item">
                <label>Nombre</label>
                <input type="text" name="nombre" value="<?php if($listado['nombre'] != ''){echo $listado['nombre'];} else { echo set_value('nombre');} ?>"  />
                <?php echo form_error('nombre');?>
            </div>

            <div class="form-item">
                <label>Entidad</label>

                <select name="entidad">
                    <option value="0">Seleccione Entidad</option>
                    <?php foreach ($entidades as $item => $val){?>
                    <option value="<?=$val['id'];?>" <?php if($val['id']==$listado['entidad'] || $val['id'] == set_value('nombre')){echo 'selected';}?> ><?=$val['nombre'];?></option>
                    <?php }?>
                </select>
                <?php echo form_error('cargo');?>
            </div>

            <div class="form-item">
                <input type="submit" value="Guardar" class="btn btn-primary"    />
            </div>
        </div>
        
        
        <div class="bo-form" id="step2" style="display: none;">
            <div class="form-title">
                Configuración del Listado
            </div>

            <div class="form-item">
                <label>Campos a Utilizar</label>
                
                <div id="campos" style="float: left; width: 70%;">
                    
                </div>
                
                <?php echo form_error('nombre');?>
            </div>

            <div class="form-item">
                <input type="submit" value="Guardar" class="btn btn-primary"    />
            </div>
        </div>
        
        
        <div class="clear"></div>
    </form>
</div>