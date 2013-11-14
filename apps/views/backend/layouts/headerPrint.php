<style>
    span{
        display: inline-block;        
        height: 20px;
        padding: 5px;
        width: auto;
    }
    .key{
        font-weight: bold;
    }
    .column-left{
        float: left;
        width: 605px;
    }
    .column-right{
        float: right;
    }
    .row-header-print{
        display: block;
        width: 605px;
        float: left;
    }
    .row-header-print-right{
        vertical-align: top;
        float: right;
    }
    .item-header-print{
        display: inline-block;
        width: 300px;
    }
    
</style>
<div class="column-left">
    <div class="row-header-print">
        <div class="item-header-print">
            <span class="key">Nombre Informe: </span>  <span class="value"><?php echo $category_title ?></span>
        </div>

        <div class="item-header-print">
            <span class="key">Cantidad de Registros: </span>  <span class="value"><?php echo $num_rows ?></span>
        </div>
    </div>

    <div class="row-header-print">
        <div class="item-header-print">
            <span class="key">Fecha Impresión: </span>  <span class="value"><?php echo date("d - M - Y"); ?></span>
        </div>
        <div class="item-header-print">
            <span class="key">Hora Impresión: </span>  <span class="value"><?php echo date("H:m"); ?></span>
        </div>
    </div>
</div>

<div class="column-right">
    <div class="row-header-print">
        <div class="item-header-print">
            <span class="key">Nombre Informe: </span>  <span class="value"><?php echo $category_title ?></span>
        </div>

        <div class="item-header-print">
            <span class="key">Cantidad de Registros: </span>  <span class="value"><?php echo $num_rows ?></span>
        </div>
    </div>
</div>