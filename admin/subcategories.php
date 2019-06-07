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
		$current_pg = "Subcategorías";
		$title="Blogs | ".$current_pg;
		$copy_year = date("Y",strtotime("today"));
		include("structure/head.php");
	?>
	<script src="<?php echo $abs_path."/"; ?>assets/js/datatables/jquery.js"></script>
	<script src="<?php echo $abs_path."/"; ?>assets/js/datatables/jquery.dataTables.js"></script>

	<?php $restore=false; $dt_which="subcategory"; include("widgets/data-table-script.php"); ?>
</head>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
	<?php
		$active_menu = $dt_which."_mn";
		$collapse = $dt_which."";
		$active_opt = $dt_which."-view";
		include("structure/navbar.php");

		$data_table_which = $current_pg."s";
		$table_head = array(
			"Nombre",
		);
		include("widgets/data-table.php");
	?>

	<?php include("structure/footer.php"); ?>

	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fa fa-angle-up"></i>
	</a>
	</a>
	<?php
		include("widgets/modal.php");
		$table = $path = "subcategories";
		include("widgets/modal-delete.php");
	?>
</body>
</html>
<?php
	} else {
		header("Location: login");
	}
?>
