<?php
  require realpath($_SERVER["DOCUMENT_ROOT"])."/"."php/vendor/autoload.php";
  include( realpath($_SERVER["DOCUMENT_ROOT"])."/"."env.php" );
  $_SESSION["recaptcha"] = $env->GRECAPTCHA_VERSION;
?>
