<script>
    /*$(function(){
        $("table.table").jqprint({
            debug: false,        
            importCSS: true,        
            printContainer: true,        
            operaSupport: true
        });        
    });*/
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
?>

<table class='table table-hover table-bordered table-condensed'>
    <thead>
        <tr class="form-title">
            <th>Flujo</th>
            <?php for($i = $desde; $i <= $hasta; $i++){?>
            <th><?php echo $meses[$i];?></th>
            <?php }?>
        </tr>
    </thead>
    <tbody>
        <?php $o = 0;?>
        <?php foreach($cuentas['ingresos'] as $item => $val){$o++ ?>
        <tr id="ventas">
            <td>
                <table style="width: 100%">
                    <thead>
                        <?php if($o==1){?>
                        <tr>
                            <th><h5>Ingresos</h5></th>
                        </tr>
                        <?php }?>
                        <tr>
                            <th><?php echo $val['nombre'];?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($val['subCategorias'] as $item2 => $val2){?>                        
                        <tr>
                            <td><?php echo $val2['nombre'];?></td>                            
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </td>
            <?php for($i = 0; $i <= 5; $i++){?>
            <?php $totalIngresos[$i] += $val['total'][date("Y-m", strtotime($fecha." +$i month"))]?>
            <td>
                <table style="width: 100%">
                    <thead>
                        <?php if($o==1){?>
                        <tr>
                            <th><h5>&nbsp;</h5></th>
                        </tr>
                        <?php }?>
                        <tr>
                            <th>
                                Total $<?php echo $val['total'][date("Y-m", strtotime($fecha." +$i month"))];?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($val['subCategorias'] as $item2 => $val2){?>
                            <tr>
                            <?php if(isset($val2['periodos'][date("Y-m", strtotime($fecha." +$i month"))])){ ?>
                                <td>$ <?php echo $val2['periodos'][date("Y-m", strtotime($fecha." +$i month"))]['montos'];?></td>
                            <?php }else{?>
                                <td>$ 0  </td>
                            <?php }?>
                            </tr>
                        <?php }?>
                    </tbody>
                </table>
            </td>
            <?php }?>
        </tr>
        <?php }?>
        <tr>
            <td><h6><a href="javascript:void(0)">Total Ingresos Por Mes</a></h6></td>
            <?php foreach($totalIngresos as $item){?>
            <td>
                <h6><a href="javascript:void(0)">$<?php echo $item;?></a></h6>
            </td>
            <?php }?>
        </tr>
        <tr>
            <td colspan="7">
                <hr/>
            </td>
        </tr>
<!--******************************************EGRESOS*************************************************************************-->
        <?php $o = 0;?>
        <?php foreach($cuentas['egresos'] as $item => $val){$o++ ?>
        <tr id="ventas">
            <td>
                <table style="width: 100%">
                    <thead>
                        <?php if($o==1){?>
                        <tr>
                            <th><h5>Egresos</h5></th>
                        </tr>
                        <?php }?>
                        <tr>
                            <th><?php echo $val['nombre'];?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($val['subCategorias'] as $item2 => $val2){?>                        
                        <tr>
                            <td><?php echo $val2['nombre'];?></td>                            
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </td>
            <?php for($i = 0; $i <= 5; $i++){?>
            <?php $totalEgresos[$i] += $val['total'][date("Y-m", strtotime($fecha." +$i month"))]?>
            <td>
                <table style="width: 100%">
                    <thead>
                        <?php if($o==1){?>
                        <tr>
                            <th><h5>&nbsp;</h5></th>
                        </tr>
                        <?php }?>
                        <tr>
                            <th>
                                Total $<?php echo $val['total'][date("Y-m", strtotime($fecha." +$i month"))];?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($val['subCategorias'] as $item2 => $val2){?>
                            <tr>
                            <?php if(isset($val2['periodos'][date("Y-m", strtotime($fecha." +$i month"))])){ ?>
                                <td>$ <?php echo $val2['periodos'][date("Y-m", strtotime($fecha." +$i month"))]['montos'];?></td>
                            <?php }else{?>
                                <td>$ 0  </td>
                            <?php }?>
                            </tr>
                        <?php }?>
                    </tbody>
                </table>
            </td>
            <?php }?>
        </tr>
        <?php }?>
        <tr>
            <td><h6><a href="javascript:void(0)">Total Egresos Por Mes</a></h6></td>
            <?php foreach($totalEgresos as $item){?>
            <td>
                <h6><a href="javascript:void(0)">$<?php echo $item;?></a></h6>
            </td>
            <?php }?>
        </tr>
    </tbody>
</table>

<div class="clear"></div>