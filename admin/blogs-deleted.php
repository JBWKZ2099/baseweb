<?php
	include("../php/admin.head.php");

	if( Auth::check() && Auth::user()->permission_admin==1 && Auth::user()->permission_blogs_d==1 ) {
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php
		$current_pg2 = $title="Blogs Eliminados";
		$copy_year = date("Y",strtotime("today"));
		include("structure/head.php");
		$breadcrumb = [
			[
				"link" => "/",
				"word" => "Dashboard",
			],
			[
				"link" => "/blogs",
				"word" => "Blogs",
			],
			[
				"link" => "/blogs/".$table,
				"word" => $current_pg2,
			]
		];
	?>
	<?php /*<script src="<?php echo $env->APP_URL_ADMIN; ?>assets/js/datatables/jquery.js"></script>*/ ?>
	<script src="<?php echo $env->APP_URL_ADMIN; ?>assets/js/datatables/jquery.dataTables.js"></script>

	<?php $dt_restore=true; $dt_which="blog"; include("widgets/data-table-script.php"); ?>
</head>
<body class="sb-nav-fixed">
	<?php
		$active_menu = $dt_which."_mn";
		$collapse = $dt_which;
		$active_opt = $dt_which."-deleted";
		include("structure/navbar.php");

		$data_table_which = "Blogs";
		$table_head = array(
			"Nombre",
			"Autor",
			"Creado",
			"Editado",
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
		$table = $_pth = "blogs";
		include("widgets/modal-restore.php");
	?>
</body>
</html>
<?php
	} else {
		Redirect::to("login");
	}
?>
