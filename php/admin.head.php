<?php
	session_start();
	if( !isset($_SESSION["path"]) ) {
		ini_set("display_errors",0);
		include( "header.lib.php" );
	}

	require $_SESSION["path"]["autoload"];
	include( $_SESSION["path"]["env"] );
	include( $_SESSION["path"]["auth"] );
?>
