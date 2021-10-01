$(document).ready(function() {
	$('#contact-form').formValidation({
		locale: 'es_ES',
		fields: {
			name: {
				validators: {
					notEmpty:{},
					stringLength: {
						min: 3,
						max: 255
					}
				}
			},
			email: {
				validators: {
					notEmpty: {},
					emailAddress: {},
					regexp: {
							regexp: /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/,
							message: "Ejemplo: correo@ejemplo.com"
					}
				}
			},
			msg: {
				validators: {
					notEmpty: {},
					stringLength: {
						min: 20,
						max: 500
					}
				}
			}
		}
	});
});