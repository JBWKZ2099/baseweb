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
		}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php
		$title="Viendo cliente";
		$copy_year = date("Y",strtotime("today"));
		include("structure/head.php");
	?>
</head>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
	<?php
		$active_menu = "customer_mn";
		$collapse = "customer";
		$active_opt = "customer-view";
		include("structure/navbar.php");
	?>

	<div class="content-wrapper">
		<div class="contianer-fluid">
			<div class="container-fluid">
				<div class="row mt-3">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header bg-blue text-white">
								<i class="fa fa-fw fa-info-circle"></i>
								Viendo cliente
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-hover table-striped table-bordered">
										<tody>
											<?php
												$row=mysqli_fetch_array($result);

												$html_resp = "<tr> <th>ID</th>";
												$html_resp .= "<td>".$row["id"]."</td> </tr>";
												$html_resp .= "<tr> <th>Nombre</th>";
												$html_resp .= "<td>".$row["name"]."</td> </tr>";
												$html_resp .= "<tr> <th>Apellido Paterno</th>";
												$html_resp .= "<td> ".$row["first_name"]." </td> </tr>";
												$html_resp .= "<tr> <th>Apellido Materno</th>";
												$html_resp .= "<td> ".$row["last_name"]." </td> </tr>";
												$html_resp .= "<tr> <th>Nombre de usuario</th>";
												$html_resp .= "<td> ".$row["username"]." </td> </tr>";
												$html_resp .= "<tr> <th>E-Mail</th>";
												$html_resp .= "<td> ".$row["email"]." </td> </tr>";
												$html_resp .= "<tr> <th>Permiso</th>";
												if( $row["permission"]==1 )
													$permission = "Administrador";
												else
													$permission = "Cliente";
												$html_resp .= "<td> ".$permission." </td> </tr>";
												echo $html_resp;
											?>
										</tody>
									</table>
								</div>
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
</body>
</html>
<?php
	} else {
		Redirect::to("login");
	}
?>
