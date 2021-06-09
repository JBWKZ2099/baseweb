<script>
	$(function(){
		$("#form-validation").formValidation({
			locale: "es_ES",
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
				last_name: {
					validators: {
						notEmpty:{},
						stringLength: {
							min: 3,
							max: 255
						}
					}
				},
				username: {
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
								message: "Ejemplo: correo@ejemplo.com",
								regexp: /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/
						}
					}
				},
				password: {
					validators: {
						notEmpty: {},
						stringLength: {
							min: 6,
							max: 20
						},
						identical_password: {
						    field: 'password_confirm'
						}
					}
				},
				password_confirm: {
					validators: {
						notEmpty: {},
						stringLength: {
							min: 6,
							max: 20
						},
						identical_password: {
						    field: 'password'
						}
					}
				}
			}
		});

		$("#permission_superadmin").click(function(e){
			if( !$("#permissions-container").is(":visible") )
				$("#permissions-container").show(500);
			else
				$("#permissions-container").hide(500);
		});

		if( $("#permission_superadmin").prop("checked") )
			$("#permissions-container").hide(500);
		else
			$("#permissions-container").show(500);

		$(`#permissions-container table input[type="checkbox"]`).click(function(){
			is_checked = $("#permissions-container #permission_admin").prop("checked");

			if( !is_checked )
				$("#permissions-container #permission_admin").trigger("click");
		});
	});
</script>
