<?php
    $totalIngresos=array(
        0 => 0,1 => 0,2 => 0,
        3 => 0,4 => 0,5 => 0
    );
    $totalEgresos=array(
        0 => 0,1 => 0,2 => 0,
        3 => 0,4 => 0,5 => 0
    );
    
    function format($amount){
        return number_format($amount,0,',','.');
    }
?>
<script>
    function formatear(number){
        var result = '';

        while( number.length > 3 ){
            result = '.' + number.substr(number.length - 3) + result;
            number = number.substring(0, number.length - 3);
        }
        result = number + result;
        return result;
        };
    
    $(document).ready(function(){
        
        $(".txc").each(function(){
            $("#temp").val(0);
            $(this).parent().find(".amount").each(function(){
                var valor2 = parseInt($("#temp").val());
                var valor1 = parseFloat($(this).attr("id"));
                $("#temp").val(valor1 + valor2);         
            });
            var total = "$ " + formatear($("#temp").val());
            
            if($(this).children("h6").children("a").length > 0){
                $(this).children("h6").children("a").html(total);
            }else{
                $(this).html(total);
            }
        });
        
        $("#content").on('click','.flow-detail', function(){
            var $dinamic_table = $("#dinamic-table");
            
            $dinamic_table.fadeOut("slow");
            
            var url = "http://devel.conquistadoresrejassur.cl/admin/flujo_caja/subCatDetailList/";
            var id = $(this).parent().parent().attr("id");
            
            $dinamic_table.load(url,{id_cat : id}, function(data){
                $dinamic_table.fadeIn("slow");
            })
        });
        
    });
</script>

<input type="hidden" id="temp">
    
</span>
<table class='table table-hover table-bordered table-condensed'>
    <thead>
        <tr class="form-title">
            <th>Flujo</th>
            <?php
                foreach($meses as $numeral => $mes){?>
                <th><?php echo $mes['palabras'] ?></th>
                <?php }
            ?>
                <th>Total P/Cuenta</th>
                <th>Ir al Detalle</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="7" style="text-align: center;">
                <h4><?php echo $nomCuentaPadre;?></h4>
            </td>
        </tr>
        
        <?php $o = 0;?>
        <?php foreach($cuentas['ingresos'] as $item => $val){$o++ ?>
        
        <tr id="<?php echo $val['id'];?>">
            <td class="link">
                <?php echo $val['nombre'];?>
            </td>
            <?php for($i = 0; $i <= 5; $i++){?>
            
            <?php $totalIngresos[$i] += $val['periodos'][date("Y-m", strtotime($fecha." +$i month"))]['montos'];?>
            <td>
                <?php $valor = $val['periodos'][date("Y-m", strtotime($fecha." +$i month"))]['montos']?>
                Total $ <span id="<?php echo $valor?>" class="amount"><?php echo format($valor);?></span>
            </td>
            <?php }?>
            
            <td class="txc"></td>
            
            <!--Acciones-->
            <td>
                <a href="javascript:void(0);" class='glyphicon glyphicon-list flow-detail'></a>
            </td>
        </tr>
        <?php }?>
        <tr>
            <td><h6><a href="javascript:void(0)">Total General de Ingresos P/Mes</a></h6></td>
            
            <?php foreach($totalIngresos as $item){?>
            <td>                
                <h6><a class="total-amount amount" id="<?php echo $item;?>" href="javascript:void(0)">$ <?php echo format($item);?></a></h6>
            </td>
            <?php }?>
            
            <td class="txc">
                <h6><a class="total-amount" href="javascript:void(0);"></a></h6>
            </td>
            
            <!--Acciones-->
            <td>
                <a href="javascript:void(0);" class='glyphicon glyphicon-list link-subcat'></a>
            </td>
        </tr>
        
    </tbody>
</table>

<div class="clear"></div>