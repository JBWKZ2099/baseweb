<?php
include('php/validator.php');
?>
	<!DOCTYPE html>
	<html lang="en">
	<?php require('structure/head.php'); ?>
	<body>
		<div class="container-custom">
			<div class="row mt30">
				<div class="col-sm-12 text-right">
					<p>
						<?php
							echo"¡Bienvenido! ".$_SESSION['username'];

						 ?>
						 <a href="php/logout.php" class="btn btn-orange">Cerrar Sesión</a>
					</p>
				</div>
				<div class="col-sm-12 text-center">
					<h3 class="color-rosa">Administración de Noticias</h3>
				</div>
				<div class="col-sm-12 mb30">
					<a href="panel-control.php" class="btn btn-default">Panel de Control</a>
				</div>
				<?php
					$id = $_GET["id"];
					require('php/db.php');
					$mysqli = conectar_db();
					selecciona_db($mysqli);
					$tabla = 'noticias';
					$consulta = total_registros($mysqli, $tabla);
					if ($consulta->num_rows > 0) {
						while ($fila = $consulta->fetch_array()) {
							if($fila['id'] == $id){
								echo'<div class="col-sm-6 mt15 col-sm-offset-3">
									<div class="table-responsive">
										<table class="table table-hover table-striped table-condensed table-bordered font-lato">
											<tr>
												<td>Nombre:</td>
												<td>'.$fila['name'].'</td>
											</tr>
											<tr>
												<td>SubNombre:</td>
												<td>'.$fila['subname'].'</td>
											</tr>
											<tr>
												<td>Link:</td>
												<td>'.$fila['link'].'</td>
											</tr>
											<tr>
												<td>Tipo:</td>
												<td>'.$fila['type'].'</td>
											</tr>
											<tr>
												<td>Imagen:</td>
												<td><img src="../uploads/'.$fila['img'].'" class="img-responsive"></td>
											</tr>
										</table>
									</div>
								</div>';
							}
						}
					}
				 ?>
		    </div>
			</div>
		</div>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	    <!-- Latest compiled and minified JavaScript -->
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	    <script src='http://code.jquery.com/ui/1.11.3/jquery-ui.js'></script>
	    <script src="assets/js/validateFormEdit.js"></script>
	</body>
	</html>