<?php
	session_start();
	include("../php/db/conn.php");
	include("../php/db/auth.php");
	
	if( authCheck() ) {
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php
		$title="Crear gráfica";
		$copy_year = date("Y",strtotime("today"));
		include("structure/head.php");
	?>
	<script src="assets/js/functions.js"></script>
</head>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
	<?php
		$active_menu = "charts_mn";
		$collapse = "charts";
		$active_opt = "charts-create";
		include("structure/navbar.php");
	?>
	
	<div class="content-wrapper">
		<div class="contianer-fluid">
			<div class="container-fluid">
				<div class="row mt15">
					<div class="col-md-12">
						
						<div class="card">
							<div class="card-header bg-blue text-white">
								<i class="fa fa-plus-circle"></i>
								Creando gráfica
							</div>
							<div class="card-body">
								<form id="upload_excel" enctype="multipart/form-data">
									<div id="my-alert" class="alert alert-dismissible fade show" role="alert" style="display:none;">
										<span id="alert-text"></span>
										<button id="close-alert" type="button" class="close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>

		            	<?php include("alerts/request"); ?>
									<div id="verifying" style="display:none">
										<i class="fa fa-spinner fa-pulse"></i> Verificando información...
									</div>
									<?php include("forms/chart-create.php") ?>
									<input type="hidden" name="request_input" value="upload">

									<button id="process-file" type="button" class="btn btn-outline-primary float-right">Procesar</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Modal -->
			<div class="modal fade" id="processing-file" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="processing-fileLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div id="modal-parent-close" class="modal-header">
							<h5 class="modal-title" id="processing-fileLabel">Procesando archivo</h5>
						</div>
						<div class="modal-body">
							<p id="modal-main-text" class="mb-3">
								Por favor no cierres el navegador ni la ventana hasta que finalice el proceso.
							</p>
							<p>
								<b>Estatus:</b> <span class="text-center" id="total-registros"></span>
							</p>
							<div class="progress mt-3">
								<div id="status-progress" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
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

	<script src="assets/js/charts/chart_var.js"></script>
	<script src="assets/js/charts/create.js"></script>
</body>
</html>
<?php
	} else {
		header("Location: login");
	}
?>