<?php
header('Content-Type: text/html; charset=UTF-8');
require('db.php');
//include("../php/connection.php");

$conexion = conectar_db();
selecciona_db($conexion);
mysqli_query ($conexion,"SET NAMES 'UTF8';");
if($_GET['action'] == 'listar')
{
	// valores recibidos por POST
	$sql = "SELECT * FROM users ";
	//Ordenar por
	if(isset($_POST['orderby'])){
		$vorder = $_POST['orderby'];

		if($vorder != ''){
			$sql .= " ORDER BY ".$vorder;
		}
	}

	$query = mysqli_query($conexion,$sql);
	$datos = array();

	while($row = mysqli_fetch_array($query))
	{

		$datos[] = array(
			'id'         => $row['id'],
			'username'   => $row['username'],
			'mail'       => $row['mail'],
			'permission' => $row['permission'],
		);
	}

	// convertimos el array de datos a formato json
	echo json_encode($datos);
}
 ?>