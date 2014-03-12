<script>
$(document).ready(function(){
    $("select[name='cuenta']").chosen(function(){disable_search_threshold: 10});
    $("select[name='tipo_cuenta']").chosen({
        disable_search_threshold: 10
    }).change(function(event,value){
        $.getJSON('/admin/flujo_caja_form/getCuentas',value, function(data){
            $("select[name='cuenta']").html("");
            var html = "";
            for(var i in data.cuentas){
                html += "<option value ='"+data.cuentas[i].id+"'>";
                html += data.cuentas[i].nombre;
                html += "</option>";
            }
            console.log(html);
            $("select[name='cuenta']").append(html);
            $("select[name='cuenta']").trigger("chosen:updated");
        })
    });
    
});
</script>
<div class="row-fluid">
    <div id="error2" class="hidden alert alert-error">
        <!--<span><i class='icon-remove-sign'></i></span>-->
        <button type="button" class="close" data-dismiss="alert">×</button>
        <div></div>
    </div>

    <form action="/admin/flujo_caja_form" method="POST">
        <div class="bo-form span5">
            <div class="form-title">
                Seleccione Cuenta
            </div>
            
            <div class="form-item">
                <label>Tipo de Cuenta</label>
                <div class="input-group">
                    <select name="tipo_cuenta" >
                        <option value="1">Ingreso</option>
                        <option value="0">Egreso</option>
                    </select>                    
                </div>
                <?php echo form_error('cuenta');?>
            </div>

            <div class="form-item">
                <label>Cuenta</label>        
                <select name="cuenta" class="form-control"> </select>
            </div>
                <?php echo form_error('cuenta');?>
            </div>
        </div>

        <div class="bo-form span5">
            <div class="form-title">
                Información del Flujo
            </div>

            <div class="form-item">
                
                <label>Descripción</label>
                <div class="input-group">                        
                    <input type="text" name="descripcion" placeholder="ej: 5 Pagos de Inscripcion" class="form-control" value="" />
                </div>
                <?php echo form_error('descripcion');?>
            </div>

            <div class="form-item">
                <label>Monto</label>
                    <div class="input-group">
                        <span class="input-group-addon">$</span>                    
                        <input class="form-control" type="text" name="monto" placeholder="ej: 5000" size="10">
                    </div>
                <?php echo form_error('monto');?>            
            </div>

            <div class="form-item">
                <input type="submit" value="Guardar" class="btn btn-primary"    />
            </div>
        </div>
    </form>
</div>