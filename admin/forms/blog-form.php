<div class="form-group mb-3">
	<label for="name">Título:</label>
	<input type="text" class="form-control" id="name" name="name" placeholder="Título" value="<?php echo $edit ? $row['name'] : ''; ?>">
</div>

<div class="form-group mb-3">
  <label for="author">Autor(es):</label>
  <input class="form-control" type="text" placeholder="Autor(es)" id="author" name="author" value="<?php echo $row['author']; ?>">
</div>

<div class="form-group mb-3">
	<?php
		$checked_yes = "";
		$checked_no = "checked";
		$show_container = "none";

		if( $edit ) {
			if( isset($row["category"]) && !empty($row["category"]) ) {
				$checked_yes = "checked";
				$checked_no = "";
				$show_container = "block";
			}
		}
	?>
	<label for="has_cat" class="mr-3">¿Tendrá categorías?</label>
	<label for="has_cat_yes" class="mr-3">
		<input id="has_cat_yes" name="has_cat" type="radio" value="1" <?php echo $checked_yes; ?>> Sí
	</label>
	<label for="has_cat_no">
		<input id="has_cat_no" name="has_cat" type="radio" value="0" <?php echo $checked_no; ?>> No
	</label>
</div>

<div id="category-container" class="form-group mb-3" style="display:<?php echo $show_container; ?>;">
  <label for="category">Categoría:</label>
  <select class="form-control" id="category" name="category">
  	<option <?php echo !$edit ? "selected" : ""; ?> disabled>Selecciona...</option>

  	<?php while( $category = mysqli_fetch_array($result, MYSQLI_ASSOC) ) { ?>
  		<option <?php echo $edit ? ($row["category"]==$category["id"] ? "selected" : "") : "" ?> value="<?php echo $category["id"]; ?>"><?php echo $category["name"]; ?></option>
  	<?php } ?>
  </select>
</div>

<div class="form-group mb-3">
	<?php
		$checked_yes = "";
		$checked_no = "checked";
		$show_container = "none";

		if( $edit ) {
			if( isset($row["subcategory"]) && !empty($row["subcategory"]) ) {
				$checked_yes = "checked";
				$checked_no = "";
				$show_container = "block";
			}
		}
	?>

	<label for="has_subcat" class="mr-3">¿Tendrá subcategorías?</label>
	<label for="has_subcat_yes" class="mr-3">
		<input id="has_subcat_yes" name="has_subcat" type="radio" value="1" <?php echo $checked_yes; ?>> Sí
	</label>
	<label for="has_subcat_no">
		<input id="has_subcat_no" name="has_subcat" type="radio" value="0" <?php echo $checked_no; ?>> No
	</label>
</div>

<div id="subcategory-container" class="form-group mb-3" style="display:<?php echo $show_container; ?>;">
  <label for="subcategory">Subcategoría:</label>
  <select class="form-control" id="subcategory" name="subcategory">
  	<option <?php echo !$edit ? "selected" : ""; ?> disabled>Selecciona...</option>

  	<?php while( $subcategory = mysqli_fetch_array($result2, MYSQLI_ASSOC) ) { ?>
  		<option <?php echo $edit ? ($row["subcategory"]==$subcategory["id"] ? "selected" : "") : "" ?> value="<?php echo $subcategory["id"]; ?>"><?php echo $subcategory["name"]; ?></option>
  	<?php } ?>
  </select>
</div>

<div class="form-group mb-3">
  <label for="meta">Meta (description):</label>
  <textarea class="form-control" id="meta" name="meta" rows="3" maxlength="150" placeholder="Meta"><?php echo $row['meta']; ?></textarea>
</div>

<div class="form-group mb-3">
  <label for="meta_keywords">Meta (keywords):</label>
  <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" placeholder="Meta" value="<?php echo $row['meta_keywords']; ?>">
</div>

<div class="form-group mb-3">
	<label>Portada (se recomienda de 1900x1080):</label>
	<input class="form-control" type="file" id="cover" name="cover">

	<?php if( $edit ) { ?>
		<img class="img-fluid d-block pt-3" src="<?php echo $env->APP_URL."uploads/".$row['cover']; ?>" style="width: 400px; height: auto;">
	<?php } ?>
</div>

<div class="form-group mb-3">
	<label>Texto alternativo portada</label>
	<input class="form-control" type="text" id="cover_alt" name="cover_alt" placeholder="Texto alternativo para la portada" value="<?php echo $row['cover_alt']; ?>" />
</div>

<div class="form-group mb-3">
	<label>Portada (se recomienda de 900x700):</label>
	<input class="form-control" type="file" id="files" name="files" />

	<?php if( $edit ) { ?>
		<img class="img-fluid d-block pt-3" src="<?php echo $env->APP_URL."uploads/".$row['img']; ?>" style="width: 200px; height: auto;">
	<?php } ?>
</div>

<div class="form-group mb-3">
	<label>Texto alternativo imágen</label>
	<input class="form-control" type="text" id="img_alt" name="img_alt" placeholder="Texto alternativo para la portada" value="<?php echo $row['img_alt']; ?>" />
</div>

<div class="form-group mb-3">
  <label for="body">Cuerpo del Blog:</label>
	<textarea class="form-control" name="body" id="body" rows="10" cols="80"><?php echo $row['body']; ?></textarea>
</div>

<div class="form-group mb-3">
  <label for="status">Estatus:</label>
  <select class="form-control" id="status" name="status">
  	<option <?php echo !$edit ? "selected" : ""; ?> disabled>Selecciona...</option>
  	<option value="1" <?php echo $row["status"]==1 ? "selected" : ""; ?>>Publicado</option>
  	<option value="2" <?php echo $row["status"]==2 ? "selected" : ""; ?>>Borrador / Oculto</option>
  </select>
</div>
