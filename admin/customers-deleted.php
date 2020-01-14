<?php
	session_start(); require $_SESSION["path"]["autoload"];
  include( $_SESSION["path"]["env"] );
	include( $_SESSION["path"]["auth"] );

	if( Auth::check() ) {
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php
		$title="Clientes";
		$copy_year = date("Y",strtotime("today"));
		include("structure/head.php");
	?>
	<script src="<?php echo $env->APP_URL_ADMIN; ?>assets/js/datatables/jquery.js"></script>
	<script src="<?php echo $env->APP_URL_ADMIN; ?>assets/js/datatables/jquery.dataTables.js"></script>

	<?php $dt_restore=true; $dt_which="customer"; include("widgets/data-table-script.php"); ?>
</head>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
	<?php
		$active_menu = $dt_which."_mn";
		$collapse = $dt_which;
		$active_opt = $dt_which."-deleted";
		include("structure/navbar.php");

		$data_table_which = "Usuarios";
		$table_head = array(
			"Nombre",
			"Apellido Paterno",
			"Apellido Materno",
			"Nombre de Usuario",
			"E-Mail",
			"Permisos",
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
		$table = "users"; $_pth = "customers";
		include("widgets/modal-restore.php");
	?>
</body>
</html>
<?php
	} else {
		Redirect::to("login");
	}
?>
