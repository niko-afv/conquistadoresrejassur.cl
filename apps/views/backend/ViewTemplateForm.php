<script>
    $(function(){
        /**
         * Funcion encargada de validar si a las teclas presionadas les corresponde gatillar eventos
         **/
        function verificarTecla(tecla){
            if((tecla >= 48 && tecla <= 57) || (tecla >= 97 && tecla <= 122) || (tecla >= 65 && tecla <= 90)){
                return true;
            }else{
                return false;
            }
        }

        /**
         * Función encargada de cargar los campos disponibles,
         * segun la entidad Seleccionada
         */
        $("select[name='entidad']").on('change', function(){
            var entidad =   $(this).val();
            var url     =   "/admin/plantillas_form/carga_detalles_entidad/"; 
            
            $.post(url, {'entidad':entidad}, function(data){
                var obj = JSON.parse(data);
                var html0 = "";
                var html1 = "";
                var html2 = "";

                for(var i = 0; i< obj.length; i++){
                    html1 += "<div class='row-check'>";
                    html1 += "<div class='form-column a'>";
                    html1 += "<label>"+obj[i]+"</label>";
                    html1 += "</div>";
                    html1 += "<div class='form-column b'>";
                    html1 += "<fieldset>";
                    html1 += "<input type='checkbox' name='campos[]' id='"+i+"' value='"+obj[i]+"' />"
                    html1 += "<label for='"+i+"'>"+obj[i]+"</label>";
                    html1 += "</fieldset>";
                    //html2 += "<input class='form-inline' type='checkbox' name='campos[]' id='"+i+"' value='"+obj[i]+"' />";
                    
                    html1 += "</div>";
                    html1 += "</div>";
                }
                
                $("#step2 .campos#old").fadeOut(200, function(){
                    $("#step2 .campos#old").html(html1+html2);
                    //$("#step2 .campos#old").html(html);
                    $("input[type=radio], input[type=checkbox]").picker({toggle: true});
                    $(this).fadeIn(200, function(){
                        $("#step2").fadeIn(1000);
                    });
                });
            });
        });

        /**
         * Función cargar los campos extra dinamicamente
         *
         */
        $(".campos#new").on('keyup','input',function(event){

            if($(this).parent().hasClass("dynamic")){
                if(verificarTecla(event.which)){
                    $(this).parent().removeClass('dynamic');
                    $(this).parent().addClass('static');
                    var nCampos = $(".campos#new");
                    var num = $(".autocompletar").length +1;
                    console.log("NUm: "+ num);
                    html = "<div class='dynamic'>";
                    html += "<input class='form-control autocompletar' id='campo_"+num+"' type='text' name='dCampos[]' placeholder='Ej: Pañolín, biblia, cuota, asistencia' autocomplete='off' maxlength='20'  />";
                    html += "<div class='dropdown'>";
                    html += "<ul class='dropdown-menu' role='menu' aria-labelledby='dropdownMenu'>";
                    html += "<li class='title-li'>Algunos Sugerencias</li>";
                    html += "<li class='divider'></li>";
                    html += "</ul>";
                    html += "</div>";
                    html += "</div>";
                    nCampos.append(html);
                }
            }else{
                if(event.which === 8){
                    if($.trim($(this).val()) === ""){
                        $(".dynamic").remove();
                        $(this).parent().removeClass('static');
                        $(this).parent().addClass("dynamic");
                    }
                }
            }
        });

        /**
         * Función encargada del autocompletado de campos extra disponibles
         */
        $(".campos#new").on('keyup','input',function(event){
            if(verificarTecla(event.which) || event.which === 8){
                var info = $(this).val();
                var id = $(this).attr('id');
                /*console.log("id: "+ id);
                console.log("idvalor: "+ info);*/
                if(info.length > 0){
                    var url     =   "/admin/plantillas_form/autocompletar/";
                    $.post(url,{ info : info, id : id }, function(data){

                        var dropdown = $("#"+id).parent().children('.dropdown').children();

                        $(".auto").remove();
                        data = JSON.parse(data);
                        if(data.ok){
                            dropdown.addClass('visible');
                            for(var i = 0; i < data.campos.length; i++){
                                dropdown.append("<li class='auto'><a>"+data.campos[i].nombre+"</a>");
                            }
                        }else{
                            dropdown.removeClass('visible');
                            $(".auto").remove();
                        }
                    })
                }else{
                    $("#"+id).parent().children('.dropdown').children().removeClass('visible');
                    $(".auto").remove();
                }
            }
        });

        /**
         * Funcion encargada de cargar el valor
         * en el nuevo campo al hacer click en las sugerencias
         */
        $(".campos#new").on('dblclick','.auto',function(){
            var valor = $(this).children('a').html()

            $(this).parent().parent().parent().children('input').val(valor);
            $(this).parent().removeClass('visible');
        });
    });
</script>

<style type="text/css">
    .contenedor p{
        font-size: 14px;
        background-color: #ca5d36;
        background-image: linear-gradient(90deg, transparent 50%, rgba(255,255,255,.5) 50%);
        background-size: 203px 203px;
        color: #fff;
        padding: 3px 2px;
        border: 1px solid #000;
        max-width: 300px;
        margin-top: -14px;
    }
    .contenedor p a{
        color: #fff;
        text-decoration: none;
    }

    .dropdown{
        left: 10px;
        top: -10px;
    }
    .visible{
        display: block;
    }
    .title-li{
        font-size: 13px;
        font-weight: bold;
        text-indent: 15px;
    }
    .auto{
        cursor: pointer;
    }
</style>

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
                <input class="form-control" type="text" name="nombre" value="<?php if($template['nombre'] != ''){echo $template['nombre'];} else { echo set_value('nombre');} ?>"  />
                <?php echo form_error('nombre');?>
            </div>

            <div class="form-item">
                <label>Entidad</label>

                <select class="form-control" name="entidad">
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
                    <div class="dynamic">
                        <input class="form-control autocompletar" id="campo_1" type='text' name='dCampos[]' placeholder='Ej: Pañolín, biblia, cuota, asistencia' maxlength='20' autocomplete="off"  />
                        <div class="dropdown">
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                                <li class="title-li">Algunos Sugerencias</li>
                                <li class="divider"></li>
                            </ul>
                        </div>
                    </div>
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