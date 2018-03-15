<?php
	header('Content-Type: text/html; charset=UTF-8');
	require('db.php');
	$tabla = "users";
	$id = $_POST['id'];


	$columna[0] = "username";
	$columna[1] = "mail";
	$columna[2] = "permission";
	if($_POST['password'] != ''){
	$columna[3] = "password";
	}

	$datos[0] = "'".$_POST['username']."'";
	$datos[1] = "'".$_POST['email']."'";
	$datos[2] = "'".$_POST['permission']."'";
	if($_POST['password'] != ''){
		$datos[3] = "'".base64_encode($_POST['password'])."'";
	}
	var_dump($columna);
	actualizar_datos($tabla, $datos, $columna, $id);
	header('Location: ../table-user.php');

 ?>