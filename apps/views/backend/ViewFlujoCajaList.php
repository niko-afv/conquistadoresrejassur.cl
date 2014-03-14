<script type="text/javascript">
    $(document).on('ready', function(){
        $("#content").on('click','.link-subcat', function(){
            var $dinamic_table = $("#dinamic-table");
            
            $dinamic_table.fadeOut("slow");
            
            var url = "http://devel.conquistadoresrejassur.cl/admin/flujo_caja/subCatList/";
            var id = $(this).parent().parent().attr("id");
            $dinamic_table.load(url,{id_cat : id}, function(data){
                $dinamic_table.fadeIn("slow");
            })
        });
    })
</script>

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

<div id="dinamic-table">

<table class='table table-hover table-bordered table-condensed'>
    <thead>
        <tr class="form-title">
            <th>Flujo</th>
            <?php
                foreach($meses as $numeral => $mes){?>
                <th><?php echo $mes['palabras'] ?></th>
                <?php }
            ?>
                <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="7" style="text-align: center;">
                <h4>INGRESOS</h4>
            </td>
        </tr>
        
        <?php $o = 0;?>
        <?php foreach($cuentas['ingresos'] as $item => $val){$o++ ?>
        <tr id="<?php echo $val['id'];?>">
            <td class="link">
                <?php echo $val['nombre'];?>
            </td>
            <?php for($i = 0; $i <= 5; $i++){?>
            <?php $totalIngresos[$i] += $val['total'][date("Y-m", strtotime($fecha." +$i month"))]?>
            <td>
                Total $ <?php echo format($val['total'][date("Y-m", strtotime($fecha." +$i month"))]);?>
            </td>
            <?php }?>
            
            <!--Acciones-->
            <td>
                <a href="javascript:void(0);" class='glyphicon glyphicon-list link-subcat'></a>
            </td>
        </tr>
        <?php }?>
        <tr>
            <td><h6><a href="javascript:void(0)">Total Ingresos Por Mes</a></h6></td>
            <?php foreach($totalIngresos as $item){?>
            <td>
                <h6><a class="total-amount" href="javascript:void(0)">$ <?php echo format($item);?></a></h6>
            </td>
            <?php }?>
        </tr>
        
        
        <tr>
            <td colspan="7" style="text-align: center;">
                <h4>EGRESOS</h4>
            </td>
        </tr>

<!--***************************************************************************************************************************-->
<!--****************************************  EGRESOS  ************************************************************************-->
<!--***************************************************************************************************************************-->

        <?php $o = 0;?>
        <?php foreach($cuentas['egresos'] as $item => $val){$o++ ?>
        <tr class="link-subcat" id="<?php echo $val['id'];?>">
            <td class="link">
                <?php echo $val['nombre'];?>
            </td>
            <?php for($i = 0; $i <= 5; $i++){?>
            <?php $totalEgresos[$i] += $val['total'][date("Y-m", strtotime($fecha." +$i month"))]?>
            <td>
                Total $ <?php echo format($val['total'][date("Y-m", strtotime($fecha." +$i month"))]);?>
            </td>
            <?php }?>
            
            <!--Acciones-->
            <td>
                <a href="javascript:void(0);" class='glyphicon glyphicon-list link-subcat'></a>
            </td>
        </tr>
        <?php }?>
        <tr>
            <td><h6><a href="javascript:void(0)">Total Egresos Por Mes</a></h6></td>
            <?php foreach($totalEgresos as $item){?>
            <td>
                <h6><a class="total-amount" href="">$ <?php echo format($item);?></a></h6>
            </td>
            <?php }?>
        </tr>
    </tbody>
</table>


</div>

<div class="clear"></div>