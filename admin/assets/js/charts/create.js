$(document).ready(function() {
	fillCustomerSelect();
	$("#upload_excel")[0].reset();


	$("#customer").change(function(e){
		var which = $(this).val();

		$.ajax({
			url: direction+"/db/requests.php",
			type: "POST",
			dataType: "json",
			data: {id_user: which, request: "check-customer-data" },
			beforeSend: function() {
				$("#verifying").slideDown(300);
			},
			success: function(response) {
				if( response.has_data ) {
					initAlert("alert-warning","<ul> <li>Los datos del cliente seleccionado se van a actualizar.</li> </ul>")
					$("#update_data").val("1");
				} else 
					$("#update_data").val("0");

				$("#verifying").slideUp(300);
			}
		});
	});

	$("#process-file").click(function(e) {
		var customer = $("#customer").val();
		var excel = $("#excel").val();

		if( customer!="null" && excel!="" ) {
			var re = /(\.xlsx)$/i;
			// var re2 = /(\.xls)$/i;

			if( re.exec( excel ) /*|| re2.exec( excel )*/ ) {
				var route = direction+"/db/requests.php";
				var formData = new FormData(document.getElementById("upload_excel"));
				formData.append("request", "upload-file");

				setModalText( "processing-file", "Se está subiendo el archivo al servidor..." );
				
				$("#processing-file").modal("show");

				$.ajax({
					url: route,
					type: "POST",
					data: formData,
	        cache: false,
	        contentType: false,
	        processData: false,
	        success: function( response ) {
	        	if( response.status == "upload_ok" ) {
							setModalText( "processing-file", "Se está procesando el archivo..." );
							var _file_name = response.file_name;
							var _update_check = $("#update_data").val();

							$.ajax({
								url: route,
								type: "POST",
								data: {
									customer: customer,
									request_input: "process",
									file_name: _file_name,
									update_data: _update_check,
									request: "process-file"
								},
								success: function( resp ) {
									if( resp.db_populate == "ready" ) {
										$("#processing-file").modal("hide");
										var alert_text = "<ul> <li>El archivo se subió con éxito.</li> <li>Se procesaron y almacenaron los datos del archivo extitosamente.</li> </ul>";
										initAlert( "alert-success", alert_text );
										setModalText( "processing-file", "El proceso se completó, si no se cierra esta ventana, por favor refresque la ventana (F5)." );

										/*Reset form*/
											$("#upload_excel")[0].reset();
										/*Reset form*/
									} else {
										initAlert( "alert-danger", "Ocurrió un error al procesar archivo: <br>"+resp.file_errors );
									}

									$("#processing-file").modal("toggle");
								},
				        error: function( jqXHR, textStatus, errorThrown ) {
									catchAjaxError( jqXHR, textStatus, errorThrown );
								} /*ajax error*/
							});
							
	        	}
	        },
	        error: function( jqXHR, textStatus, errorThrown ) {
						catchAjaxError( jqXHR, textStatus, errorThrown );
					} /*ajax error*/
				});
			} else {
				initAlert( "alert-danger", "El archivo a subir debe de ser .xlsx" );
			}
		} else {
			initAlert( "alert-danger", "LLena los campos para poder procesar el archivo." );
		}
	});
});