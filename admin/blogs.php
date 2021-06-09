<?php
	include("../php/admin.head.php");

	if( Auth::check() && Auth::user()->permission_admin==1 && Auth::user()->permission_blogs_r==1 ) {
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php
		$table = "blogs";
		$title="Blogs";
		$copy_year = date("Y",strtotime("today"));
		include("structure/head.php");
	?>
	<?php /*<script src="<?php echo $env->APP_URL_ADMIN; ?>assets/js/datatables/jquery.js"></script>*/ ?>
	<script src="<?php echo $env->APP_URL_ADMIN; ?>assets/js/datatables/jquery.dataTables.js"></script>

	<?php $restore=false; $dt_which="blog"; include("widgets/data-table-script.php"); ?>
</head>
<body class="sb-nav-fixed">
	<?php
		$active_menu = "blog_mn";
		$collapse = "blog";
		$active_opt = "blog-view";
		include("structure/navbar.php"); ?>

	<?php
		$data_table_which = $title;
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
		$table = "blogs";
		$_pth = $table."-deleted";
		include("widgets/modal-delete.php");
	?>
</body>
</html>
<?php
	} else {
		Redirect::to("login");
	}
?>
