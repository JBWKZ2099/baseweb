<?php
	session_start();
	include("../php/db/conn.php");
	include("../php/db/auth.php");
	
	if( authCheck() && user()["permission"]==1 ) {
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php
		$title="Usuarios";
		$copy_year = date("Y",strtotime("today"));
		include("structure/head.php");
	?>
	<script src="assets/js/datatables/jquery.js"></script>
	<script src="assets/js/datatables/jquery.dataTables.js"></script>

	<script>
		$(document).ready(function() {
			var dataTable = $('#table-gen').DataTable( {
				"processing": true,
				"serverSide": true,
				"ajax":{
					url :"../php/db/requests.php?req=customer", // json datasource
					type: "post",  // method  , by default get
					error: function(){  // error handling
						$(".table_gen_e-ror").html("");
						$("#table-gen").append('<tbody class="table_gen_e-ror"><tr><th colspan="3">No hay resultados</th></tr></tbody>');
						$("#employee-grid_processing").css("display","none");
					}
				},
				"columnDefs": [{
					"targets": -1,
					"data": null,
					"defaultContent": "<a id='customers-info' class='text-info mr-2'> <i class='fa fa-info-circle'></i> </a> <a id='customers-edit' class='text-success mr-2'> <i class='fa fa-pencil-square-o'></i> </a> <a id='delete' class='text-danger mr-2' data-toggle='modal' data-target='#delete-record'> <i class='fa fa-times'></i> </a>"
				}],
  			language: { "url": "http://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"}
			});

			$("#table-gen tbody").on("click", "a", function(e) {
				e.preventDefault();
				var data = dataTable.row( $(this).parents("tr") ).data();
				var which = $(this).attr("id");
				if( which!="delete" )
					window.location.href = which+"?id="+data[0];
				else {
					$("#delete-form [name=id]").val("").val(data[0]);
				}
			});
		});
	</script>
</head>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
	<?php
		$active_menu = "customer_mn";
		$collapse = "customer";
		$active_opt = "customer-view";
		include("structure/navbar.php");
	?>

	<div class="content-wrapper">
		<div class="contianer-fluid">
			<div class="container-fluid">
				<div class="row mt-3">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header bg-blue text-white">
								<i class="fa fa-fw fa-user-circle"></i>
								Lista de históricos
							</div>
							<div class="card-body">
								<?php
									include("../alerts/errors.php");
									include("../alerts/success.php");
								?>
								<div class="table-responsive">
									<table id="table-gen" class="table table-striped table-bordered table-dark">
										<thead>
											<tr>
												<th>ID</th>
												<th>Nombre</th>
												<th>Apellido Paterno</th>
												<th>Apellido Materno</th>
												<th>Nombre de Usuario</th>
												<th>E-Mail</th>
												<th>Permisos</th>
												<th>Acciones</th>
											</tr>
										</thead>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php include("structure/footer.php") ?>

	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fa fa-angle-up"></i>
	</a>
	<?php include("widgets/modal.php") ?>

	<!-- Modal -->
	<div class="modal fade" id="delete-record" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Eliminar registro</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body text-center">
	        ¿Está seguro que deseas eliminar este registro?
	      </div>
	      <div class="modal-footer">
	      	<form id="delete-form" action="../php/db/requests.php" method="POST">
	      		<input type="hidden" name="request" value="delete">
	      		<input type="hidden" name="table" value="users">
	      		<input type="hidden" name="path" value="customers">
	      		<input type="hidden" name="id" value="">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
		        <button type="submit" class="btn btn-danger">Eliminar</button>
	      	</form>
	      </div>
	    </div>
	  </div>
	</div>
</body>
</html>
<?php
	} else {
		header("Location: login");
	}
?>