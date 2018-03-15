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
				<form action="php/procesar-edit.php" method="POST" enctype="multipart/form-data" onsubmit="return validateMyForm();">
				<?php
					$id = $_GET["id"];
					require('php/db.php');
					$mysqli = conectar_db();
					selecciona_db($mysqli);
					$tabla = 'blogs';
					$consulta = total_registros($mysqli, $tabla);
					if ($consulta->num_rows > 0) {
						while ($fila = $consulta->fetch_array()) {
							if($fila['id'] == $id){
								echo'
								<div class="col-sm-6 mt15 col-sm-offset-3">
									<div class="form-group">
								    <label for="name">Título:</label>
								    <textarea
								    	class="form-control"
								    	id="name"
								    	name="name"
								    	rows="3"
								    	placeholder="Título">'.$fila['name'].'</textarea>
								  </div> ';
								  /*<div class="form-group">
								    <label for="subname">Subtítulo:</label>
								    <textarea
								    	class="form-control"
								    	id="subname"
								    	name="subname"
								    	rows="3"
								    	placeholder="Subtítulo">'.$fila['subname'].'</textarea>
								  </div>*/
								echo '
								  <div class="form-group">
								    <label for="author">Autor(es):</label>
								    <input class="form-control" type="text" placeholder="Autor(es)" id="author" name="author" value="'.$fila['author'].'">
								  </div>
									<div class="form-group">
								    <label for="type">Tipo de Blog:</label>
								    <select class="form-control" id="type" name="type">

								      <option value="1"';
								      if($fila['type'] == 1) echo "selected";
								      echo '>Exccom Servicios</option>

								      <option value="2"';
								      if($fila['type'] == 2) echo "selected";
								      echo '
								      >ATM</option>

								      <option value="3"';
								      if($fila['type'] == 3) echo "selected";
								      echo '
								      >Capacitaciones</option>

								    </select>
								  </div>';

								  $show_cat = true;
								  $attr_style = "";

								  if( $fila["type"]==2 || $fila["type"]==3 )
								  	$attr_style = "style='display: none;'";

								echo '
									<div data-id="category" class="form-group" '.$attr_style.'>
								    <label for="category">Categoría:</label>
								    <select id="category" class="form-control" id="category" name="category"> ';

								    	$show_subcat = false;

								    	if( $fila["type"]==1 ) {
								    		$show_subcat = true;
								    		$cat_options = array(
								    			"Inteligencia de marca",
													"Planeación Estratégica",
													"Evaluación de Competitividad",
													"Medición de actividades de Marketing y Venta",
													"Determinación de Objetivos",
													"Dimensionamiento de Mercados",
													"Assessment Fuerza de Ventas",
													"Mineria de datos y dashboards",
													"Desarrollo de talento",
								    		);
								    	}

								    	if( $show_cat ) {
									    	$counter = 1;
									    	var_dump( $fila["category"] );
									    	foreach( $cat_options as $option ) {
									    		if( $fila["category"]==$counter )
									    			$selected = "selected='selected'";
									    		else
									    			$selected = "";

									    		echo "<option value='$counter' $selected>".$option."</option>";
									    		$counter++;
									    	}
								    	} else {
								    		// put array for options
								    	}

								echo ';
								    </select>
								  </div>';

								  	$style_attr = "";
								  	if( $fila["type"]==2 || $fila["type"]==3 )
								  		$show_subcat = true;

								  	if( !$show_subcat ) {
								  		$style_attr = "style='display: none;'";
								  	}

								echo'
									<div data-id="subcategory" class="form-group" '.$style_attr.'>
								    <label for="subcategory">Subcategoría:</label>
								    <select id="subcategory" class="form-control" id="subcategory" name="subcategory">';

								    $subcat_options = array(
								    	"Conceptos",
											"Casos de éxito",
											"Casos de uso",
											"Testimonios",
								    );
								    
								    $counter = 1;
								    foreach( $subcat_options as $option ) {
								    	if( $fila["subcategory"]==$counter )
								    		$selected = "selected='selected'";
								    	else
								    		$selected = "";

								    	echo "<option value='$counter' $selected>".$option."</option>";
								    	$counter++;
								    }

								echo'
								    </select>
								  </div>



								  <div class="form-group">
								    <label for="meta">Meta (description):</label>
								    <textarea
								    	class="form-control"
								    	id="meta"
								    	name="meta"
								    	rows="3"
								    	placeholder="Meta">'.$fila['meta'].'</textarea>
								  </div>
								  <div class="form-group">
								    <label for="meta_keywords">Meta (keywords):</label>
								    <textarea
								    	class="form-control"
								    	id="meta_keywords"
								    	name="meta_keywords"
								    	rows="3"
								    	placeholder="Meta">'.$fila['meta_keywords'].'</textarea>
								  </div>
									<div class="form-group">
										<label>Portada (se recomienda de 1900x1080):</label>
										<img class="img-responsive" src="../uploads/'.$fila['cover'].'" style="width: 200px; height: auto;">
										<br>
										<input type="file" id="cover" name="cover" />
									</div>
									<div class="form-group">
										<label>Texto alternativo portada</label>
										<input class="form-control" type="text" id="cover_alt" name="cover_alt" placeholder="Texto alternativo para la portada" value="'.$fila['cover_alt'].'" />
									</div>
									<div class="form-group">
										<label>Imagen (se recomienda de 900x700):</label>
										<img class="img-responsive" src="../uploads/'.$fila['img'].'" style="width: 200px; height: auto;">
										<br>
										<input type="file" id="files" name="files" />
									</div>
									<div class="form-group">
										<label>Texto alternativo imágen</label>
										<input class="form-control" type="text" id="img_alt" name="img_alt" placeholder="Texto alternativo para la portada" value="'.$fila['img_alt'].'" />
									</div>
									<div class="form-group">
								    <label for="body">Cuerpo del Blog:</label>
										<textarea name="body" id="body" rows="10" cols="80">'.$fila['body'].'</textarea>
									</div>
									<div class="form-group">
								    <label for="status">Tipo de Blog:</label>
								    <select class="form-control" id="status" name="status">

								      <option value="1"';
								      if($fila['status'] == 1) echo "selected";
								      echo '>Publicado</option>

								      <option value="2"';
								      if($fila['status'] == 2) echo "selected";
								      echo '
								      >No Publicado</option>


								    </select>
								  </div>
								  <input type="hidden" value="'.$fila['id'].'" class="form-control" name="id">
									<div class="form-group text-right">
										<button class="btn btn-success">Actualizar</button>
									</div>
								</div>';
							}
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
	    <script src="assets/js/ckeditor/ckeditor.js"></script>
	    <script src="assets/js/validateFormEdit.js"></script>
	    <script> CKEDITOR.replace('body'); </script>
	    <script src="assets/js/select-scripts.js"></script>
	</body>
	</html>