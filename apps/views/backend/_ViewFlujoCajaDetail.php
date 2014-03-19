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


<?php
    function format($amount){
        return number_format($amount,0,',','.');
    }
?>

<input type="hidden" id="temp"  />


<h4><?php echo $nomCuenta;?></h4>

<div style="width: 500px;">
    <table class='table table-hover table-bordered table-condensed'>
        <thead>
            <tr>
                <th >Mes 1</th>
            </tr>
            <tr class="form-title">
                <th>Fecha</th>
                <th>Descripción</th>
                <th>Monto</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($movimientos as $item => $val){ ?>
                <tr id="<?php echo $val['id'];?>">
                    <td>
                        <?php echo $val['fecha'];?>
                    </td>

                     <td class="link">
                        <?php echo $val['descripcion'];?>
                    </td>

                    <td>
                        Total $ <span><?php echo format($val['monto']);?></span>
                    </td>
                </tr>
            <?php }?>
        </tbody>
    </table>
</div>

<div class="clear"></div>