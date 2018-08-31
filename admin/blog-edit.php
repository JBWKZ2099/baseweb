<?php
ini_set("display_errors", "On");
	session_start();
	include("../php/db/conn.php");
	include("../php/db/auth.php");
	
	$word = "blog";
	if( authCheck() && user()->permission==1 ) {
		if( isset($_GET["id"]) ) {
			$id = (int)$_GET["id"];
			$table = "blogs";
			if( !validateData( $id, $table ) )
				header("Location: ".$word."s");
			else {
				$mysqli = conectar_db();
				selecciona_db($mysqli);
				$sql = "SELECT * FROM $table WHERE id=$id";
				$result = consulta_tb($mysqli,$sql);

				$row = mysqli_fetch_array($result);

				if( $row["deleted_at"]!=null ) {
					$_SESSION["error"] = "El blog con el ID seleccionado está eliminado.";
					header("Location: blogs-deleted");
				}
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
	<script src="assets/js/datatables/jquery.js"></script>
	<script src="assets/js/datatables/jquery.dataTables.js"></script>
	<script src="//cdn.ckeditor.com/4.10.0/full/ckeditor.js"></script>
	<script src="assets/js/validateFormEdit.js"></script>
	<script src="assets/js/select-scripts.js"></script>
</head>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
	<?php
		$active_menu = $word."_mn";
		$collapse = $word;
		$active_opt = $word."-view";
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
								Editando <?php echo $word; ?>
							</div>
							<div class="card-body">
								<form action="../php/db/requests.php" method="POST" enctype="multipart/form-data">
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
		header("Location: login");
	}
?>