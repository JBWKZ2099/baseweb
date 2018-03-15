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
		$title="Actualizar títulos";
		$copy_year = date("Y",strtotime("today"));
		include("structure/head.php");
	?>
	<script src="assets/js/functions.js"></script>
</head>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
	<?php
		$active_menu = "charts_mn";
		$collapse = "charts";
		$active_opt = "charts-update";
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
								Actualizar títulos de gráfica
							</div>
							<div class="card-body">
								<form id="update_gtitle">
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
									<?php include("forms/chart-form.php") ?>
									
									<input id="id_customer" type="hidden" name="id_customer">
									<button class="btn btn-outline-primary float-right" id="update-data" type="button">Actualizar</button>
								</form>
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

	<script src="assets/js/charts/update.js"></script>
</body>
</html>
<?php
	} else {
		header("Location: login");
	}
?>