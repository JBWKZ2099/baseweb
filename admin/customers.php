<?php
	include("../php/admin.head.php");

	if( Auth::check() && Auth::user()->permission_admin==1 && Auth::user()->permission_users_r==1 ) {
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php
		$table = "users";
		$title="Usuarios";
		$copy_year = date("Y",strtotime("today"));
		include("structure/head.php");
	?>
	<?php /*<script src="<?php echo $env->APP_URL_ADMIN; ?>assets/js/datatables/jquery.js"></script>*/ ?>
	<script src="<?php echo $env->APP_URL_ADMIN; ?>assets/js/datatables/jquery.dataTables.js"></script>

	<?php $restore=false; $dt_which="customer"; include("widgets/data-table-script.php"); ?>
</head>
<body class="sb-nav-fixed">
	<?php
		$active_menu = $dt_which."_mn";
		$collapse = $dt_which;
		$active_opt = $dt_which."-view";
		include("structure/navbar.php");

		$data_table_which = "Usuarios";
		$table_head = array(
			"Nombre(s)",
			"Apellido(s)",
			"Nombre de Usuario",
			"E-Mail",
		);
	?>

	<div id="layoutSidenav">
	  <div id="layoutSidenav_nav">
	    <?php include("structure/menu.php"); ?>
	  </div>
	  <div id="layoutSidenav_content">
	    <main>
	      <div class="container-fluid px-4">
	        <?php include("structure/breadcrumb.php"); ?>
	        <?php include("widgets/data-table.php"); ?>
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
	<?php
		include("widgets/modal.php");
		$table = "users"; $_pth = "customers-deleted";
		include("widgets/modal-delete.php");
	?>
</body>
</html>
<?php
	} else {
		Redirect::to("login");
	}
?>
