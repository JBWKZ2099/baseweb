<?php
	header('Content-Type: text/html; charset=utf-8');
	ini_set("display_errors", "Off");
	$email = $_POST["email"];
	$name = $_POST["name"];
	$comment = $_POST["comment"];
	
	$id_blog = $_POST["id_blog"];
	$header = $_POST["header"];

	if( isset( $email ) && isset( $name ) && isset( $comment ) ) {
		$errors = 0;
		session_start();
		$errors = "<ul>";
		if( empty($email) ) {
			$errors .= "<li>El campo 'E-MAIL' es requerido.</li>";
			$errors++;
		}
		if( empty($name) ) {
			$errors .= "<li>El campo 'NOMBRE' es requerido.</li>";
			$errors++;
		}
		if( empty($comment) ) {
			$errors .= "<li>El campo 'MENSAJE' es requerido.</li>";
			$errors++;
		}
		$errors .= "</ul>";

		if( $errors==0 ) {
			include("php/defines.php");
			include("php/db.php");
			$mysqli = conectar_db();
			$tabla = "blog_comments";
			date_default_timezone_set("America/Mexico_City");
			$created_at = date("Y-m-d H:i:s");
			$datos[0] = "NULL";
			$datos[1] = "'".$id_blog."'";
			$datos[2] = "'".$email."'";
			$datos[3] = "'".$name."'";
			$datos[4] = "'".$comment."'";
			$datos[5] = "'".$created_at."'";

			$columna[0] = "id";
			$columna[1] = "id_blog";
			$columna[2] = "email";
			$columna[3] = "name";
			$columna[4] = "comment";
			$columna[5] = "created_at";

			$response = registro_nuevo($tabla, $datos, $columna);
			$_SESSION["_success"] = "Gracias por tu comentario.";
			header("Location: $header");
		} else {
			$_SESSION["_errors"] = $errors;
			header("Location: $header");
		}
	} else
		header("Location: ../blog");
?>