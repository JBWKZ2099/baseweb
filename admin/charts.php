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
		$title="Gráficas";
		$copy_year = date("Y",strtotime("today"));
		include("structure/head.php");
	?>
	<script src="assets/js/functions.js"></script>
</head>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
	<?php
		$active_menu = "charts_mn";
		$collapse = "charts";
		$active_opt = "charts";
		include("structure/navbar.php");
	?>
	
	<div class="content-wrapper">
		<div class="contianer-fluid">
			<div class="container-fluid">
				<div class="row mt-3">
					<?php if( user()["permission"]==1 ) { ?>
						<div class="col-md-12">
							<div class="card">
								<div class="card-header bg-blue text-white">
									<i class="fa fa-plus-circle"></i>
									Ver gráfica
								</div>
								<div class="card-body">
									<div id="my-alert" class="alert alert-dismissible fade show" role="alert" style="display:none;">
										<span id="alert-text"></span>
										<button id="close-alert" type="button" class="close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>

									<label for="customer">Selecciona el cliente para ver sus gráficas:</label>
									<select name="customer" id="customer" class="form-control"></select>

									<div id="processing" style="display:none">
										<i class="fa fa-spinner fa-pulse"></i> Procesando...
									</div>
								</div>
							</div>
						</div>
					<?php } else { ?>
					 <div class="col-md-12">
					 	<div id="processing" style="display:none">
							<i class="fa fa-spinner fa-pulse"></i> Procesando...
						</div>
						<div id="my-alert" class="alert alert-dismissible fade show" role="alert" style="display:none;">
							<span id="alert-text"></span>
							<button id="close-alert" type="button" class="close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					 </div>
					<?php } ?>
				</div>

				<div class="row mt-3">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header bg-blue text-white">
								<i class="fa fa-bar-chart"></i>
								<span id="bar-title">Gráfica 1</span>
							</div>
							<div class="card-body chart-container hide-chart">
								<canvas id="bar-chart" width="100%" height="50"></canvas>
							</div>
						</div>
					</div>
				</div>

				<div class="row mt-3">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header bg-blue text-white">
								<i class="fa fa-area-chart"></i>
								<span id="line-title">Gráfica 2</span>
							</div>
							<div class="card-body chart-container hide-chart">
								<canvas id="linear-chart" width="100%" height="30"></canvas>
							</div>
						</div>
					</div>
				</div>

				<div class="row mt-3 mb-3">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header bg-blue text-white">
								<i class="fa fa-pie-chart"></i>
								<span id="pie-title">Gráfica 3</span>
							</div>
							<div class="card-body chart-container hide-chart">
								<canvas id="pie-chart" width="100%" height="30"></canvas>
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
	<?php if( user()["permission"]==2 ) { ?>
		<script> var customer = <?php echo user()["id"] ?>; </script>
		<?php /*Async en el script para que carguen bien las gráficas*/ ?>
		<script src="assets/js/charts/view_customer.js" async=""></script>
	<?php } ?>
	<script src="assets/js/charts/view.js"></script>
</body>
</html>
<?php
	} else {
		header("Location: login");
	}
?>