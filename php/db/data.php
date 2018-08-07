<?php
	$server = false;
	if( $server ) {
		define('SERVER','localhost');
		define('USER', 'server_user');
		define('PASSWORD', 'server_password');
		define('DATABASE', 'server_database');
	} else {
		define('SERVER','localhost');
		define('USER', 'root');
		define('PASSWORD', 'root');
		define('DATABASE', 'base');
	}
?>