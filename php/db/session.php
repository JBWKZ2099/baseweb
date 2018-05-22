<?php
	// ini_set("display_errors","Off");
	session_start();

	if( !isset($_SESSION["auth"]) && !$_SESSION["auth"] ) {
		header("Location: ../admin/login");
		exit;
	}

	$now = time();
	// echo $_SESSION["expire"];
	// echo "\n".$now;
	if( $now > $_SESSION["expire"] ) {
		session_destroy();
		session_start();
		$_SESSION["error"] = "La sesión expiró, por favor inicia sesión de nuevo.";
		header("Location: ../admin/login");
		exit;
	} else {
		/*Código para que cuando se refresque la página se vuelva a setear la variable y así la sesión no expire, a menos que haya inactividad.*/
		$_SESSION["start"] = time();
		$_SESSION["expire"] = $_SESSION["start"] + (60*120); /* (sec*min) = total secs */
	}
?>