<?php
  session_start();
  $_SESSION["d_errors"] = 0;
  ini_set("display_errors",$_SESSION["d_errors"]);

  $realpath = realpath($_SERVER["DOCUMENT_ROOT"]);
  $_SESSION["path"]["autoload"] = $realpath."/php/vendor/autoload.php";
  $_SESSION["path"]["env"] = $realpath."/env.php";
  $_SESSION["path"]["auth"] = $realpath."/php/db/auth.php";

  require $_SESSION["path"]["autoload"];
  include( $_SESSION["path"]["env"] );

  $_SESSION["recaptcha"] = $env->GRECAPTCHA_VERSION;


  include($realpath."/php/lang/es.php");
?>
