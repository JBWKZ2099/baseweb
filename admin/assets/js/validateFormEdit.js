function validateMyForm(){
	var cadena =  /^([a-zA-Z]+)|([A-Za-z]+)/i;
	if($('#name').val() == '' || !cadena.test($('#name').val())){
		$('#name').focus();
		var posicion = $('#name').offset().top;
		posicion -= 170;
		$("html, body").animate({scrollTop:posicion+"px"});
        $("#alerts").html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><p>Ingresa un Nombre válido.</p></div>");
		
    	return false;
	}
	else if($('#subname').val() == '' || !cadena.test($('#subname').val())){
		$('#subname').focus();
		var posicion = $('#subname').offset().top;
		posicion -= 170;
		$("html, body").animate({scrollTop:posicion+"px"});
        $("#alerts").html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><p>Ingresa un Subnombre válido.</p></div>");
		
    	return false;
	}
	else if($('#url').val() == ''){
		$('#url').focus();
		var posicion = $('#url').offset().top;
		posicion -= 170;
		$("html, body").animate({scrollTop:posicion+"px"});
        $("#alerts").html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><p>Ingresa un Link válido.</p></div>");
		
    	return false;
	}
	else if($('#type').val() == ''){
		$('#type').focus();
		var posicion = $('#type').offset().top;
		posicion -= 170;
		$("html, body").animate({scrollTop:posicion+"px"});
        $("#alerts").html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><p>Ingresa un Tipo válido.</p></div>");
		
    	return false;
	}
}