<script>
	$(document).ready(function() {
		var dataTable = $('#table-gen').DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax":{
				url :"../php/db/requests.php?req=<?php if( $dt_restore ) echo $dt_which."-restore"; else echo $dt_which; ?>", // json datasource
				type: "post",  // method  , by default get
				error: function(){  // error handling
					$(".table_gen_e-ror").html("");
					$("#table-gen").append('<tbody class="table_gen_e-ror"><tr><th colspan="3">No hay resultados.</th></tr></tbody>');
					$("#employee-grid_processing").css("display","none");
				}
			},
			"columnDefs": [{
				"targets": -1,
				"bSortable": false, // Exclude actions column from ordering
				"data": null,
				<?php if( $dt_restore ) { ?>
					"defaultContent": "<a id='restore' class='text-warning mr-2 link-table' data-toggle='modal' data-target='#restore-record'> <i class='fa fa-repeat'></i> </a>"
				<?php } else { ?>
					"defaultContent": "<a id='<?php echo $dt_which; ?>-info' class='text-info mr-2'> <i class='fa fa-info-circle'></i> </a> <a id='<?php echo $dt_which; ?>-edit' class='text-success mr-2'> <i class='fa fa-pencil-square-o'></i> </a> <a id='delete' class='text-danger mr-2' data-toggle='modal' data-target='#delete-record'> <i class='fa fa-times'></i> </a>"
				<?php } ?>
			}],
			language: { "url": "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"}
		});

		$("#table-gen tbody").on("click", "a", function(e) {
			e.preventDefault();
			var data = dataTable.row( $(this).parents("tr") ).data();
			var which = $(this).attr("id");
			<?php if( !$dt_restore ) { ?>
				if( which!="delete" )
					window.location.href = which+"?id="+data[0];
				else {
					$("#delete-form [name=id]").val("").val(data[0]);
				}
			<?php } else { ?>
				$("#restore-form [name=id]").val("").val(data[0]);
			<?php } ?>
		});
	});
</script>