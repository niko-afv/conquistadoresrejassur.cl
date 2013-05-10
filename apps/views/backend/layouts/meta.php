<title><?php echo $title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--BootStrap-->
<link href="<?php echo base_url();?>bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>/css/bo.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>/css/bo2.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="<?php echo base_url();?>/js/jquery-1.8.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/js/jquery.functions.js"></script>
<script type="text/javascript">
<!--
$(document).ready(function(){
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
	$("#sidebar ul li ul").hide();    
    $("#sidebar ul li span.current").addClass("open").next("ul").show();
    $("#sidebar ul li span").click(function(){    
        $(this).next("ul").slideToggle("normal").parent("li").siblings("li").find("ul:visible").slideUp("normal");
        $(this).toggleClass("open");
        $(this).parent("li").siblings("li").find("span").removeClass("open");
    });
});
-->
</script>