<?php
	include("../php/admin.head.php");

	$current_pg = "Usuario";
	$word = "customer";
	$table = "customers";
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
			include("widgets/permissions.php");
		}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php
		$current_pg = "Usuario";
		$title="Editar $current_pg";
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
		$active_opt = $word."-view";
		include("structure/navbar.php");
		$word_esp = $current_pg;
		$word_s = $table;
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
	        				<i class="far fa-edit fa-fw"></i>
	        				Editando <?php echo $word_esp; ?>
	        			</div>
	        			<div class="card-body">
	        				<?php
	        					include("../alerts/errors.php");
	        					include("../alerts/success.php");
	        				?>
	        				<form id="form-validation" action="<?php echo $env->APP_URL ?>php/db/requests.php" method="POST" enctype="multipart/form-data">
	        					<input type="hidden" name="request" value="update-<?php echo $word; ?>">
	        					<input type="hidden" name="which" value="<?php echo $_GET["id"]; ?>">
	        					<?php
	        						$row = mysqli_fetch_array($result);
	        						$sql = null; $sql = "SELECT * FROM permissions";
	        						$u_result = DB::consulta_tb($mysqli,$sql);

	        						$row_obj = json_decode( $row["permissions"] );
	        						$edit = true;
	        						include("forms/".$word."-form.php");
	        					?>
	        					<button type="submit" class="btn btn-success">Actualizar</button>
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

	<?php include("forms/validations/".$collapse."_edit.php"); ?>
</body>
</html>
<?php
	} else {
		Redirect::to("login");
	}
?>
