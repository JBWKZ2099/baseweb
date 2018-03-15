$(document).ready(function() {
	fillCustomerSelect();
	$("#update_gtitle")[0].reset();

	$("#customer").change(function(e){
		var which = $(this).val();

		$.ajax({
			url: direction+"/db/requests.php",
			type: "POST",
			dataType: "json",
			data: { id_user: which, request: "check-customer-data" },
			beforeSend: function() { $("#verifying").slideDown(300); },
			success: function( response ) {
				if( response.has_data ) {
					console.log(response)
					$("#id_customer").val(response.customer_id);
					$("#bar_graph_name").empty().val(response.title_1);
					$("#line_graph_name").empty().val(response.title_2);
					$("#circle_graph_name").empty().val(response.title_3);
				}

				$("#verifying").slideUp(300);
			}
		});
	});

	$("#update-data").click(function(e) {
		var _customer_id = $("#id_customer").val();
		var _bar_graph_name = $("#bar_graph_name").val();
		var _line_graph_name = $("#line_graph_name").val();
		var _circle_graph_name = $("#circle_graph_name").val();

		if( _customer_id!="null" && _customer_id!="" && _bar_graph_name && _line_graph_name && _circle_graph_name ) {
			$.ajax({
				url: direction+"/db/requests.php",
				type: "POST",
				dataType: "JSON",
				data: {
					customer: _customer_id,
					bar_graph_name: _bar_graph_name,
					line_graph_name: _line_graph_name,
					circle_graph_name: _circle_graph_name,
					request: "update-gtitle"
				},
				beforeSend: function() {
					$("#update_gtitle")[0].reset();
					$("#verifying").slideDown(300);
				},
				success: function(resp) {
					if( resp.updated=="success" ) {
						initAlert( "alert-success", "Los títulos se actualizaron correctamente." );
						$("#verifying").slideUp(300);
					} else {
						initAlert( "alert-danger", "Ocurrió un error al guardar los datos." );
					}
				},
	      error: function( jqXHR, textStatus, errorThrown ) {
					catchAjaxError( jqXHR, textStatus, errorThrown );
					$("#verifying").slideUp(300);
				} /*ajax error*/
			});
		}/*FIN IF*/ else {
			initAlert("alert-warning","<ul class='ml-3'> <li>Debes llenar los títulos para poder guardar los datos.</li> </ul>");
		}
	});
});