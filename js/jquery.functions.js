// JavaScript Document
$(document).ready(function(){
	$(".clean").each(function(){
		var value = $(this).val();
		$(this).focusin(function(){if($(this).val() == value){$(this).val("");};});
		$(this).focusout(function(){if($(this).val() == ''){$(this).val(value);};});
	});
});

/*********************************************/
/*********** JAVASCRIPT VALIDATION ***********/
/*********************************************/
function ValidaRut(Objeto){
	var tmpstr = "";
	var intlargo = Objeto;
	if (intlargo.length> 0){
		crut = Objeto;largo = crut.length;
		if ( largo <2 ){
			//alert('Rut inválido');
			return false;
		}for ( i=0; i <crut.length ; i++ )
		if ( crut.charAt(i) != ' ' && crut.charAt(i) != '.' && crut.charAt(i) != '-' ){
			tmpstr = tmpstr + crut.charAt(i);
		}rut = tmpstr;crut=tmpstr;largo = crut.length;
		if ( largo> 2 ) rut = crut.substring(0, largo - 1);
		else rut = crut.charAt(0);
		dv = crut.charAt(largo-1);	
		if ( rut == null || dv == null )
		return 0;	
		var dvr = '0';suma = 0;mul  = 2;
		for (i= rut.length-1 ; i>= 0; i--){
			suma = suma + rut.charAt(i) * mul;
			if(mul == 7) mul = 2;
			else mul++;
		}res = suma % 11;
		if (res==1) dvr = 'k';
		else if (res==0) dvr = '0';
		else{ dvi = 11-res;dvr = dvi + "";}	
		if ( dvr != dv.toLowerCase() ){
			//alert('El Rut Ingreso es Invalido');
			return false;
		}return true;
	}
}
function isDate(dateStr) {
	var datePat = /^(\d{1,2})(\/|-)(\d{1,2})(\/|-)(\d{4})$/;
	var matchArray = dateStr.match(datePat);
	if (matchArray == null) {
		return false;
	}
	month = matchArray[3];
	day = matchArray[1];
	year = matchArray[5];
	if (month < 1 || month > 12) {
		return false;
	}
	if (day < 1 || day > 31) {
		return false;
	}
	if ((month==4 || month==6 || month==9 || month==11) && day==31) {
		//alert("Month "+month+" doesn`t have 31 days!")
		return false;
	}
	if (month == 2) { // check for february 29th
		var isleap = (year % 4 == 0 && (year % 100 != 0 || year % 400 == 0));
		if (day > 29 || (day==29 && !isleap)) {
			return false;
		}
	}
	return true; // date is valid
}


function msg(er){
    $('#error, #error2').html(er).fadeIn("slow",function(){
        $(this).fadeOut(6000);
    });
}
function msg2(er){
    $('#error').fadeIn("slow",function(){
        $(this).find('div').html(er);
    });
}

/*********************************************/
/****************** ON AIR *******************/
/*********************************************/
function IsNumber(e) {
	/*onkeypress="return IsNumber(event);"*/
	tecla = (document.all) ? e.keyCode : e.which;
	if (tecla==8 || tecla==0) return true;
	patron = /\d/; // Solo acepta numeros
	te = String.fromCharCode(tecla);
	return patron.test(te);
}
function IsNombre(e){
	/*onkeypress="return IsNombre(event);"*/
	tecla = (document.all) ? e.keyCode : e.which;
	if (tecla==8 || tecla==0) return true;
	patron = /[a-zA-ZáéíóúñÁÉÍÓÚÑ\s-]/;
	te = String.fromCharCode(tecla);
	return patron.test(te); 
}
function IsTexto(e){
	/*onkeypress="return IsTexto(event);"*/
	tecla = (document.all) ? e.keyCode : e.which;
	if (tecla==8 || tecla==0) return true;
	patron = /[a-zA-Z0-9_.,:;?¿!¡@áéíóúñÁÉÍÓÚÑ\s-]/;
	te = String.fromCharCode(tecla);
	return patron.test(te); 
}

function IsRut(e){
	/*onchange="return IsRut(event);" or onkeypress="return IsRut(event);" undefined*/
	tecla = (document.all) ? e.keyCode : e.which;
	if (tecla==8 || tecla ==0) return true;
	patron = /[-kK0123456789\s-]/;
	te = String.fromCharCode(tecla);
	return patron.test(te)
} 

function IsFijo(e){
	/*onkeypress="return IsRut(event);"*/
	tecla = (document.all) ? e.keyCode : e.which;
	if (tecla==8 || tecla ==0) return true;
	patron = /[0123456789\s\/]/;
	te = String.fromCharCode(tecla);
	return patron.test(te)
} 
function isEmailAddress(stremail){
	/*onchange="isEmailAddress(this.value)"*/
	var s = stremail
	var filter=/^[A-Za-z][A-Za-z0-9_.]*@[A-Za-z0-9_]+\.[A-Za-z0-9_.]+[A-za-z]$/;
	if (s.length == 0 ) return true;
	if (filter.test(s))
	return true;
	else
	return false;
} 

/*********************************************/
/***************** BO CLOCK ******************/
/*********************************************/
function getthedate(){
	var mydate=new Date()
	var hours=mydate.getHours()
	var minutes=mydate.getMinutes()
	var seconds=mydate.getSeconds()
	var dn="AM"
	if (hours==0)
	hours=12
	if (minutes<=9)
	minutes="0"+minutes
	if (seconds<=9)
	seconds="0"+seconds
	var cdate=""+hours+":"+minutes+":"+seconds
	if (document.all)
	document.all.relog.innerHTML = cdate
	else if (document.getElementById)
	document.getElementById("relog").innerHTML = cdate
	else
	document.write(cdate)
}
function goforit(){
	if (document.all||document.getElementById)
	setInterval("getthedate()",1000)
}