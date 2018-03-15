function validateMyForm(){
	var cadena =  /^([a-zA-Z]+)|([A-Za-z]+)/i;
	var emailreg =  /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
	if($('#name').val() == '' || !cadena.test($('#name').val())){
		$('#name').focus();
		var posicion = $('#name').offset().top;
		posicion -= 170;
		$("html, body").animate({scrollTop:posicion+"px"});
        $("#alerts").html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><p>Ingresa un Nombre válido.</p></div>");
		
    	return false;
	}
	else if($('#username').val() == '' || !cadena.test($('#username').val())){
		$('#username').focus();
		var posicion = $('#username').offset().top;
		posicion -= 170;
		$("html, body").animate({scrollTop:posicion+"px"});
        $("#alerts").html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><p>Ingresa un Subnombre válido.</p></div>");
		
    	return false;
	}
	else if($('#email').val() == '' || !emailreg.test($('#email').val())){
		$('#email').focus();
		var posicion = $('#email').offset().top;
		posicion -= 170;
		$("html, body").animate({scrollTop:posicion+"px"});
        $("#alerts").html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><p>Ingresa un Link válido.</p></div>");
		
    	return false;
	}
	else if($('#permission').val() == ''){
		$('#permission').focus();
		var posicion = $('#permission').offset().top;
		posicion -= 170;
		$("html, body").animate({scrollTop:posicion+"px"});
        $("#alerts").html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><p>Ingresa un Tipo válido.</p></div>");
		
    	return false;
	}
	else if($('#password').val() == ''){
		$('#password').focus();
		var posicion = $('#password').offset().top;
		posicion -= 170;
		$("html, body").animate({scrollTop:posicion+"px"});
        $("#alerts").html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><p>Ingresa una Imagen válida.</p></div>");
		
    	return false;
	}
}