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
		url: "php/table-user.php?action=listar",
			success: function(data){
				var html = '';
				if(data.length > 0){
					$.each(data, function(i,item){

							html += "<tr>";
							html += '<td>'+item.username+'</td>';
							html += '<td>'+item.mail+'</td>';
							if(item.permission == '1') html += '<td>Administrador</td>';
							else html += '<td>Usuario</td>';
							html += '<td class="text-center"><a class="btn btn-primary" href="edit-user.php?id='+item.id+'">Editar</a> <button OnClick="Mostrar('+item.id+', `'+item.username+'`);" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">Eliminar</button></td>'
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
