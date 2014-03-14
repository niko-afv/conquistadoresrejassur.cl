<script>
$(document).ready(function(){
    
    var date = new Date();
    var month = date.getMonth();
    
    $('.date').datepicker({
        autoclose: true,
        endDate: "today",
        format: "yyyy-mm-dd",
        language: "es",
        orientation: "top left",
        startDate: '-'+month+'m',
        todayBtn: "linked",
        weekStart: 6
    })
    
    $("select[name='cuenta']").chosen(function(){disable_search_threshold: 10});
    $("select[name='tipo_cuenta']").chosen({
        disable_search_threshold: 10
    }).change(function(event,value){
        $("select[name='cuenta']").html("");
        $.getJSON('/admin/flujo_caja_form/getCuentas',value, function(data){
            var html = "";
            for(var x in data.cuentas){
                html += "<optgroup label='"+data.cuentas[x].nombre+"'>";
                for(var i in data.cuentas[x].subCategorias){
                    html += "<option value ='"+data.cuentas[x].subCategorias[i].id+"'>";
                    html += data.cuentas[x].subCategorias[i].nombre;
                    html += "</option>";
                }
                html += "</optgroup>";
            }            
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

    <form action="/admin/flujo_caja_form" method="POST" autocomplete="off">
        <div class="bo-form span5">
            <div class="form-title">
                Seleccione Cuenta
            </div>
            
            <div class="form-item">
                <label>Tipo de Cuenta</label>
                <div class="input-group input-group-form">
                    <select class="form-control" name="tipo_cuenta" >
                        <option value="999999">Seleccione una opción</option>
                        <option value="1">Ingreso</option>
                        <option value="0">Egreso</option>
                    </select>                    
                </div>
            </div>

            <div class="form-item">                
                <label>Cuenta</label>
                <div class="input-group input-group-form">
                    <select name="cuenta" class="form-control"> </select>
                </div>
            </div>
                <?php echo form_error('cuenta');?>
            </div>

        <div class="bo-form span5">
            <div class="form-title">
                Información del Flujo
            </div>

            <div class="form-item">
                <label>Descripción</label>
                <div class="input-group input-group-form">
                    <input type="text" name="descripcion" placeholder="ej: 5 Pagos de Inscripcion" class="form-control" value="" />
                </div>
                <?php echo form_error('descripcion');?>
            </div>
            
            <div class="form-item">
                <label>Fecha</label>
                <div class="input-group input-group-form">
                    <div class="input-group date">
                        <input type="text" class="form-control" name="fecha">
                        
                        <span class="input-group-addon">
                            <i class="glyphicon glyphicon-th"></i>
                        </span>
                    </div>
                </div>
                <?php echo form_error('fecha');?>
            </div>

            <div class="form-item">
                <label>Monto</label>
                    <div class="input-group input-group-form">
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