/*
* Created by Pedro Montero 
* version 0.0.1
* call $('selector').upload({'location' : 'left'});
* Copyright (c) 2012
*
*/
(function($){
  $.fn.upload = function(options){  
    var settings = {
		galery:{
			content : null,
			views   : null,
			count   : 1
		},
		image:{
			 path   : null,
        	 types  : 'jpg,png,jpeg,gif', /* incoming new files to uploads doc,pdf,xls,xlsx*/
			 size   : 1000,
			 width  : 1024, 
			 height : 768,
			 thumb	:null
		},
		name: $(this).attr('id'),
		upload: '/conquistadoresrejassur.cl/index.php/backend/upload/image'
    };
	/*re asignacion de variables nulas*/
	if(options.galery.content == null){options.galery.content=null}
	if(options.galery.views == null){options.galery.views=null}
	if(options.image.path == null){options.image.path=null}
	if(options.image.thumb == null){options.image.thumb=null}	
	/*Thumb inicial vista en backoffice*/
	if(options.image.thumb == null){
		totalThumb = options.galery.views
	}else{
		totalThumb = options.galery.views+','+options.image.thumb;
	}		
	
	var options = $.extend(settings, options);  			
    return this.each(function() {     
		el = $(this);
		new AjaxUpload(el, {
			action: options.upload,
			onSubmit : function(file,ext){
				if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){
					msg('Extensiones permitidas '+options.image.types);
					return false;
				}else{
					var n = $(options.galery.content).find('span').length+1;
					if(n>options.galery.count){
						msg('Excede el máximo de imagenes permitidas');
						return false
					}				
				}
			},
			dataType: "json",
			data:{
				  path:options.image.path,
				  types:options.image.types,
				  size:options.image.size,
				  width:options.image.width,
				  height:options.image.height,
				  thumb:totalThumb
				  },
			onComplete: function(file, response){					
				 var view = options.galery.views.toString(); 
				 var arr  = view.split('x');
				 var rs =  response.split(',');
				 if(rs[0]=='ok'){
				 	crateImage(options.name,rs[1],arr[0],arr[1]);
				 }else{
					msg(rs[0]);
				 }			 
			}
		});			 
    });
	function crateImage(name,img,w,h){
		var content = $(options.galery.content);
		var input = $('#'+name).attr('id');
			input = 'img'+input.slice(0,1).toUpperCase()+input.slice(1);
		var n = $(content).find('span').length+1;
		deleteName =  "'"+input+n+"'";
		var html = '<span>';
			html += '<a class="delete" onclick="deleteImage('+deleteName+');">del</a>';
			html += '<img src="'+img+'" width="'+w+'" height="'+h+'" />';
			html += '<input type="hidden" id="'+input+n+'" name="'+input+n+'" value="'+img+'">';
			html += '</span>';
		$(content).append(html);
		$(content).children('span').css({position:'relative',float:'left'}).addClass('im');
	}	
  };
})(jQuery);

function deleteImage(id){
	var em = $('#'+id);
	var image = $(em).attr('value');		
	$.post('/bo/home/deleteImage',{'img' : image}, function(data){
		if(data){$(em).parent().fadeOut(1000,function(){
				$(this).remove();
		});}
	},'json');	
}

