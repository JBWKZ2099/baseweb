<?php
	include("../php/admin.head.php");

	if( Auth::check() && Auth::user()->permission_admin==1 && Auth::user()->permission_subcategories_r==1 ) {
		if( isset($_GET["id"]) ) {
			$id = (int)$_GET["id"];
			$table = "subcategories";
			if( !DB::validateData( $id, $table ) )
				Redirect::to("subcategories");
			else {
				$mysqli = Connection::conectar_db();
				Connection::selecciona_db($mysqli);
				$sql = "SELECT * FROM $table WHERE id=$id";
				$result = DB::consulta_tb($mysqli,$sql);
			}
		}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php
		$current_pg = "Subategoría";
		$current_pg3 = "Viendo ".$current_pg;
		$title="Blogs | ".$current_pg3;
		$current_pg2 = $current_pg3;
		$copy_year = date("Y",strtotime("today"));
		include("structure/head.php");
		$breadcrumb = [
			[
				"link" => "/",
				"word" => "Dashboard",
			],
			[
				"link" => "/subcategories",
				"word" => "Subcategorías",
			],
			[
				"link" => "/subcategories/".$table,
				"word" => $current_pg2,
			]
		];
	?>
</head>
<body class="sb-nav-fixed">
	<?php
		$active_menu = "subcategories_mn";
		$collapse = "subcategories";
		$active_opt = "subcategories-view";
		include("structure/navbar.php");

		$row=mysqli_fetch_array($result, MYSQLI_ASSOC);
		$titles = [
			"ID",
			"Nombre",
			"Slug",
		];
		$fields = [
			"id",
			"name",
			"slug_name",
		];

		$colspan = null;
		$extra = null;
	?>

	<div id="layoutSidenav">
	  <div id="layoutSidenav_nav">
	    <?php include("structure/menu.php"); ?>
	  </div>
	  <div id="layoutSidenav_content" class="force-d-block">
	    <main>
	      <div class="container-fluid px-4">
	        <?php include("structure/breadcrumb.php"); ?>

	        <div class="row mt-3">
	        	<div class="col-md-12">
	        		<div class="card">
	        			<div class="card-header">
	        				<i class="fas fa-info-circle fa-fw"></i>
	        				<?php echo $current_pg3; ?>
	        			</div>
	        			<div class="card-body">
	        				<?php include("structure/table-info.php"); ?>
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
</body>
</html>
<?php
	} else {
		Redirect::to("login");
	}
?>
