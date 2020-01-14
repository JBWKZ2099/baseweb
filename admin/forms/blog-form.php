<?php

	echo'
		<div class="form-group">
	    <label for="name">Título:</label>
	    <input type="text"
	    	class="form-control"
	    	id="name"
	    	name="name"
	    	placeholder="Título"
	    	value="'.( $edit ? $row['name'] : '').'">
	  </div> ';
	  /*<div class="form-group">
	    <label for="subname">Subtítulo:</label>
	    <textarea
	    	class="form-control"
	    	id="subname"
	    	name="subname"
	    	rows="3"
	    	placeholder="Subtítulo">'.$row['subname'].'</textarea>
	  </div>*/
	echo '
	  <div class="form-group">
	    <label for="author">Autor(es):</label>
	    <input class="form-control" type="text" placeholder="Autor(es)" id="author" name="author" value="'.$row['author'].'">
	  </div>
		<div class="form-group">
	    <label for="type">Tipo de Blog:</label>
	    <select class="form-control" id="type" name="type">';

	    if( !$edit )
	    	echo '<option value="null" selected="" hidden="" disabled="">Selecciona...</option>';

	echo'
	      <option value="1"';
	      if($row['type'] == 1) echo "selected";
	      echo '>Tipo 1</option>

	      <option value="2"';
	      if($row['type'] == 2) echo "selected";
	      echo '
	      >Tipo 2</option>

	      <option value="3"';
	      if($row['type'] == 3) echo "selected";
	      echo '
	      >Tipo 3</option>

	    </select>
	  </div>';

	  $show_cat = true;
	  $attr_style = "";

	  if( $row["type"]==2 || $row["type"]==3 )
	  	$attr_style = "style='display: none;'";

	echo '
		<div data-id="category" class="form-group" '.$attr_style.'>
	    <label for="category">Categoría:</label>
	    <select id="category" class="form-control" id="category" name="category"> ';

	    	if( !$edit ) {
	    		echo '<option value="null" selected="" hidden="" disabled="">Selecciona...</option>';
	    	}

	    	$show_subcat = false;

	    	if( $row["type"]==1 ) {
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
		    	var_dump( $row["category"] );
		    	foreach( $cat_options as $option ) {
		    		if( $row["category"]==$counter )
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
	  	if( $row["type"]==2 || $row["type"]==3 )
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
	    	if( $row["subcategory"]==$counter )
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
	    	placeholder="Meta">'.$row['meta'].'</textarea>
	  </div>
	  <div class="form-group">
	    <label for="meta_keywords">Meta (keywords):</label>
	    <textarea
	    	class="form-control"
	    	id="meta_keywords"
	    	name="meta_keywords"
	    	rows="3"
	    	placeholder="Meta">'.$row['meta_keywords'].'</textarea>
	  </div>
		<div class="form-group">
			<label>Portada (se recomienda de 1900x1080):</label>';

			if( $edit )
				echo '<img class="img-fluid d-block" src="../uploads/'.$row['cover'].'" style="width: 200px; height: auto;"> <br>';

	echo'
			<input class="form-control" type="file" id="cover" name="cover" />
		</div>
		<div class="form-group">
			<label>Texto alternativo portada</label>
			<input class="form-control" type="text" id="cover_alt" name="cover_alt" placeholder="Texto alternativo para la portada" value="'.$row['cover_alt'].'" />
		</div>
		<div class="form-group">
			<label>Imagen (se recomienda de 900x700):</label>';

			if( $edit )
				echo '<img class="img-fluid d-block" src="../uploads/'.$row['img'].'" style="width: 200px; height: auto;"> <br>';

	echo'
			<input class="form-control" type="file" id="files" name="files" />
		</div>
		<div class="form-group">
			<label>Texto alternativo imágen</label>
			<input class="form-control" type="text" id="img_alt" name="img_alt" placeholder="Texto alternativo para la portada" value="'.$row['img_alt'].'" />
		</div>


		<div class="form-group">
			<label>
			';
			if( isset($row["video"]) && !empty($row["video"]) && $row["video"]!=NULL && $row["video"]!="NULL" ) {
				$checked = "checked"; $value_checked = 1;
			} else {
				$checked = ""; $value_checked = 0;
				unset($row["video"]);
			}
			echo '
				<input id="is_video" type="checkbox" name="is_video" '.$checked.' value="'.$value_checked.'"> Insertar video?
			</label>
			<input type="text" class="form-control" name="url_video" placeholder="aVS4W7GZSq0" value="'.$row["video"].'">
			<small class="small help-block">
				Introduce únicamente el ID del video. https://www.youtube.com/watch?v=<strong>aVS4W7GZSq0</strong>
			</small>
		</div>


		<div class="form-group">
	    <label for="body">Cuerpo del Blog:</label>
			<textarea class="form-control" name="body" id="body" rows="10" cols="80">'.$row['body'].'</textarea>
		</div>
		<div class="form-group">
	    <label for="status">Tipo de Blog:</label>
	    <select class="form-control" id="status" name="status">

	      <option value="1"';
	      if($row['status'] == 1) echo "selected";
	      echo '>Publicado</option>

	      <option value="2"';
	      if($row['status'] == 2) echo "selected";
	      echo '
	      >No Publicado</option>


	    </select>
	  </div>
	  <input type="hidden" value="'.$row['id'].'" class="form-control" name="id">';
?>
