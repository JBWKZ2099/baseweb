<?php
ini_set("display_errors", "On");
	session_start();
	include("../php/db/conn.php");
	include("../php/db/auth.php");
	
	if( authCheck() && user()["permission"]==1 ) {
		$mysqli = conectar_db();
		selecciona_db($mysqli);
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php
		$title="Crear histórico";
		$copy_year = date("Y",strtotime("today"));
		include("structure/head.php");
	?>
	<script src="assets/js/datatables/jquery.js"></script>
	<script src="assets/js/datatables/jquery.dataTables.js"></script>
</head>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
	<?php
		$active_menu = "historic_mn";
		$collapse = "historic";
		$active_opt = "historic-create";
		include("structure/navbar.php");
	?>

	<div class="content-wrapper">
		<div class="contianer-fluid">
			<div class="container-fluid">
				<div class="row mt-3">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header bg-blue text-white">
								<i class="fa fa-fw fa-pencil-square-o"></i>
								Creando histórico
							</div>
							<div class="card-body">
								<?php
									include("../alerts/errors.php");
									include("../alerts/success.php");
								?>
								<form action="../php/db/requests.php" method="POST" enctype="multipart/form-data">
									<input type="hidden" name="request" value="create-historic">
									<input type="hidden" name="table" value="historics">
									<?php
										$sql = null; $sql = "SELECT * FROM users WHERE permission=2 ORDER BY company";
										$u_result = consulta_tb($mysqli,$sql);
									?>
									<?php include("forms/historic-form.php") ?>
									<button type="submit" class="btn btn-success">Registrar</button>
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
</body>
</html>
<?php
	} else {
		header("Location: login");
	}
?>