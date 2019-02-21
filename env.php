<?php
	session_start();
	ini_set("display_errors",0);

	/**
	 * Code to make absoulute paths (example: http://www.domain-name.com/assets/img/img_name.jpg);
	 */
	$path = (!empty($_SERVER['HTTPS']) ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'];
	/**
	 * Optimized code to work on local with virtualhosts or localhost or production server
	 */
	$path = (!empty($_SERVER['HTTPS']) ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'];

	$folder_name = "base";
	switch( $path ) {
	  case "http://localhost":
	    $path .= "/".$folder_name."/";
	    break;

	  case "http://fabricadesoluciones.info":
	    $path .= "/".$folder_name."/";
	    break;

	  default:
	    $path .= "/";
	    break;
	}
	// $path = $_SERVER['HTTP_HOST'] == 'localhost:8888' ? '/fabricadesoluciones.com/' : '';

	$env = json_decode(json_encode(array(
		"APP_NAME" => "Base Web",
		"APP_ENV" => "local",
		"APP_LOG_LEVEL" => "debug",
		"APP_FOLDER_NAME" => "base",
		"APP_URL" => $path,
		"DB_CONNECTION" => "mysql",
		"DB_HOST" => "127.0.0.1",
		"DB_CHARSET" => "utf8",
		"DB_DATABASE" => "base",
		"DB_USERNAME" => "root",
		"DB_PASSWORD" => "root",
		"GRECAPTCHA_VERSION" => "v3",
		"GRECAPTCHA_PUBLIC" => "6LdZHooUAAAAAJu58OM6OwfGCM05uJ-exyjWE2BE",
	)), FALSE);
?>
