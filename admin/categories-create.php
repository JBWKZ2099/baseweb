<?php
	require realpath($_SERVER["DOCUMENT_ROOT"])."/"."php/vendor/autoload.php";
  include( realpath($_SERVER["DOCUMENT_ROOT"])."/"."env.php" );
	include( realpath($_SERVER["DOCUMENT_ROOT"])."/php/db/auth.php" );

	$word = "category";
	if( authCheck() && user()->permission==1 ) {
		$mysqli = Connection::conectar_db();
		Connection::selecciona_db($mysqli);
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php
		$title="Crear Categoría";
		$copy_year = date("Y",strtotime("today"));
		include("structure/head.php");
	?>
	<script src="<?php echo $abs_path."/"; ?>assets/js/datatables/jquery.js"></script>
	<script src="<?php echo $abs_path."/"; ?>assets/js/datatables/jquery.dataTables.js"></script>
	<script src="//cdn.ckeditor.com/4.10.0/full/ckeditor.js"></script>
	<script src="assets/js/validateFormEdit.js"></script>
	<script src="assets/js/select-scripts.js"></script>
</head>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
	<?php
		$active_menu = $word."_mn";
		$collapse = $word;
		$active_opt = $word."-create";
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
								Creando Categoría
							</div>
							<div class="card-body">
								<?php
									include("../alerts/errors.php");
									include("../alerts/success.php");
								?>
								<form action="<?php echo $abs_path."/"; ?>../php/db/requests.php" method="POST">
									<input type="hidden" name="request" value="create-<?php echo $word; ?>">
									<input type="hidden" name="table" value="categories">
									<?php
										$row = mysqli_fetch_array($result);
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
		</div>
	</div>

	<?php include("structure/footer.php"); ?>

	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fa fa-angle-up"></i>
	</a>
	<?php include("widgets/modal.php"); ?>
	<script> CKEDITOR.replace( 'body' ); </script>
</body>
</html>
<?php
	} else {
		Redirect::to("login");
	}
?>
