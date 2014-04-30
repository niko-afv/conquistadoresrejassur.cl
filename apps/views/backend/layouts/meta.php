<title><?php echo $title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--JQuery & UI-->
<script src="http://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>
<link href="<?php echo base_url();?>vendors/jquery-ui/css/smoothness/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" type="text/css" media="print, screen" />
<!--<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.8.1.min.js"></script>-->
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.functions.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.jqprint.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>vendors/jquery-ui/js/jquery-ui-1.10.3.custom.min.js"></script>
<!--BootStrap-->
<link href="<?php echo base_url();?>vendors/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" media="print, screen" />
<script src="<?php echo base_url();?>vendors/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!--TypeaHead - AutoComplete-->
<link href="http://twitter.github.io/typeahead.js/css/examples.css" rel="stylesheet"   />
<script src="http://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js" type="text/javascript"></script>
<!--JQuery Sortable-->
<script src="http://devheart.org/examples/jquery-customizable-layout-using-drag-and-drop/2-saving-and-loading-items/jquery.cookie.js"></script>
<!--Upload & functions-->
<script type="text/javascript" src="<?php echo $base_url;?>js/AjaxUpload.2.0.js"></script>
<script type="text/javascript" src="<?php echo $base_url;?>js/upload/upload.js"></script>
<script type="text/javascript" src="<?php echo $base_url;?>js/main.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>js/upload/css/upload.css">
<!--Chosen-->
<script src="http://harvesthq.github.io/chosen/chosen.jquery.js" type="text/javascript"></script>
<link href="http://harvesthq.github.io/chosen/chosen.css" rel="stylesheet" type="text/css"   />
<!--Bootstrap DatePicker-->
<script src="<?php echo base_url();?>/vendors/bootstrap-datepicker-master/js/bootstrap-datepicker.js"></script>
<link href="<?php echo base_url();?>/vendors/bootstrap-datepicker-master/css/datepicker.css" rel="stylesheet"   />
<!--Checkbox & Radio Pickers-->
<script src="/vendors/Picker-master/jquery.fs.picker.min.js"></script>
<link href="/vendors/Picker-master/jquery.fs.picker.css" rel="stylesheet"   />
<!--Own Css-->
<link href="<?php echo base_url();?>css/bo.css" rel="stylesheet" type="text/css" media="print, screen"/>
<link href="<?php echo base_url();?>css/bo2.css" rel="stylesheet" type="text/css" media="print, screen" />

<script type="text/javascript">

$(document).ready(function(){
	//slide up header
	$('#header-pin').toggle(function(){
		/*$.post('http://niko-afv.no-ip.info/conquistadoresrejassur.cl/index.php/bo/pin',{'pin':'hp'},'json');*/
		$('#header, #main, #footer').animate({top: '-122px'},'slow');
		$(this).css({backgroundImage:'url(/images/pinh-close.jpg)'});		
	},function(){
		/*$.post('http://niko-afv.no-ip.info/conquistadoresrejassur.cl/index.php/bo/pin',{'pin':'hd'},'json');*/
		$('#header, #main, #footer').animate({top: '0'},'slow');
		$(this).css({backgroundImage:'url(/images/pinh-open.jpg)'});
	});
	//side left sidebar
	$('#sidebar-pin').toggle(function(){
		/*$.post('http://niko-afv.no-ip.info/conquistadoresrejassur.cl/index.php/bo/pin',{'pin':'vl'},'json');}*/
		$('#sidebar').animate({left: '-172px'});
		$('#title,#content, #footer').animate({marginLeft: '27px'});		
		$(this).css({backgroundImage:'url(/images/pinv-close.jpg)'});
	},function(){
		/*$.post('http://niko-afv.no-ip.info/conquistadoresrejassur.cl/index.php/bo/pin',{'pin':'vr'},'json');*/
		$('#sidebar').animate({left: '0'});
		$('#title,#content, #footer').animate({marginLeft: '200px'});		
		$(this).css({backgroundImage:'url(/images/pinv-open.jpg)'});	
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

</script>