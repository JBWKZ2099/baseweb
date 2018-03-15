<?php
	header('Content-Type: text/html; charset=UTF-8');
	date_default_timezone_set('America/Mexico_City');
	require('db.php');
	require('utils.php');
	$tabla = "blogs";
	$dir_subida = '../../uploads/';
	$name_real = $_FILES['files']['name'];
	$name = rand().$_FILES['files']['name'];
	$id = $_POST['id'];

	if($name_real != ''){
		$dir_subida = $dir_subida .$name;
		$resultado = move_uploaded_file($_FILES['files']['tmp_name'], $dir_subida);
	}

	$dir_subida02 = '../../uploads/';
	$name_real02 = $_FILES['cover']['name'];
	$name02 = rand().$_FILES['cover']['name'];
	if($name_real02 != ''){
		$dir_subida02 = $dir_subida02 .$name02;
		$resultado02 = move_uploaded_file($_FILES['cover']['tmp_name'], $dir_subida02);
	}

	$slug = slugger($_POST['name']);

	if( $_POST["type"]==2 || $_POST["type"]==3 )
		$category = NULL;
	else
		$category = $_POST['category'];

	$columna[0] = "name";
	$columna[1] = "subname";
	$columna[2] = "author";
	$columna[3] = "type";
	$columna[4] = "category";
	$columna[5] = "subcategory";
	$columna[6] = "slug";
	$columna[7] = "meta";
	$columna[8] = "meta_keywords";
	$columna[9] = "body";
	$columna[10] = "edited_at";
	$columna[11] = "status";
	$filled01 = false;
	if($name_real != '') {
		$columna[12] = "img";
		$columna[13] = "img_alt";
		$filled01 = true;
	}
	if($name_real02 != '' && $filled01) {
		$columna[14] = "cover";
		$columna[15] = "cover_alt";
	} else {
		$columna[12] = "img_alt";
		$columna[13] = "cover_alt";
	}

	$datos[0] = "'".$_POST['name']."'";
	$datos[1] = "'NULL'";
	$datos[2] = "'".$_POST['author']."'";
	$datos[3] = "'".$_POST['type']."'";
	$datos[4] = "'".$category."'";
	$datos[5] = "'".$_POST['subcategory']."'";
	$datos[6] = "'".$slug."'";
	$datos[7] = "'".$_POST['meta']."'";
	$datos[8] = "'".$_POST['meta_keywords']."'";
	$datos[9] = "'".str_replace('"', '\"', $_POST['body'])."'";
	$datos[10] = "'".date("Y-m-d H:i:s")."'";
	$datos[11] = "'".$_POST['status']."'";
	$filled = false;
	if($name_real != '') {
		$datos[12] = "'".$name."'";
		$datos[13] = "img_alt";
		$filled = true;
	}
	if($name_real02 != '' && $filled) {
		$datos[14] = "'".$name02."'";
		$datos[15] = "cover_alt";
	} else {
			$datos[12] = "'".$_POST["img_alt"]."'";
			$datos[13] = "'".$_POST["cover_alt"]."'";
	}
	// var_dump($_POST);
	// var_dump($columna);
	// var_dump($datos);
	// exit();

	actualizar_datos($tabla, $datos, $columna, $id);
	header('Location: ../panel-control.php');

 ?>