<?php
	function fileTime( $asset_path ) {
	  include( realpath($_SERVER["DOCUMENT_ROOT"])."/"."env.php" );
	  $path = $env->APP_URL;
	  $has_http = strpos($asset_path, "http");
	  $has_https = strpos($asset_path, "https");

	  if( $has_http!==false || $has_https!==false ) {
	    $asset = $asset_path;
	  } else {
	    $file = filemtime($asset_path);
	    $asset = $path.$asset_path."?".$file;
	  }
	  return $asset;
	}

	// Fuente: https://vegibit.com/composer-autoloading-tutorial/
?>
