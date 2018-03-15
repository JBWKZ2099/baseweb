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
				<form action="php/procesar.php" method="POST" enctype="multipart/form-data" onsubmit="return validateMyForm();">
					<div class="col-sm-6 mt15 col-sm-offset-3">
						<div class="form-group">
					    <label for="name">Título:</label>
					    <textarea class="form-control" id="name" name="name" rows="3" placeholder="Título"></textarea>
					  </div>
					  <?php /*
					  <div class="form-group">
					    <label for="subname">Subtítulo:</label>
					    <textarea
					    	class="form-control" id="subname" name="subname" rows="3" placeholder="Subtítulo"></textarea>
					  </div>
					  */ ?>
					  <div class="form-group">
					    <label for="author">Autor(es):</label>
					    <input class="form-control" type="text" placeholder="Autor(es)" id="author" name="author">
					  </div>
						<div class="form-group">
					    <label for="type">Tipo de Blog:</label>
					    <select class="form-control" id="type" name="type">
					      <option disabled selected>Selecciona...</option>
					      <option value="1">Exccom Servicios</option>
					      <option value="2">ATM</option>
					      <option value="3">Capacitaciones</option>
					    </select>
					  </div>
						<div data-id="category" class="form-group">
					    <label for="category">Categoría:</label>
					    <select id="category" class="form-control" id="category" name="category">
					      <option disabled selected>Selecciona...</option>
					    </select>
					  </div>
						<div data-id="subcategory" class="form-group" style="display: none;">
					    <label for="subcategory">Subcategoría:</label>
					    <select id="subcategory" class="form-control" id="subcategory" name="subcategory">
					      <option disabled selected>Selecciona...</option>
					      <option value="1">Conceptos</option>
					      <option value="2">Casos de éxito</option>
					      <option value="3">Casos de uso</option>
					      <option value="4">Testimonios</option>
					    </select>
					  </div>
					  <div class="form-group">
					    <label for="meta">Meta (description):</label>
					    <textarea
					    	class="form-control"
					    	id="meta"
					    	name="meta"
					    	rows="3"
					    	placeholder="Descripción del Blog"></textarea>
					  </div>
					  <div class="form-group">
					    <label for="meta_keywords">Meta (keywords):</label>
					    <textarea
					    	class="form-control" id="meta_keywords" name="meta_keywords" rows="3" placeholder="Ejemplo: programación | diseño gráfico | marketing"></textarea>
					  </div>
						<div class="form-group">
							<label>Portada (se recomienda de 1900x1080):</label>
							<input type="file" id="cover" name="cover" />
						</div>
						<div class="form-group">
							<label>Texto alternativo portada</label>
							<input class="form-control" type="text" id="cover_alt" name="cover_alt" placeholder="Texto alternativo para la portada" />
						</div>
						<div class="form-group">
							<label>Imagen (se recomienda de 900x700):</label>
							<input type="file" id="files" name="files" />
						</div>
						<div class="form-group">
							<label>Texto alternativo imágen</label>
							<input class="form-control" type="text" id="img_alt" name="img_alt" placeholder="Texto alternativo para la portada" />
						</div>
						<div class="form-group">
					    <label for="body">Cuerpo del Blog:</label>
							<textarea name="body" id="body" rows="10" cols="80"></textarea>
						</div>
						<div class="form-group">
					    <label for="status">Estatus:</label>
					    <select class="form-control" id="status" name="status">
					      <option disabled selected>Selecciona...</option>
					      <option value="1">Publicado</option>
					      <option value="2">No Publicado</option>
					    </select>
					  </div>
						<div class="form-group text-right">
							<button class="btn btn-success">Registrar</button>
						</div>
					</div>
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
	    <script src="assets/js/ckeditor/ckeditor.js"></script>
	    <script src="assets/js/validateForm.js"></script>
	    <script> CKEDITOR.replace('body'); </script>

	    <script src="assets/js/select-scripts.js"></script>
	</body>
	</html>