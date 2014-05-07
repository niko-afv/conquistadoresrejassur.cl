<div id="error2" class="alert alert-error" style="display: none;">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <div></div>
</div>

<div id="success2" class="alert alert-success" style="display: none;">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <div></div>
</div>

<script>
$(function(){
    $("#toPDF").on("click", function(e){
        e.preventDefault();
        var original_src = $(this).find("img").attr("src");
        $(this).find("img").attr("src","http://media.jumpingjack.com/JumpingJack/loading.gif");
        
        var matriz = new Array();
        $("tbody tr").each(function(i){
            var id = $(this).attr("id");
            var valores = new Array();
            
            $(this).find("input").each(function(i){
                valores[i]= $(this).val();
            });
            matriz[id] = valores;
        });
        
        $.post($("#toPDF").attr("href"),{matriz:matriz}, function(data){
            $("#toPDF").find("img").attr("src",original_src);
            data = JSON.parse(data)
            console.log(data.file);
            //window.location.href = data.file;
            window.open(data.file, '_blank');
        })
    });
})
</script>

<form method="POST">
<table class='table table-hover table-bordered table-condensed'>
    <thead>
    <tr class="form-title">
        <td>N°</td>
        <?php foreach($template['campos'] as $campo){?>
            <th><?php echo $campo['nombre'];?></th>
        <?php }?>
    </tr>
    </thead>
    <tbody>
    <?php $i=0;?>
    <?php foreach($entidad['lista'] as $item){?>
        <?php $i++;?>
        <tr id="<?php echo $i;?>">
            <td><?php echo $i;?></td>
            <?php foreach($template['campos'] as $campo){?>                
                <td><?php if(isset($item[$campo['nombre']])){ echo $item[$campo['nombre']]; }else{ echo "<input type='text' name='". $campo['nombre'] ."' placeholder='Ingrese un valor'  />";} ?></td>
            <?php }?>
        </tr>
    <?php }?>
    </tbody> 
</table>
</form>
<a id="toPDF" title="Descargar a PDF" style="float: right;" href="/admin/listados_form/toPdf/<?php echo $id;?>"><img alt="logo-pdf" src="/images/pdf-download-icon.png" width="32" height="38" /></a>

<div class="clear"></div>