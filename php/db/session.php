<?php
	// ini_set("display_errors","Off");
	session_start();

	if( !isset($_SESSION["auth"]) && !$_SESSION["auth"] ) {
		header("Location: ../graficador/login");
		exit;
	}

	$now = time();
	// echo $_SESSION["expire"];
	// echo "\n".$now;
	if( $now > $_SESSION["expire"] ) {
		session_destroy();
		session_start();
		$_SESSION["error"] = "La sesión expiró, por favor inicia sesión de nuevo.";
		header("Location: ../graficador/login");
		exit;
	}
?>