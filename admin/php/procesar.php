<?php

//error_reporting(E_ALL);
//ini_set('display_errors', '1');


header('Content-Type: text/html; charset=UTF-8');
date_default_timezone_set('America/Mexico_City');
require('db.php');
require('utils.php');
$tabla = "blogs";
$dir_subida = $dir_subida02 = '../../uploads/';
$name = rand().$_FILES['files']['name'];
$dir_subida = $dir_subida .$name;
$resultado = move_uploaded_file($_FILES['files']['tmp_name'], $dir_subida);

$cover_name = rand().$_FILES['cover']['name'];
$dir_subida02 = $dir_subida02.$cover_name;
$resultado02 = move_uploaded_file($_FILES['cover']['tmp_name'], $dir_subida02);

if(!empty($resultado) && !empty($resultado02)){

	$slug = slugger($_POST['name']);

	$columna[0] = "id";
	$columna[1] = "name";
	$columna[2] = "subname";
	$columna[3] = "author";
	$columna[4] = "type";
	$columna[5] = "category";
	$columna[6] = "subcategory";
	$columna[7] = "slug";
	$columna[8] = "meta";
	$columna[9] = "meta_keywords";
	$columna[10] = "img";
	$columna[11] = "img_alt";
	$columna[12] = "cover";
	$columna[13] = "cover_alt";
	$columna[14] = "body";
	$columna[15] = "created_at";
	$columna[16] = "edited_at";
	$columna[17] = "deleted_at";
	$columna[18] = "status";

	if( $_POST['type']==2 || $_POST['type']==3 )
		$category = NULL;
	else
		$category = $_POST['category'];

	$datos[0] = "NULL";
	$datos[1] = "'".$_POST['name']."'";
	$datos[2] = "'NULL'";
	$datos[3] = "'".$_POST['author']."'";
	$datos[4] = "'".$_POST['type']."'";
	$datos[5] = "'".$category."'";
	$datos[6] = "'".$_POST['subcategory']."'";
	$datos[7] = "'".$slug."'";
	$datos[8] = "'".$_POST['meta']."'";
	$datos[9] = "'".$_POST['meta_keywords']."'";
	$datos[10] = "'".$name."'";
	$datos[11] = "'".$_POST['img_alt']."'";
	$datos[12] = "'".$cover_name."'";
	$datos[13] = "'".$_POST['cover_alt']."'";
	$datos[14] = "'".str_replace('"', '\"', $_POST['body'])."'";
	$datos[15] = "NULL";
	$datos[16] = "NULL";
	$datos[17] = "NULL";
	$datos[18] = "'".$_POST['status']."'";
  var_dump($datos);
	$algo = registro_nuevo($tabla, $datos, $columna);
	echo $algo;
	header('Location: ../panel-control.php');
}

 ?>