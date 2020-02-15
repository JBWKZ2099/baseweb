<?php
	include("../php/admin.head.php");

	if( Auth::check() && Auth::user()->permission_users_u==1 ) {
		$lets_pass = 0;

		/* Si el usuario tiene permiso de admin entra */
		if( Auth::user()->permission_admin==1 || Auth::user()->permission_admin==0 ) {
			$lets_pass++;

			/* Si el usuario tiene permiso para actualizar usuarios entra */
			if( Auth::user()->permission_users_u==1 )
				$lets_pass++;

			/* Si el usuario tiene permiso para administrar usuarios entra */
			if( Auth::user()->permission_users_c==1 || Auth::user()->permission_users_r==1 || Auth::user()->permission_users_d==1 ) {
				$lets_pass++;
			} else {
				$lets_pass--;

				/* Si el usuario intenta acceder a otro id que no es el suyo no entra */
				if( $_GET["id"]!=Auth::user()->id ) {
					$lets_pass--;
				} else {
					$lets_pass++;
				}
			}
		}

		// if( $lets_pass<2 )
		// 	var_dump("redirect :/");

		// var_dump( $lets_pass ); exit();

		if( $lets_pass<2 )
			header("Location: index");

		if( isset($_GET["id"]) ) {
			$id = (int)$_GET["id"];
			$table = "users";
			if( !DB::validateData( $id, $table ) )
				Redirect::to("customers");
			else {
				$mysqli = Connection::conectar_db();
				Connection::selecciona_db($mysqli);
				$sql = "SELECT * FROM $table WHERE id=$id";
				$result = DB::consulta_tb($mysqli,$sql);
			}
		}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php
		$title="Editar usuario";
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
								<i class="fa fa-fw fa-pencil-square-o"></i>
								Editando usuario
							</div>
							<div class="card-body">
								<!-- alert row -->
								<div id="my-alert" class="alert alert-dismissible" role="alert" style="display:none">
									<button id="dismiss-my-alert" type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<span id="alert-text"></span>
								</div>
								<!-- alert row -->

								<form id="users-form" action="<?php echo $env->APP_URL ?>php/db/requests.php" method="POST">
									<input type="hidden" name="request" value="update-customer">
									<input type="hidden" name="which" value="<?php echo $_GET["id"]; ?>">
									<?php
										$row = mysqli_fetch_array($result);
										$sql = null; $sql = "SELECT * FROM permissions";
										$u_result = DB::consulta_tb($mysqli,$sql);

										$row_obj = json_decode( $row["permissions"] );
										$edit = true;
									?>
									<?php include("forms/customer-form.php"); ?>
									<button type="submit" class="btn btn-success">Actualizar</button>
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
