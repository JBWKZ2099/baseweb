function initAlert( _class, _text ) {
	$("#my-alert").removeClass("alert-danger").removeClass("alert-warning").removeClass("alert-success");
	$("#my-alert").addClass(_class);
	$("#alert-text").html(_text);
	$("#my-alert").fadeIn(500);
}
function fillCustomerSelect() {
	$.get(direction+"/db/requests.php?req=get-customers", function(data, state) {
		/*Esta linea servirá para limpiar el select si es que ya tiene valores*/
		$("#customer").empty();

		if( data[0]=="no_data" ) {
			initAlert("alert-info","<i class='fa fa-info-circle'></i> No hay clientes registrados.")
			$("#customer").append("<option value='null' selected hidden>Selecciona...</option>");
		} else {
			data.forEach(element=>{
				$("#customer").append("<option value='null' selected hidden>Selecciona...</option>");
				$("#customer").append(`<option value=${element.id}> ${element.name} ${element.first_name} | ${element.company} </option>`);
			});
		}
	});
}
function setModalText( _modal_id, _span_text ) {
	$("#"+_modal_id+" span#total-registros").empty();
	$("#"+_modal_id+" span#total-registros").append( _span_text );
}
function catchAjaxError( _jqXHR, _textStatus, _errorThrown ) {
	/*Si hay algun error, se mostrará también en un alert*/
	$("#my-alert").addClass("alert-danger");
	$("#my-alert").fadeIn(500);
	if (_jqXHR.status === 0) {
		$("#alert-text").text('Not connect: Verify Network');
	} else if (_jqXHR.status == 404) {
		$("#alert-text").text('Requested page not found [404]');
	} else if (_jqXHR.status == 500) {
		$("#alert-text").text('Internal Server Error [500]');
	} else if (_textStatus === 'parsererror') {
		$("#alert-text").text('Requested JSON parse failed');
	} else if (_textStatus === 'timeout') {
		$("#alert-text").text('Time out error');
	} else if (_textStatus === 'abort') {
		$("#alert-text").text('Ajax request aborted');
	} else {
		$("#alert-text").text('Uncaught Error: ' + _jqXHR.responseText);
	}

	$("#processing-file").modal("toggle");
	setModalText( "processing-file", "Ocurrió un error, refresca la ventana (F5)." );
}
function updateChart( chart_selector, labels, data, data_02, chart_type ) {
	if( chart_type=="line" ) {
		var _data = data.slice(0); /*create a backup, not a reference to array*/
		var line_graph = _data.sort( function(a,b){ return a-b; } ); /* function(a,b){} sorts array correctly */
		var tick_min, tick_max;

		tick_min = line_graph[0];
		tick_max = line_graph.length-1;
		tick_max = line_graph[tick_max];

		chart_selector.options.scales.yAxes[0].ticks.min = tick_min;
		chart_selector.options.scales.yAxes[0].ticks.max = tick_max;

	}

	if( labels!=null )
		chart_selector.data.labels = labels;

	chart_selector.data.datasets[0].data = data;
	
	if( data_02!=null )
		chart_selector.data.datasets[1].data = data_02;

	chart_selector.update({
		duration: 800,
		easing: "linear"
	});
}