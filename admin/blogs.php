<?php
	require realpath($_SERVER["DOCUMENT_ROOT"])."/"."php/vendor/autoload.php";
  include( realpath($_SERVER["DOCUMENT_ROOT"])."/"."env.php" );
	include( realpath($_SERVER["DOCUMENT_ROOT"])."/php/db/auth.php" );

	if( authCheck() && user()->permission==1 ) {
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php
		$title="Blogs";
		$copy_year = date("Y",strtotime("today"));
		include("structure/head.php");
	?>
	<script src="<?php echo $abs_path."/"; ?>assets/js/datatables/jquery.js"></script>
	<script src="<?php echo $abs_path."/"; ?>assets/js/datatables/jquery.dataTables.js"></script>

	<?php $restore=false; $dt_which="blog"; include("widgets/data-table-script.php"); ?>
</head>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
	<?php
		$active_menu = "blog_mn";
		$collapse = "blog";
		$active_opt = "blog-view";
		include("structure/navbar.php");

		$data_table_which = "Blogs";
		$table_head = array(
			"Nombre",
			"Autor",
			"Creado",
			"Editado",
		);
		include("widgets/data-table.php");
	?>

	<?php include("structure/footer.php"); ?>

	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fa fa-angle-up"></i>
	</a>
	<?php
		include("widgets/modal.php");
		$table = $path = "blogs";
		include("widgets/modal-delete.php");
	?>
</body>
</html>
<?php
	} else {
		header("Location: login");
	}
?>
