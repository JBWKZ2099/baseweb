<?php
	session_start(); require $_SESSION["path"]["autoload"];
  include( $_SESSION["path"]["env"] );
	include( $_SESSION["path"]["auth"] );

	if( Auth::check() && Auth::user()->permission_admin==1 && Auth::user()->permission_contacts_r==1 ) {
		if( isset($_GET["id"]) ) {
			$id = (int)$_GET["id"];
			$table = "contact";
			if( !DB::validateData( $id, $table ) )
				header("Location: contacts");
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
		$current_pg2 = $title = "Viendo Contacto";
		$copy_year = date("Y",strtotime("today"));
		include("structure/head.php");
		$breadcrumb = [
			[
				"link" => "/",
				"word" => "Dashboard",
			],
			[
				"link" => "/contacts",
				"word" => "Contactos",
			],
			[
				"link" => "/contacts/".$table,
				"word" => $current_pg2,
			]
		];
	?>
</head>
<body class="sb-nav-fixed">
	<?php
		$active_menu = "contact_mn";
		$collapse = "contacts";
		$active_opt = "contact-view";
		include("structure/navbar.php");

		$row=mysqli_fetch_array($result, MYSQLI_ASSOC);
		$titles = [
			"ID",
			"Nombre",
			"E-Mail",
			"Teléfono",
		];
		$fields = [
			"id",
			"name",
			"email",
			"phone",
		];

		$colspan = null;
		$extra = "";
		$extra .= "<tr> <th>Como desea ser contactado</th>";
		$extra .= "<td> ".($row["contact_type"]==1 ? "E-Mail" : "Teléfono")." </td> </tr>";
		$extra .= "<tr> <th>Mensaje</th>";
		$extra .= "<td> ".$row["message"]." </td> </tr>";
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
	        				<?php echo $title; ?>
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
