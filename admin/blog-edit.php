<?php
	include("../php/admin.head.php");

	$current_pg = "Blog";
	$word = "blog";
	$table = "blogs";
	if( Auth::check() && Auth::user()->permission_admin==1 && Auth::user()->permission_blogs_u==1 ) {
		if( isset($_GET["id"]) ) {
			$id = (int)$_GET["id"];
			$table = $word."s";
			if( !DB::validateData( $id, $table ) )
				Redirect::to($word."s");
			else {
				$mysqli = Connection::conectar_db();
				Connection::selecciona_db($mysqli);
				$sql = "SELECT * FROM $table WHERE id=$id";
				$result = DB::consulta_tb($mysqli,$sql);

				$row = mysqli_fetch_array($result);

				if( $row["deleted_at"]!=null ) {
					$_SESSION["error"] = "El blog con el ID seleccionado está eliminado.";
					Redirect::to("blogs-deleted");
				}

				$sql = "SELECT * FROM categories";
				$result = DB::consulta_tb($mysqli, $sql);

				$sql = "SELECT * FROM subcategories";
				$result2 = DB::consulta_tb($mysqli, $sql);
			}
		}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php
		$title="Editar ".$word;
		$copy_year = date("Y",strtotime("today"));
		include("structure/head.php");
	?>
	<?php /*<script src="<?php echo $env->APP_URL_ADMIN; ?>assets/js/datatables/jquery.js"></script>*/ ?>
	<script src="<?php echo $env->APP_URL_ADMIN; ?>assets/js/datatables/jquery.dataTables.js"></script>
	<script src="https://cdn.ckeditor.com/4.15.0/full/ckeditor.js"></script>
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
	<?php include("forms/validations/".$collapse."_edit.php"); ?>
</body>
</html>
<?php
	} else {
		Redirect::to("login");
	}
?>
