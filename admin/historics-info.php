<?php
ini_set("display_errors", "On");
	session_start();
	include("../php/db/conn.php");
	include("../php/db/auth.php");
	
	if( authCheck() ) {
		if( isset($_GET["id"]) ) {
			$id = (int)$_GET["id"];
			$table = "historics";
			if( !validateData( $id, $table ) )
				header("Location: historics");
			else {
				$mysqli = conectar_db();
				selecciona_db($mysqli);
				$sql = "SELECT * FROM $table WHERE id=$id";
				$result = consulta_tb($mysqli,$sql);
			}
		}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php
		$title="Viendo histórico";
		$copy_year = date("Y",strtotime("today"));
		include("structure/head.php");
	?>
</head>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
	<?php
		$active_menu = "historic_mn";
		$collapse = "historic";
		$active_opt = "historic-view";
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
								Viendo histórico
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-hover table-striped table-bordered">
										<tody>
											<?php
												$row=mysqli_fetch_array($result);
												$sql = null; $sql = "SELECT * FROM users WHERE id=".$row["user"]." ORDER BY company";
												$u_result = consulta_tb($mysqli,$sql);
												$u_row = mysqli_fetch_array($u_result);

												$html_resp = "<tr> <th>ID</th>";
												$html_resp .= "<td>".$row["id"]."</td> </tr>";
												$html_resp .= "<tr> <th>Nombre</th>";
												$html_resp .= "<td>".$row["name"]."</td> </tr>";
												$html_resp .= "<tr> <th>PDF</th>";
												$html_resp .= "<td> <a href='uploads/pdf/".$row["pdf"]."' download>Click aquí</a> </td> </tr>";
												$html_resp .= "<tr> <th>Usuario</th>";
												$html_resp .= "<td>".$u_row["name"]." ".$u_row["first_name"]." | ".$u_row["company"]."</td> </tr>";
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

	<?php include("structure/footer.php") ?>

	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fa fa-angle-up"></i>
	</a>
	<?php include("widgets/modal.php") ?>
</body>
</html>
<?php
	} else {
		header("Location: login");
	}
?>