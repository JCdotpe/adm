$(function(){

	$(document).on("keyup",'.btn-primary',function(e){
		var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0;
		if (key == 13)
			$(this).trigger('click');
	});

	$(window).keydown(function(event){
		if (event.keyCode == 13) {
			event.preventDefault();
			return false;
		}
	});

	$(document).on("keyup",'input,select,textarea',function(e){
		var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0;
		var inputs = $(this).closest('form').find(":input:not(:disabled, [readonly='readonly'],:hidden)");
		if (key == 13) {
			inputs.eq( inputs.index(this)+1 ).focus();
		}else if(key == 27){
			inputs.eq( inputs.index(this)-1).focus();
		}
	});

	$.extend(jQuery.validator.messages,{
		required:'Campo obligatorio',
		email:'Ingrese un email válido',
		date:'Ingrese una fecha válida',
		number:'Sólo se permiten números',
		digits:'Sólo se permiten números',
		range: jQuery.validator.format('Por favor ingrese un valor entre {0} y {1}.'),
		rangelength: jQuery.validator.format("Por favor ingrese entre {0} y {1} caracteres."),
	});

	$.validator.addMethod("EqualsUno", function(value, element, arg){
		flag = false;
		if ( parseFloat($('#' + arg[0]).val()) == parseFloat(value) ) { flag = true; }
		return  flag;
	}, "El Total de Meses diferente al Total General");

	$.validator.addMethod("EqualsDos", function(value, element, arg){
		flag = false;
		var cod = element.id;
		array=cod.split("_");
		if ( parseFloat(value) == parseFloat( $('#'+arg[0]+array[3]).val() ) ) { flag = true; }
		return  flag;
	}, "Total de Mes Incorrecto");

	$.validator.addMethod("EqualsTres", function(value, element, arg){
		flag = true;
		var cod = element.id;
		array=cod.split("_");
		var posi = parseInt(array[2]) + 1;

		if ( posi == $('#'+arg[1]).val())
		{
			var sum = 0;
			for (var i = 0; i < posi; i++) {
				valor = $('#'+array[0]+'_'+array[1]+'_'+i+'_'+array[3]).val();
				valor = (valor == '') ? 0 : valor;
				sum = parseFloat(sum) + parseFloat(valor);
			}
			if ( sum != $('#'+arg[0]+array[3]).val() ) { flag = false; }
		}
		return  flag;
	}, "Suma de Meses no coincide con Subtotal");

	$.validator.addMethod("valNotEquals", function(value, element, arg){
		flag = true;
		var name = arg[0];
		var nro = $('#'+arg[1]).val();
		var cod = element.id;

		for (var i = 0; i < nro; i++) {
			if ( (cod != (name+i)) && $('#'+name+i).val() == value ) return false
		}
		return  flag;
	}, "Codigo repetido");


});