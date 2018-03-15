<?php
	header('Content-Type: text/html; charset=UTF-8');
	require('db.php');
	$tabla = "users";

	$columna[0] = "id";
	$columna[1] = "username";
	$columna[2] = "password";
	$columna[3] = "email";
	$columna[4] = "permission";

	$datos[0] = "NULL";
	$datos[1] = "'".$_POST['username']."'";
	$datos[2] = "'".base64_encode($_POST['password'])."'";
	$datos[3] = "'".$_POST['email']."'";
	$datos[4] = "'".$_POST['permission']."'";
	$algo = registro_nuevo($tabla, $datos, $columna);
	header('Location: ../table-user.php');


 ?>