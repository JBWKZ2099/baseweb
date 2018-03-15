<?php 
	require('db.php');
	$id = $_POST['id'];
	$tabla = 'users';
	$mysqli = conectar_db();
	selecciona_db($mysqli);
	mysqli_query ($mysqli,"SET NAMES 'UTF8';");
	eliminar_registro($mysqli, $tabla, $id);
	return 0;

 ?>