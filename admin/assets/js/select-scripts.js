$(document).ready(function() {
	$("#type").change(function(e){
		var _this_val = $(this).val();
		if( _this_val==1 ) {
			$("#category").html("<option disabled selected>Selecciona...</option> <option value='1'>Inteligencia de marca</option> <option value='2'>Planeación Estratégica</option> <option value='3'>Evaluación de Competitividad</option> <option value='4'>Medición de actividades de Marketing y Venta</option> <option value='5'>Determinación de Objetivos</option> <option value='6'>Dimensionamiento de Mercados</option> <option value='7'>Assessment Fuerza de Ventas</option> <option value='8'>Mineria de datos y dashboards</option> <option value='9'>Desarrollo de talento</option>");
			$("[data-id='category']").css({ "display": "block" })
			$("[data-id='subcategory']").css({ "display": "block" });
		}
		if( _this_val==2 || _this_val==3 ) {
			$("[data-id='category']").css({ "display": "none" })
			$("[data-id='subcategory']").css({ "display": "block" });
		}
	});
	$("#category").change(function(e){
		var t_blog = $("#type").val();
		if( t_blog==1 ) {
			$("[data-id='subcategory']").css({ "display": "block" });
		}
	});

	
	$("#is_video").click(function(e){
		if( $(this).val()==0 )
			$(this).val("1");
		else
			$(this).val("0");
	});
});