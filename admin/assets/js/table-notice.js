// JavaScript Document
var ordenar = '';
$(document).ready(function(){

	// Llamando a la funcion de busqueda al
	// cargar la pagina
	filtrar()


	// filtrar al darle click al boton
	$("#btnfiltrar").click(function(){ filtrar() });

	// boton cancelar
	$("#btncancel").click(function(){
		$('#evento_select').val('');
		$('status-select').val('');
		$(':input','#frm_filtro')
		 .not(':button, :submit, :reset, :hidden')
		 .val('')
		 .removeAttr('checked')
		 .removeAttr('selected');
		filtrar()
	});

	// ordenar por
	$("#data th span").click(function(){
		var orden = '';
		if($(this).hasClass("desc"))
		{
			$("#data th span").removeClass("desc").removeClass("asc")
			$(this).addClass("asc");
			ordenar = "&orderby="+$(this).attr("title")+" asc"
		}else
		{
			$("#data th span").removeClass("desc").removeClass("asc")
			$(this).addClass("desc");
			ordenar = "&orderby="+$(this).attr("title")+" desc"
		}
		filtrar()
	});
});

function filtrar()
{
	$.ajax({
		data: $("#frm_filtro").serialize()+ordenar,
		type: "POST",
		dataType: "json",
		url: "php/procesar-admin.php?action=listar",
			success: function(data){
				var html = '';
				if(data.length > 0){
					$.each(data, function(i,item) {
						if(item.type == 1)
							var _type = "Exccom Servicios";
						if(item.type == 2)
							var _type = "ATM";
						if(item.type == 3)
							var _type = "Capacitaciones";

						if(item.status == 1)
							var _status = "Publicado";
						if(item.status == 2)
							var _status = "No Publicado";


							html += "<tr>";
							html += '<td>'+item.name+'</td>'
							html += '<td>'+item.author+'</td>'
							html += '<td>'+_type+'</td>'
							html += '<td>'+item.created_at+'</td>'
							html += '<td>'+item.edited_at+'</td>'
							html += '<td>'+_status+'</td>'
							html += '<td class="text-center"><a class="btn btn-primary col-xs-4 col-xs-offset-1" href="edit.php?id='+item.id+'">Editar</a><button OnClick="Mostrar('+item.id+', `'+item.name+'`);" class="btn btn-danger col-xs-4 col-xs-offset-2" data-toggle="modal" data-target="#deleteModal">Eliminar</button></td>'
							html += ''
						html += '</tr>';
					var query = item.qry;
				$("#query_excel").attr("value",query);
					});
				}
				if(html == ''){
					html = '<tr><td colspan="12" align="center">No se encontraron registros..</td></tr>'
				}
				$("#data tbody").html(html);
			}, error: function(data){
				console.log(data);
			}
	  });
}
