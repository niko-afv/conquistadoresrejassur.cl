<?php

$html = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>";
$html .= "<html xmlns='http://www.w3.org/1999/xhtml'>;";
$html .=    "<head>";
$html .= "<title>".$title."</title>";
$html .= "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";

$html .= "<link href='".base_url()."vendors/bootstrap/css/bootstrap.css' rel='stylesheet' type='text/css' media='screen, print' />";
$html .= "<link href='".base_url()."vendors/jquery-ui/css/smoothness/jquery-ui-1.10.3.custom.min.css' rel='stylesheet' type='text/css' media='screen, print' />";
$html .= "<link href='".base_url()."css/bo.css' rel='stylesheet' type='text/css' media='screen, print' />";
$html .= "<link href='".base_url()."css/bo2.css' rel='stylesheet' type='text/css' media='screen, print' />";
$html .= "<!--JQuery & UI-->";
$html .= "<script type='text/javascript' src='".base_url()."js/jquery-1.8.1.min.js'></script>";
$html .= "<script type='text/javascript' src='".base_url()."js/jquery.functions.js'></script>";
$html .= "<script type='text/javascript' src='".base_url()."vendors/jquery-ui/js/jquery-ui-1.10.3.custom.min.js'></script>";

$html .= "<script src='http://devheart.org/examples/jquery-customizable-layout-using-drag-and-drop/2-saving-and-loading-items/jquery.cookie.js'></script>";

$html .= "<script type='text/javascript' src='".$base_url."js/AjaxUpload.2.0.js'></script>";
$html .= "<script type='text/javascript' src='".$base_url."js/upload/upload.js'></script>";
$html .= "<script type='text/javascript' src='".$base_url."js/main.js'></script>";
$html .= "<link rel='stylesheet' type='text/css' href='".$base_url."js/upload/css/upload.css'>";


$html .= "<script type='text/javascript'>";

$html .= "$(document).ready(function(){
	//slide up header
	$('#header-pin').toggle(function(){
		$.post('http://niko-afv.no-ip.info/conquistadoresrejassur.cl/index.php/bo/pin',{'pin':'hp'},'json');
		$('#header, #main, #footer').animate({top: '-122px'},'slow');
		$(this).css({backgroundImage:'url(http://niko-afv.no-ip.info/conquistadoresrejassur.cl/images/pinh-close.jpg)'});		
	},function(){
		$.post('http://niko-afv.no-ip.info/conquistadoresrejassur.cl/index.php/bo/pin',{'pin':'hd'},'json');
		$('#header, #main, #footer').animate({top: '0'},'slow');
		$(this).css({backgroundImage:'url(http://niko-afv.no-ip.info/conquistadoresrejassur.cl/images/pinh-open.jpg)'});
	});
	//side left sidebar
	$('#sidebar-pin').toggle(function(){
		$.post('http://niko-afv.no-ip.info/conquistadoresrejassur.cl/index.php/bo/pin',{'pin':'vl'},'json');
		$('#sidebar').animate({left: '-172px'});
		$('#title,#content, #footer').animate({marginLeft: '27px'});		
		$(this).css({backgroundImage:'url(http://niko-afv.no-ip.info/conquistadoresrejassur.cl/images/pinv-close.jpg)'});
	},function(){
		$.post('http://niko-afv.no-ip.info/conquistadoresrejassur.cl/index.php/bo/pin',{'pin':'vr'},'json');
		$('#sidebar').animate({left: '0'});
		$('#title,#content, #footer').animate({marginLeft: '200px'});		
		$(this).css({backgroundImage:'url(http://niko-afv.no-ip.info/conquistadoresrejassur.cl/images/pinv-open.jpg)'});	
	});
	//time
	getthedate();
	goforit();
	//sidebar
	$('#sidebar ul li ul').hide();    
    $('#sidebar ul li span.current').addClass('open').next('ul').show();
    $('#sidebar ul li span').click(function(){    
        $(this).next('ul').slideToggle('normal').parent('li').siblings('li').find('ul:visible').slideUp('normal');
        $(this).toggleClass('open');
        $(this).parent('li').siblings('li').find('span').removeClass('open');
    });
});

</script>
    </head>
    <body>
<table class='table table-hover table-bordered table-condensed'>
    <thead>
        <tr class='form-title'>
            <th>Flujo</th>";
            for($i = $desde; $i <= $hasta; $i++){
            $html .= "<th>".$meses[$i]."</th>";
            }
$html .= "        </tr>
    </thead>
    <tbody>";
        $o = 0;
        foreach($cuentas['ingresos'] as $item => $val){
            $o++;
            $html .= "<tr id='ventas'>";
            $html .= "  <td>
                            <table style='width: 100%'>
                                <thead>";
                        if($o==1){
                            $html .= "  <tr>
                                            <th><h5>Ingresos</h5></th>
                                        </tr>";
                        }
                        $html .= "<tr>";
                        $html .= "<th>".$val['nombre']."</th>
                        </tr>
                    </thead>
                    <tbody>";
                        foreach($val['subCategorias'] as $item2 => $val2){
                            $html .= "<tr>";
                            $html .= "<td>".$val2['nombre']."</td>                            
                            </tr>";
                        }
                    $html .= "</tbody>
                </table>
            </td>";
            for($i = 0; $i <= 5; $i++){
            $html .= "<td>
                <table style='width: 100%'>
                    <thead>";
                        if($o==1){
                            $html .= "<tr>
                                <th><h5>&nbsp;</h5></th>
                            </tr>";
                        }
                        $html .= "<tr>
                            <th>
                                Total $".$val['total'][date("Y-m", strtotime($fecha." +$i month"))].
                            "</th>
                        </tr>
                    </thead>
                    <tbody>";
                        foreach($val['subCategorias'] as $item2 => $val2){
                            $html .= "<tr>";
                            if(isset($val2['periodos'][date("Y-m", strtotime($fecha." +$i month"))])){
                                $html .= "<td>$ ".$val2['periodos'][date("Y-m", strtotime($fecha." +$i month"))]['montos']."</td>";
                            }else{
                                $html .= "<td>$ 0  </td>";
                            }
                            $html .= "</tr>";
                        }
                    $html .= "</tbody>
                </table>
            </td>";
            }
        $html .= "</tr>";
        }
        $html .= "<tr>
            <td colspan=7>
                <hr/>
            </td>
        </tr>";
        echo $html;
/*<!--******************************************EGRESOS*************************************************************************--
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
    </tbody>
</table>

<div class="clear"></div>
</body>
</html>*/