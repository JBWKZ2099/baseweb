<?php
  function slugger($text) {
    // replace non letter or digits by -
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);

    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // trim
    $text = trim($text, '-');

    // remove duplicate -
    $text = preg_replace('~-+~', '-', $text);

    // lowercase
    $text = strtolower($text);

    if (empty($text)) {
      return 'n-a';
    }

    return $text;
  }

  function isFile() {
    $actual_link = (isset($_SERVER["HTTPS"]) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    $ider = explode("-", $actual_link);
    if( array_key_exists(1,$ider) )
      $some = $ider[1];
    else
      $some = "";

    if($some != "") {
      $req = explode("/", $_SERVER["REQUEST_URI"]);
      $_GET["type"] = $req[2];

      $array = array( "file"=>$_GET["type"] );
    } else {
      $array = array(
        "no",
        explode("/", $_SERVER["REQUEST_URI"])[1]
      );
    }
    
    return $array;
  }
?>