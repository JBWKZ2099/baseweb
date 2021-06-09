<?php
	$_create = Auth::user()->{"permission_".$table."_c"};
	$_read = Auth::user()->{"permission_".$table."_r"};
	$_update = Auth::user()->{"permission_".$table."_u"};
	$_delete = Auth::user()->{"permission_".$table."_d"};
?>
<script>
	$(document).ready(function() {

		dataTable = $('#table-gen').DataTable( {
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
					"defaultContent": "<a href='#' title='Restaurar' id='restore' class='text-warning mr-2 text-decoration-none' data-bs-toggle='modal' data-bs-target='#restore-record'> <i class='fas fa-undo'></i> </a>"
				<?php } else { ?>
						<?php
							$actions_btn = "";

							if( $table!="blogs" ) {
								if( $_read )
									$actions_btn .= "<a href='#' title='Ver más' id='".$dt_which."-info' class='text-info mr-2 text-decoration-none'> <i class='fa fa-info-circle'></i> </a>";
							}

							if( $_update )
								$actions_btn .= "<a href='#' title='Editar' id='".$dt_which."-edit' class='text-success mr-2 text-decoration-none'> <i class='fa fa-edit'></i> </a>";

							if( $_delete )
								$actions_btn .= "<a href='#' title='Eliminar' id='delete' class='text-danger mr-2 text-decoration-none' data-bs-toggle='modal' data-bs-target='#delete-record'> <i class='fa fa-times'></i> </a>";
						?>

						"defaultContent": "<?php echo $actions_btn; ?>"
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