function eliminarIntegrante(e){
    e.preventDefault()
    
    var nombre = $(this).parent().parent().find(".name").text()
    var apellido = $(this).parent().parent().find(".lastname").text()
    var rut = $(this).parent().parent().attr('id');
    
    if(confirm('¿Está Seguro de querer eliminar a '+ nombre + ' ' + apellido + '?')){
        var url = $(this).attr('href');
        $.post(url,{rut : rut}, function(data){
            if(data){
                $("#"+rut).fadeOut("slow");
            }
        });
    }
}

function eliminarUnidad(e){
    e.preventDefault()

    var nombre = $(this).parent().parent().find(".name").text()
    var rut = $(this).parent().parent().attr('id');

    if(confirm('¿Está Seguro de querer eliminar a '+ nombre +  '?')){
        var url = $(this).attr('href');
        $.post(url,{rut : rut}, function(data){
            if(data){
                msg2('La unidad '+ nombre + ' se ha eliminado correctamente.','success');
                $("#"+rut).fadeOut("slow");
            }
        });
    }
}


function opacityCard($element,opacity, callback){
    $element.find('img').animate({'opacity': opacity},600);
    if($.isFunction(callback)){
        callback();
    }
}

function agregarIntegrante(rut, unidad_id,anterior_id){
    rut = rut.replace("card-",'');
    url = '/conquistadoresrejassur.cl/admin/agregar_integrantes/agregarIntegrante';
    $.post(url,{integrante_rut: rut, unidad_id: unidad_id, anterior_id: anterior_id},function(data){
        if(data){
            msg2('<strong>¡Bien echo!</strong> La operación se ha realizado correctamente','success');
        }
    });
}


/*DOCUMENT READY*/
$(function(){
    
    if($("input[name='edad']").val() > 15 || $("input[name='edad']").val() === ""){
        //$("#apoderado-form").hide();
    }
    
    $('.close').live('click',function(){
        $(this).parent().fadeOut(1000);
    });

    //Foto Integrante
    $("#integrante-img").upload({
        galery:{
            content :   '#galeryIntegrante', /*no opcional*/
            views   :   ['400x480'],        /*no opcional*/
            count   :   1
        },
        image:{
            path    :   'integrantes',
            types   :   'jpg,png,jpeg,gif',
            size    :   2000,
            width   :   400,
            height  :   480,
            thumb   :   '100x177,150x180'
        },
        deleteUrl  :   '/conquistadoresrejassur.cl/admin/integrantes_form/deleteImage'
    });
    $(".delete-reg").on("click",eliminarIntegrante);


    //Foto Unidad
    $("#unidad-img").upload({
        galery:{
            content :   '#galeryUnidad', /*no opcional*/
            views   :   ['410x250'],        /*no opcional*/
            count   :   1
        },
        image:{
            path    :    'unidades',
            types   :    'jpg,png,jpeg,gif',
            size    :    2000,
            width   :    3264,
            height  :    1840
        }
    });
    $(".delete-unidad").on("click",eliminarUnidad);



    $("#link-add").parent().parent().hover(
        function(){
            $("#link-add").fadeIn("slow");
        },
        function(){
            $("#link-add").fadeOut("slow");
        }
    );
        
        
    /*Escene : Integrante Form
     *Action : Show Apoderado form
     * */
    $("input[name='edad']").on('focusout',function(){
        if($(this).val() < 16){
            $("#apoderado-form").fadeIn();
        }else{
            $("#apoderado-form").fadeOut();
        }
    });


    $('.sortable-list').sortable({
        connectWith : '.sortable-list',
        stop: function(event, ui){
            var anterior_id = $(this).attr("id");
            var unidad_id = $(ui.item).parent().attr('id');
            var item = $(ui.item).attr('id');
            if(unidad_id == 0 && anterior_id == 0){
                texto = "No es Posible realizar la operación";
            }else{
                texto = "ahora: "+unidad_id+"\n";
                texto += "antes: "+anterior_id+"\n";
                texto += "item: "+item+"\n";
                agregarIntegrante(item, unidad_id,anterior_id);
            }
            console.log(texto);
        },
    });
});