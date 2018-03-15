<?php
header('Content-Type: text/html; charset=UTF-8');
date_default_timezone_set('America/Mexico_City');
require('db.php');
//include("../php/connection.php");

$conexion = conectar_db();
selecciona_db($conexion);
mysqli_query ($conexion,"SET NAMES 'UTF8';");
if($_GET['action'] == 'listar')
{
	// valores recibidos por POST
	$sql = "SELECT * FROM blogs WHERE status <> 3";
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
		if( isset($row['edited_at']) && !empty($row['edited_at']) ) {
			$edited_at = date("d-m-Y", strtotime($row['edited_at']));
		} else {
			$edited_at = "Sin editar.";
		}
		$datos[] = array(
			'id'          => $row['id'],
			'name'      => $row['name'],
			'author'   => $row['author'],
			'type'   => $row['type'],
			'created_at'   => date("d-m-Y", strtotime($row['created_at'])),
			'edited_at'   => $edited_at,
			'status'   => $row['status']
		);
	}

	// convertimos el array de datos a formato json
	echo json_encode($datos);
}
 ?>