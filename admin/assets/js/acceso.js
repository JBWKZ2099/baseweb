$('#password').keydown(function(e) {
	if(e.keyCode == 13) $('#acceso').trigger('click');
});
$('#acceso').click(function(e){
	if ($('#user').val() == '') {
		$('#user').focus();
		var posicion = $('#user').offset().top;
		posicion -= 170;
		$("html, body").animate({scrollTop:posicion+"px"});
        $("#alerts").html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><p>El usuario es forzoso.</p></div>");
	}
	else if ($('#password').val() == '') {
		$('#password').focus();
		var posicion = $('#password').offset().top;
		posicion -= 170;
		$("html, body").animate({scrollTop:posicion+"px"});
        $("#alerts").html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><p>El password es forzoso.</p></div>");
	}
	else{
		$.ajax({
			type: 'POST',
			url: 'php/procesar-login.php',
			data:{
				user: $('#user').val(),
				password: $('#password').val(),
			},
			success: function(result){
				if(result == 1){
					window.location = 'panel-control.php';
				}
				else if(result == 0){
					$('#alerts').html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><p>El usuario o contraseña son incorrectos.</p></div>");
				}
			},
			error: function(result){
				console.log(result);
			}
		});
	}
});