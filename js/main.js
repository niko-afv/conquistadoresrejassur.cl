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


/*DOCUMENT READY*/
$(function(){

    //Foto Integrante
    $("#upload").upload({
        galery:{
            content :   '#galeryIntegrante', /*no opcional*/
            views   :   ['460x816'],        /*no opcional*/
            count   :   1
        },
        image:{
            path   :    'integrantes',
            types  :    'jpg,png,jpeg,gif',
            size   :    2000,
            width  :    1840,
            height :    3264
        }
    });

    $(".delete-reg").on("click",eliminarIntegrante);    

});