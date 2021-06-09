<?php
	session_start(); require $_SESSION["path"]["autoload"];
  include( $_SESSION["path"]["env"] );
	include( $_SESSION["path"]["auth"] );

	if( Auth::check() && Auth::user()->permission_admin==1 && Auth::user()->permission_users_r==1 ) {
		if( isset($_GET["id"]) ) {
			$id = (int)$_GET["id"];
			$table = "users";
			if( !DB::validateData( $id, $table ) )
				header("Location: customers");
			else {
				$mysqli = Connection::conectar_db();
				Connection::selecciona_db($mysqli);
				$sql = "SELECT * FROM $table WHERE id=$id";
				$result = DB::consulta_tb($mysqli,$sql);
			}

			include("widgets/permissions.php");
		}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php
		$current_pg = "Usuario";
		$title="Viendo $current_pg";
		$copy_year = date("Y",strtotime("today"));
		include("structure/head.php");
	?>
</head>
<body class="sb-nav-fixed">
	<?php
		$active_menu = "customer_mn";
		$collapse = "customer";
		$active_opt = "customer-view";
		include("structure/navbar.php");

		$row=mysqli_fetch_array($result, MYSQLI_ASSOC);
		$row_obj = json_decode( $row["permissions"] );
		$titles = [
			"ID",
			"Nombre",
			"Apellido(s)",
			"Nombre de usuario",
			"E-Mail",
		];
		$fields = [
			"id",
			"name",
			"last_name",
			"username",
			"email",
		];

		$colspan = 4;
		$extra = "";
		$extra .= "
			<tr>
				<th> <p class='text-center mb-0'> Permisos </p></th>
				<th class='text-center'>Crear (Create)</th>
				<th class='text-center'>Leer (Read)</th>
				<th class='text-center'>Actualizar (Update)</th>
				<th class='text-center'>Eliminar (Delete)</th>
			</tr>
		";

		foreach( $permissions as $key => $p ) {
			$extra .= "
				<tr>
					<th>".$p["name"]."</th>
					<td class='text-center'>".( in_array("create", $p["permissions"]) ? ( ( $row_obj->{$key."_c"} ? "<i class='fa fa-check'></i>" : "<i class='fa fa-times'></i>" )."</td>" ) : " - " )." </td>
					<td class='text-center'>".( in_array("read", $p["permissions"]) ? ( ( $row_obj->{$key."_r"} ? "<i class='fa fa-check'></i>" : "<i class='fa fa-times'></i>" )."</td>" ) : " - " )." </td>
					<td class='text-center'>".( in_array("update", $p["permissions"]) ? ( ( $row_obj->{$key."_u"} ? "<i class='fa fa-check'></i>" : "<i class='fa fa-times'></i>" )."</td>" ) : " - " )." </td>
					<td class='text-center'>".( in_array("delete", $p["permissions"]) ? ( ( $row_obj->{$key."_d"} ? "<i class='fa fa-check'></i>" : "<i class='fa fa-times'></i>" )."</td>" ) : " - " )." </td>
				</tr>
			";
		}
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
