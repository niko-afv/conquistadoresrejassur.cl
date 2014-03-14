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
            <?php
                foreach($meses as $numeral => $mes){?>
                <th><?php echo $mes['palabras'] ?></th>
                <?php }
            ?>

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
            <?php $totalIngresos[$i] = $val['periodos'][date("Y-m", strtotime($fecha." +$i month"))];?>
            <td>
                Total $<?php echo $val['periodos'][date("Y-m", strtotime($fecha." +$i month"))]['montos'];?>
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
        
    </tbody>
</table>

<div class="clear"></div>