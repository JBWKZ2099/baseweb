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

  function wblog() {
    $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $blog = explode('blog/', $actual_link);
    $url = "";

    if( isset($blog[1]) )
      $url = explode("/",$blog[1]);

    $_blog = [];

    if( isset($url[0]) )
      $_blog["category"] = explode("/",$blog[1])[0];

    if( isset($url[1]) )
      $_blog["subcategory"] = explode("/",$blog[1])[1];

    if( isset($url[2]) )
      $_blog["slug"] = explode("/",$blog[1])[2];

    if( count($_blog)>0 ) {
      dd("do stuff");
    } else {
      // dd("blog root");
      return 1;
    }
  }

  // function wblog() {
  //   $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  //   $blog = explode('blog/', $actual_link);

  //   /*
  //    * cuando el tipo no se puede dividir por guiones (-) entonces se le
  //    * concatena el guion para que pueda hacer la operación como si la url trajera
  //    * un guion (-)
  //   */
  //   $exploded = $blog[0];

  //   if( isset( $blog[1] ) )
  //     $exploded = explode("/",$blog[1])[0];

  //   $exploded02 = explode("?",$exploded)[0];
  //   if( $exploded02=="atm" )
  //     $blog[1] = "sth-atm";
  //   else if( $exploded02=="capacitacion" )
  //     $blog[1] = "sth-capacitacion";

  //   $ider = explode('-', $blog[0]);
  //   if( isset( $blog[1] ) )
  //     $ider = explode('-', $blog[1]);

  //   if( array_key_exists(1,$ider) ) $some = $ider[1];
  //   else $some = '';

  //   if($some != '') {
  //     $req = explode("/", $_SERVER['REQUEST_URI']);
  //     //var_dump($req);

  //     $_GET['type'] = $req[2];
  //     $_GET['id'] = $req[3];

  //     $array = array(
  //       'isblog' => $_GET['type'],
  //       'idblog' => $_GET['id']
  //     );
  //     return $array;
  //   } else return "no";
  // }

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

    // dd( $array );

    return $array;
  }

/*  function isFile() {
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
  }*/
?>
