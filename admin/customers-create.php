<?php
	include("../php/admin.head.php");

	$word = "customer";
	if( Auth::check() && Auth::user()->permission_admin==1 && Auth::user()->permission_users_c==1 ) {
		$mysqli = Connection::conectar_db();
		Connection::selecciona_db($mysqli);
		include("widgets/permissions.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php
		$current_pg = "Usuario";
		$current_pg2 = $title="Crear $current_pg";
		$copy_year = date("Y",strtotime("today"));
		include("structure/head.php");
		$breadcrumb = [
			[
				"link" => "/",
				"word" => "Dashboard",
			],
			[
				"link" => "/customers",
				"word" => "Usuarios",
			],
			[
				"link" => "/customers/".$table,
				"word" => $current_pg2,
			]
		];
	?>
	<?php /*<script src="<?php echo $env->APP_URL_ADMIN; ?>assets/js/datatables/jquery.js"></script>*/ ?>
	<script src="<?php echo $env->APP_URL_ADMIN; ?>assets/js/datatables/jquery.dataTables.js"></script>
</head>
<body class="sb-nav-fixed">
	<?php
		$active_menu = $word."_mn";
		$collapse = $word;
		$active_opt = $word."-create";
		include("structure/navbar.php");
		$word_esp = "Usuario";
		$word_s = "customers";
	?>

	<div id="layoutSidenav">
	  <div id="layoutSidenav_nav">
	    <?php include("structure/menu.php"); ?>
	  </div>
	  <div id="layoutSidenav_content">
	    <main>
	      <div class="container-fluid px-4">
	        <?php include("structure/breadcrumb.php"); ?>

	        <div class="row mt-3">
	        	<div class="col-md-12">
	        		<div class="card">
	        			<div class="card-header">
	        				<i class="fas fa-plus fa-fw"></i>
	        				Creando <?php echo $word_esp; ?>
	        			</div>
	        			<div class="card-body">
	        				<?php
	        					include("../alerts/errors.php");
	        					include("../alerts/success.php");
	        				?>
	        				<form id="form-validation" action="<?php echo $env->APP_URL ?>php/db/requests.php" method="POST" enctype="multipart/form-data">
	        					<input type="hidden" name="request" value="create-<?php echo $word; ?>">
	        					<input type="hidden" name="table" value="<?php echo $word_s; ?>">
	        					<?php
											$row = mysqli_fetch_array($result);
											$sql = null; $sql = "SELECT * FROM permissions";
											$u_result = DB::consulta_tb($mysqli,$sql);
											$edit = false;
	        					?>
	        					<?php include("forms/".$word."-form.php"); ?>
	        					<button type="submit" class="btn btn-success">Registrar</button>
	        				</form>
	        			</div>
	        		</div>
	        	</div>
	        </div>
	      </div>
	    </main>
	    <footer class="py-4 bg-light mt-auto">
	      <?php include("structure/footer.php"); ?>
	    </footer>
	  </div>
	</div>

	<?php include("structure/footer-scripts.php"); ?>

	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fa fa-angle-up"></i>
	</a>
	<?php include("widgets/modal.php"); ?>

	<?php include("forms/validations/$collapse.php"); ?>
</body>
</html>
<?php
	} else {
		Redirect::to("login");
	}
?>
