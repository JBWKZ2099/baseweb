<?php
	include("../php/admin.head.php");

	if( Auth::check() && Auth::user()->permission_admin==1 && Auth::user()->permission_categories_r==1 ) {
		if( isset($_GET["id"]) ) {
			$id = (int)$_GET["id"];
			$table = "categories";
			if( !DB::validateData( $id, $table ) )
				Redirect::to("categories");
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
		$active_menu = "categories_mn";
		$collapse = "categories";
		$active_opt = "categories-view";
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
								Viendo Categoría
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
												$html_resp .= "<tr> <th>Slug</th>";
												$html_resp .= "<td> ".$row["slug_name"]." </td> </tr>";
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
