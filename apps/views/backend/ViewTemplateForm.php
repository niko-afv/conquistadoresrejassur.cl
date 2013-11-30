<script>
    $(function(){
        $("select[name='entidad']").on('change', function(){
            var entidad =   $(this).val();
            var url     =   "/admin/plantillas_form/carga_detalles_entidad/"; 
            
            $.post(url, {'entidad':entidad}, function(data){
                var html1 = "<div class='form-column a'>";
                var html2 = "<div class='form-column b'>";
                obj = JSON.parse(data);
                for(var i = 0; i< obj.length; i++){
                    html1 += "<label for='"+i+"'>"+obj[i]+"</label>";
                    html2 += "<input type='checkbox' name='campos[]' id='"+i+"' value='"+obj[i]+"' />";
                }
                html1 += "</div>";
                html2 += "</div>";
                $("#step2 .campos#old").fadeOut(200, function(){
                    $("#step2 .campos#old").html(html1+html2);
                    $(this).fadeIn(200, function(){
                        $("#step2").fadeIn(1000);
                    });
                });
            });
        });
        
        $(".campos#new").on('keyup','input',function(event){
            if($(this).hasClass("dynamic")){
                if( (event.which >= 48 && event.which <= 57) || (event.which >= 97 && event.which <= 122) || (event.which >= 65 && event.which <= 90)){
                    $(this).removeClass('dynamic');
                    var nCampos = $(".campos#new");
                    nCampos.append("<input class='dynamic' type='text' name='dCampos[]' placeholder='Ej: Pañolín, biblia, cuota, asistencia' maxlength='20'  />");
                }
            }else{
                if(event.which === 8){
                    if($.trim($(this).val()) === ""){
                        $(".dynamic").remove();
                        $(this).addClass("dynamic");
                    }
                }
            }
        });
    });
</script>

<div class="row-fluid">
    <div id="error" class="hidden">
        <span><i class='icon-remove-sign'></i></span>
        <div></diV>
    </div>
    <form action="/admin/plantillas_form/" method="POST">

        <input type="hidden" name="id" value="<?php if($template['id'] != ''){echo $template['id'];}?>"  />
        
        <div class="bo-form" id="step1">
            <div class="form-title">
                Información General
            </div>

            <div class="form-item">
                <label>Nombre</label>
                <input type="text" name="nombre" value="<?php if($template['nombre'] != ''){echo $template['nombre'];} else { echo set_value('nombre');} ?>"  />
                <?php echo form_error('nombre');?>
            </div>

            <div class="form-item">
                <label>Entidad</label>

                <select name="entidad">
                    <option value="0">Seleccione Entidad</option>
                    <?php foreach ($entidades as $item => $val){?>
                    <option value="<?=$val['id'];?>" <?php if($val['id']==$template['entidad'] || $val['id'] == set_value('nombre')){echo 'selected';}?> ><?=$val['nombre'];?></option>
                    <?php }?>
                </select>
                <?php echo form_error('entidad');?>
            </div>
        </div>
        
        <div class="bo-form" id="step2" style="display: none;">
            <div class="form-title">
                Campos a Utilizar
            </div>

            <div class="form-item">
                <label>Campos disponibles</label>
                
                <div class="campos" id="old">
                    
                </div>
                
                <?php echo form_error('campos');?>
                <div class="clear"></div>
            </div>
            
            <div class="form-item">
                
                <label>Nuevos campos</label>
                
                <div class="campos" id="new">
                    <input class='dynamic' type='text' name='dCampos[]' placeholder='Ej: Pañolín, biblia, cuota, asistencia' maxlength='20'  />
                </div>
                
                <?php echo form_error('dCampos');?>
                <div class="clear"></div>
            </div>

            <div class="form-item">
                <input type="submit" value="Guardar" class="btn btn-primary"    />
            </div>
        </div>        
        
        <div class="clear"></div>
    </form>
</div>