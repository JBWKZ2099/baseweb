<?php
	include( realpath($_SERVER["DOCUMENT_ROOT"])."/php/header.lib.php" );

	define('SERVER',$env->DB_HOST);
	define('DATABASE',$env->DB_DATABASE);
	define('USER',$env->DB_USERNAME);
	define('PASSWORD',$env->DB_PASSWORD);
?>
