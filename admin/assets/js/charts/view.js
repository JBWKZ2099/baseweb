$(document).ready(function() {
	fillCustomerSelect();

	$("#customer").change(function(e) {
		var _labels = [];
		var _daily_total = [];
		var _average = [];
		var customer = $(this).val();

		$.ajax({
			url: direction+"/db/requests.php",
			type: "POST",
			dataType: "json",
			data: { id_customer: customer, request: "get-gtitle" },
			success: function( resp ) {
				console.log( resp.length )
				if( !resp.length==0 )
					$("#bar-title").empty().text(resp[0]);

				if( !resp.length==0 )
					$("#line-title").empty().text(resp[1]);

				if( !resp.length==0 )
					$("#pie-title").empty().text(resp[2]);
			}
		});
		

		$.ajax({
			url: direction+"/db/requests.php",
			type: "POST",
			dataType: "json",
			data: { id_customer: customer, request: "get-lchart" },
			beforeSend: function() {
				$("#processing").slideDown(300);
			},
			success: function( resp ) {
				console.log(resp)
				if( resp.status=="no_results" ) {
					$(".chart-container").removeClass("show").addClass("hide-chart");
					initAlert( "alert-warning", "El cliente seleccionado no tiene gráficas para mostrar." )
					$("#processing").slideUp(300);
				} else {
					$("#processing").slideUp(300);
					var month_names = [
				    "Enero",
				    "Febrero",
				    "Marzo",
				    "Abril",
				    "Mayo",
				    "Junio",
				    "Julio",
				    "Agosto",
				    "Septiembre",
				    "Octubre",
				    "Noviembre",
				    "Diciembre"
				  ];
					$(resp).each(function(index, element) {
						_labels.push( element.fecha );
						_daily_total.push( parseInt(element.total_diario) );
						var average = parseFloat( element.promedio );
						_average.push( average.toFixed(5) );
					});
					updateChart( myLineChart, _labels, _daily_total, _average, "line" );
					$(".chart-container").removeClass("hide-chart").addClass("show");
				}
			}
		});


		var _labels02 = [];
		var _avance = [];
		var _restante = [];

		$.ajax({
			url: direction+"/db/requests.php",
			type: "POST",
			dataType: "json",
			data: { id_customer: customer, request: "get-bchart" },
			beforeSend: function() {
				$("#processing").slideDown(300);
			},
			success: function( resp ) {
				if( resp.status=="no_results" ) {
					$(".chart-container").removeClass("show").addClass("hide-chart");
					initAlert( "alert-warning", "El cliente seleccionado no tiene gráficas para mostrar." )
					$("#processing").slideUp(300);
				} else {
					$("#processing").slideUp(300);
					$(resp).each(function(index, element) {
						_labels02.push( element.campo );
						_avance.push( element.avance );
						_restante.push( element.restante );
					});
					updateChart( myBarChart, _labels02, _avance, _restante, "bar" );
					$(".chart-container").removeClass("hide-chart").addClass("show");
				}
			}
		});


		var _avance02 = [];
		var _restante02 = [];

		$.ajax({
			url: direction+"/db/requests.php",
			type: "POST",
			dataType: "json",
			data: { id_customer: customer, request: "get-pchart" },
			beforeSend: function() {
				$("#processing").slideDown(300);
			},
			success: function( resp ) {
				if( resp.status=="no_results" ) {
					$(".chart-container").removeClass("show").addClass("hide-chart");
					initAlert( "alert-warning", "El cliente seleccionado no tiene gráficas para mostrar." )
					$("#processing").slideUp(300);
				} else {
					$("#processing").slideUp(300);
					$(resp).each(function(index, element) {
						_avance02.push( element.avances );
						_avance02.push( element.restante );
					});
					updateChart( myCircleChart, null, _avance02, null, "pie" );
					$(".chart-container").removeClass("hide-chart").addClass("show");
				}
			}
		});
	});
});