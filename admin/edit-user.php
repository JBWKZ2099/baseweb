<?php
include('php/validator.php');
include('php/validator-admin.php');
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
					<a href="table-user.php" class="btn btn-default">Tabla de Usuarios</a>
				</div>
				<form action="php/procesar-edit-user.php" method="POST" enctype="multipart/form-data" onsubmit="return validateMyForm();">
				<?php
					$id = $_GET["id"];
					require('php/db.php');
					$mysqli = conectar_db();
					selecciona_db($mysqli);
					$tabla = 'users';
						$consulta = $query = mysqli_query($mysqli,"SELECT * FROM $tabla");;
						while ($fila = mysqli_fetch_array($consulta)) {
							if($fila['id'] == $id){
								echo'<div class="col-sm-6 mt15 col-sm-offset-3">
										<div class="form-group">
											<label>Username:</label>
											<input type="text" name="username" id="username" placeholder="Username" class="form-control" value="'.$fila['username'].'">
										</div>
										<div class="form-group">
											<label>Email:</label>
											<input type="text" name="email" id="email" placeholder="Link" class="form-control" value="'.$fila['mail'].'">
										</div>
										<div class="form-group">
											<label>Permisos:</label>
											<select name="permission" id="permission" class="form-control">
												<option value="">Selecciona un permiso para el usuario</option>';
												if($fila['permission'] == '1'){
													echo'<option value="1" selected>Administrador</option>
													<option value="2">Usuario</option>';

												}
												elseif($fila['permission'] == '2'){
													echo'<option value="1">Administrador</option>
													<option value="2" selected>Usuario</option>';

												}
											echo'</select>
										</div>
										<div class="form-group">
											<label>Password:</label>
											<input type="password" name="password" id="password" placeholder="Password" class="form-control">
											<p class="help-block">Por seguridad el password aparece en blanco, si no lo desea cambiar dejar en blanco el campo.</p>
											<input type="hidden" value="'.$fila['id'].'" class="form-control" name="id">
										</div>
										<div class="form-group text-right">
											<button class="btn btn-success">Actualizar</button>
										</div>
									</div>';
							}
						}
				 ?>
				</form>
				<div id="alerts" style="position: fixed; top: 85px; width: 70%; z-index: 10; margin-left: 0px;">
		    <!-- Aquí aparecen los alerts que regresa el procesar.php -->
		    </div>
			</div>
		</div>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	    <!-- Latest compiled and minified JavaScript -->
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	    <script src='http://code.jquery.com/ui/1.11.3/jquery-ui.js'></script>
	    <script src="assets/js/validateFormEditUser.js"></script>
	</body>
	</html>