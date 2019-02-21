<?php
  ini_set('display_errors', 0);
  $rcpublic = "6LdZHooUAAAAAJu58OM6OwfGCM05uJ-exyjWE2BE";
  session_start();

  require getRealPath()."php/vendor/autoload.php";
  include( getRealPath()."env.php" );
  $_SESSION["recaptcha"] = $env->GRECAPTCHA_VERSION;

  // dd( $env->APP_NAME );
  dd( fileTime("assets/css/custom.css") );

  function fileTime( $asset_path ) {
    include( getRealPath()."env.php" );
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

  function getRealPath() {
    return $real_path = realpath($_SERVER["DOCUMENT_ROOT"])."/";
  }
?>
