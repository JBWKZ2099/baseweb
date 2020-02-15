<?php
	include("../php/admin.head.php");

	if( Auth::check() && Auth::user()->permission_admin==1 && Auth::user()->permission_users_c==1 ) {
		$mysqli = Connection::conectar_db();
		Connection::selecciona_db($mysqli);
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php
		$title="Crear cliente";
		$copy_year = date("Y",strtotime("today"));
		include("structure/head.php");
	?>
	<script src="<?php echo $env->APP_URL_ADMIN; ?>assets/js/datatables/jquery.js"></script>
	<script src="<?php echo $env->APP_URL_ADMIN; ?>assets/js/datatables/jquery.dataTables.js"></script>
</head>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
	<?php
		$active_menu = "customer_mn";
		$collapse = "customer";
		$active_opt = "customer-create";
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
								Creando cliente
							</div>
							<div class="card-body">

								<!-- alert row -->
								<div id="my-alert" class="alert alert-dismissible" role="alert" style="display:none;">
									<button id="dismiss-my-alert" type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<span id="alert-text"></span>
								</div>
								<!-- alert row -->

								<form id="users-form" action="<?php echo $env->APP_URL ?>php/db/requests.php" method="POST">
									<input type="hidden" name="request" value="create-customer">
									<input type="hidden" name="table" value="users">
									<?php
										$row = mysqli_fetch_array($result);
										$sql = null; $sql = "SELECT * FROM permissions";
										$u_result = DB::consulta_tb($mysqli,$sql);
									?>
									<?php include("forms/customer-form.php"); ?>
									<button type="submit" class="btn btn-success">Registrar</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php include("structure/footer.php"); ?>

	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fa fa-angle-up"></i>
	</a>
	<?php include("widgets/modal.php"); ?>
	<script src="<?php echo $abs_path."assets/js/users-form.js"; ?>"></script>
</body>
</html>
<?php
	} else {
		Redirect::to("login");
	}
?>
