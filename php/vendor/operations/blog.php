<?php
	class Blog {
		public static function test() { echo "HOLA"; }

	  public static function slugger($text) {
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

	  public static function blogUrl() {
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
	      return Blog::selectedBlog( $_blog["category"], $_blog["subcategory"], $_blog["slug"] )[0];
	    } else {
	      // dd("blog root");
	      return "root";
	    }
	  }

	  public static function all() {
	  	$mysqli = Connection::conectar_db();
	  	Connection::selecciona_db($mysqli);
	  	mysqli_query ($mysqli,"SET NAMES 'UTF8';");
	  	$tabla = "blogs";
	  	$tabla2 = "categories";
	  	$tabla3 = "subcategories";
	  	$query = "
	  		SELECT
	  			$tabla.id,
	  			$tabla.name,
	  			$tabla.subname,
	  			$tabla.author,
	  			$tabla.type,
	  			tbl2.slug_name AS category,
	  			tbl3.slug_name AS subcategory,
	  			$tabla.slug,
	  			$tabla.meta,
	  			$tabla.meta_keywords,
	  			$tabla.img,
	  			$tabla.img_alt,
	  			$tabla.cover,
	  			$tabla.cover_alt,
	  			$tabla.video,
	  			$tabla.body,
	  			$tabla.created_at,
	  			$tabla.updated_at,
	  			$tabla.deleted_at,
	  			$tabla.status
	  		FROM $tabla
	  			JOIN $tabla2 as tbl2 ON tbl2.id = $tabla.category
	  			JOIN $tabla3 as tbl3 ON tbl3.id = $tabla.subcategory
	  		WHERE $tabla.deleted_at IS NULL
	  	";
	  	$res = DB::consulta_tb($mysqli,$query);
	  	$blogs = [];
			// dd( $query );

	  	while( $row = mysqli_fetch_array($res) ) {
	  		$blogs[] = [
	  			"id" => $row["id"],
	  			"name" => $row["name"],
	  			"subname" => $row["subname"],
	  			"author" => $row["author"],
	  			"type" => $row["type"],
	  			"category" => $row["category"],
	  			"subcategory" => $row["subcategory"],
	  			"slug" => $row["slug"],
	  			"meta" => $row["meta"],
	  			"meta_keywords" => $row["meta_keywords"],
	  			"img" => $row["img"],
	  			"img_alt" => $row["img_alt"],
	  			"cover" => $row["cover"],
	  			"cover_alt" => $row["cover_alt"],
	  			"video" => $row["video"],
	  			"body" => $row["body"],
	  			"created_at" => $row["created_at"],
	  			"updated_at" => $row["updated_at"],
	  			"deleted_at" => $row["deleted_at"],
	  			"status" => $row["status"],
	  		];
	  	}

	  	// dd( $blogs );
	  	return $blogs;
	  }

	  public static function selectedBlog($category=null,$subcategory=null,$product=null) {
	  	// var_dump($category);
	  	// var_dump($subcategory);
	  	// var_dump($product);
	  	$mysqli = Connection::conectar_db();
	  	Connection::selecciona_db($mysqli);
	  	mysqli_query ($mysqli,"SET NAMES 'UTF8';");
	  	$tabla = "blogs";
	  	$tabla2 = "categories";
	  	$tabla3 = "subcategories";

	  	$query = "
	  		SELECT
	  			$tabla.id,
	  			$tabla.name,
	  			$tabla.subname,
	  			$tabla.author,
	  			$tabla.type,
	  			tbl2.slug_name AS category,
	  			tbl3.slug_name AS subcategory,
	  			$tabla.slug,
	  			$tabla.meta,
	  			$tabla.meta_keywords,
	  			$tabla.img,
	  			$tabla.img_alt,
	  			$tabla.cover,
	  			$tabla.cover_alt,
	  			$tabla.video,
	  			$tabla.body,
	  			$tabla.created_at,
	  			$tabla.updated_at,
	  			$tabla.deleted_at,
	  			$tabla.status
	  		FROM $tabla
	  			JOIN $tabla2 as tbl2 ON tbl2.id = $tabla.category AND tbl2.slug_name='$category'
	  			JOIN $tabla3 as tbl3 ON tbl3.id = $tabla.subcategory AND tbl3.slug_name='$subcategory'
	  		WHERE $tabla.deleted_at IS NULL
	  	";
	  	// dd( $query );
	  	$res = DB::consulta_tb($mysqli,$query);
	  	$blogs = [];

	  	while( $row = mysqli_fetch_array($res) ) {
	  		$blogs[] = [
	  			"id" => $row["id"],
	  			"name" => $row["name"],
	  			"subname" => $row["subname"],
	  			"author" => $row["author"],
	  			"type" => $row["type"],
	  			"category" => $row["category"],
	  			"subcategory" => $row["subcategory"],
	  			"slug" => $row["slug"],
	  			"meta" => $row["meta"],
	  			"meta_keywords" => $row["meta_keywords"],
	  			"img" => $row["img"],
	  			"img_alt" => $row["img_alt"],
	  			"cover" => $row["cover"],
	  			"cover_alt" => $row["cover_alt"],
	  			"video" => $row["video"],
	  			"body" => $row["body"],
	  			"created_at" => $row["created_at"],
	  			"updated_at" => $row["updated_at"],
	  			"deleted_at" => $row["deleted_at"],
	  			"status" => $row["status"],
	  		];
	  	}

	  	// dd( $blogs );
	  	return $blogs;
	  }

	  // public static function wblog() {
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

	  public static function isFile() {
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

	/*  public static function isFile() {
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

	  public static function blog_actual($mysqli, $tabla, $category, $type, $btype, $page, $search) {
	    // '$page' es la página actual ($_GET["page"])
	    // '$total' es el total de registros y se ocupa para poder calcular el número de resultados por página
	    // '$total_pages' guarda la cantidad total de páginas
	    // '$limit_1' es la cantidad de resultados, utilizada como tipo variable global tanto para la consulta como para el parámetro '$limit_0'
	    // '$limit_0' es la primer "página" de los resultados de la consulta sql

	    $btype = explode("?",$btype)[0];

	    $query = "SELECT COUNT(*) as num_rows FROM blogs WHERE";
	    if( $search!=null ) { // If user searchs something
	      $query .= " name LIKE '%$search%'";
	      $query .= " OR author LIKE '%$search%'";
	      $query .= " OR meta LIKE '%$search%'";
	      $query .= " OR meta_keywords LIKE '%$search%'";
	      $query .= " OR body LIKE '%$search%' AND";
	    }

	    if( isset($category) && !empty($category) && $type==1 )
	      $query .= " type = 1 AND category = $category AND ";
	    else if( $btype=="atm" )
	      $query .= " type = 2 AND ";
	    else if( $btype=="capacitacion" )
	      $query .= " type = 3 AND ";

	    $query .= " status = 1 ";
	    // echo $query;

	    $res = mysqli_query($mysqli, $query);
	    $total = mysqli_fetch_array($res)["num_rows"];
	    $limit_1 = 4;
	    mysqli_free_result($res);

	    $total_pages = $total / $limit_1;
	    $total_pages = ceil($total_pages);

	    $limit_0 = ($page*$limit_1)-$limit_1;

	    $sql = "SELECT * FROM ".$tabla." WHERE status = '1' ";
	    if( isset($category) && !empty($category) && $type==1 )
	      $sql .= "AND type = 1 AND category = $category ";
	    else if( $btype=="atm" ) {
	      $sql .= "AND type = 2 ";
	    } else if( $btype=="capacitacion" ) {
	      $sql .= "AND type = 3 ";
	    }

	    $sql .= "AND status = 1 ORDER BY created_at DESC LIMIT $limit_0,$limit_1";
	    // echo $sql;

	    $query = mysqli_query($mysqli,$sql);
	    $datos = array();
	    $pedro = 0;
	    $categories = categories_list($mysqli);
	    foreach( $categories as $category ) {
	      $cat_arr[$pedro] = $category["slug"];
	      $pedro++;
	    }
	    $pedro = 0;
	    while($row = mysqli_fetch_array($query)) {
	      if($row['type'] == 1) {
	        $_type = 'exccom-services';
	        if( $row['category']==1 ) $_category = $cat_arr[0];
	        if( $row['category']==2 ) $_category = $cat_arr[1];
	        if( $row['category']==3 ) $_category = $cat_arr[2];
	        if( $row['category']==4 ) $_category = $cat_arr[3];
	        if( $row['category']==5 ) $_category = $cat_arr[4];
	        if( $row['category']==6 ) $_category = $cat_arr[5];
	        if( $row['category']==7 ) $_category = $cat_arr[6];
	        if( $row['category']==8 ) $_category = $cat_arr[7];
	        if( $row['category']==9 ) $_category = $cat_arr[8];

	        if( isset($row["subcategory"]) && !empty($row["subcategory"]) ) {
	          if( $row["subcategory"]==1 ) $_subcategory = "conceptos";
	          if( $row["subcategory"]==2 ) $_subcategory = "casos-de-exito";
	          if( $row["subcategory"]==3 ) $_subcategory = "casos-de-uso";
	          if( $row["subcategory"]==4 ) $_subcategory = "testimonios";
	        } else {
	          $_subcategory = "";
	        }
	      }
	      if($row['type'] == 2) $_type = 'atm';
	      if($row['type'] == 3) $_type = 'capacitacion';


	      // if( $row['subcategory'] )

	      $datos[] = array(
	        'id' => $row['id'],
	        'img' => $row['img'],
	        'img_alt' => $row['img_alt'],
	        'name' => $row['name'],
	        'subname' => $row['subname'],
	        'type' => $_type,
	        'category' => $_category,
	        'subcategory' => $_subcategory,
	        'slug' => $row['slug'],
	        'author' => $row['author'],
	        'created_at' => $row['created_at'],
	        'body' => $row['body'],
	        'pages' => $total_pages,
	      );
	      if($pedro <= 9) $pedro++;
	    }
	    array_push($datos, array('pedro' => $pedro));
	    return $datos;
	    mysqli_close($mysqli);
	  }

	  public static function categories_list($mysqli) {
	    $sql = "SELECT * FROM categories ";

	    $query = mysqli_query($mysqli,$sql);
	    $datos = array();
	    while($row = mysqli_fetch_array($query)) {
	      $datos[] = array(
	        'id' => $row['id'],
	        'name' => $row['name'],
	        'slug' => $row['slug_name'],
	      );
	    }
	    return $datos;
	    mysqli_close($mysqli);
	    }

	  public static function blogs_from_cat($mysqli,$category) {
	    $sql = "SELECT * FROM blogs WHERE category = $category";

	    $query = mysqli_query($mysqli,$sql);
	    $datos = array();
	    while($row = mysqli_fetch_array($query)) {
	      $datos[] = array(
	        'name' => $row['name'],
	        'slug' => $row['slug'],
	      );
	    }
	    return $datos;
	    mysqli_close($mysqli);
	  }

	  public static function blogs_list($mysqli, $type){
	    $sql = "SELECT * FROM blogs WHERE status = '1' AND type = '".$type."' ORDER BY created_at DESC ";

	    $query = mysqli_query($mysqli,$sql);
	    $datos = array();
	    $pedro = 0;
	    $categories = categories_list($mysqli);
	    foreach( $categories as $category ) {
	      $cat_arr[$pedro] = $category["slug"];
	      $pedro++;
	    }
	    $pedro = 0;
	    while($row = mysqli_fetch_array($query)) {
	      if($row['type'] == 1) $_type = 'exccom-services';
	      if($row['type'] == 2) $_type = 'atm';
	      if($row['type'] == 3) $_type = 'capacitaciones';

	      if( $row["category"]==1 ) $category = $cat_arr[0];
	      if( $row["category"]==2 ) $category = $cat_arr[1];
	      if( $row["category"]==3 ) $category = $cat_arr[2];
	      if( $row["category"]==4 ) $category = $cat_arr[3];
	      if( $row["category"]==5 ) $category = $cat_arr[4];
	      if( $row["category"]==6 ) $category = $cat_arr[5];
	      if( $row["category"]==7 ) $category = $cat_arr[6];
	      if( $row["category"]==8 ) $category = $cat_arr[7];
	      if( $row["category"]==9 ) $category = $cat_arr[8];

	      $datos[] = array(
	        'id' => $row['id'],
	        'name' => $row['name'],
	        'type' => $_type,
	        'category' => $category,
	        'slug' => $row['slug']
	      );
	    }
	    return $datos;
	    mysqli_close($mysqli);
	  }

	  public static function blog_ver($mysqli, $tabla, $id, $type){
	    if( $id = explode("?", $id) )
	      $id = $id[0];

	    $categories = categories_list($mysqli);

	    $pedro = 0;
	    foreach( $categories as $category ) {
	      $cat_arr[$pedro] = $category["slug"];
	      $pedro++;
	    }

	    $_category = $_subcategory = $_type = $blog_cat = null;

	    if( $type==1 ) {
	      $sql = "SELECT * FROM ".$tabla." WHERE slug = '$id'";

	      $query = mysqli_query($mysqli,$sql);
	      $datos = array();
	      $pedro = 0;

	      while($row = mysqli_fetch_array($query)) {
	        if($row['type'] == 1){
	          $_type = 'exccom-services';
	          if( $row['category']==1 ) $_category = $cat_arr[0];
	          if( $row['category']==2 ) $_category = $cat_arr[1];
	          if( $row['category']==3 ) $_category = $cat_arr[2];
	          if( $row['category']==4 ) $_category = $cat_arr[3];
	          if( $row['category']==5 ) $_category = $cat_arr[4];
	          if( $row['category']==6 ) $_category = $cat_arr[5];
	          if( $row['category']==7 ) $_category = $cat_arr[6];
	          if( $row['category']==8 ) $_category = $cat_arr[7];
	          if( $row['category']==9 ) $_category = $cat_arr[8];

	          if( isset($row["subcategory"]) && !empty($row["subcategory"]) ) {
	            if( $row["subcategory"]==1 ) $_subcategory = "conceptos";
	            if( $row["subcategory"]==2 ) $_subcategory = "casos-de-exito";
	            if( $row["subcategory"]==3 ) $_subcategory = "casos-de-uso";
	            if( $row["subcategory"]==4 ) $_subcategory = "testimonios";
	          } else {
	            $_subcategory = "";
	          }
	        }
	        if($row['type'] == 2) $_type = 'ATM';
	        if($row['type'] == 3) $_type = 'Capacitacion';

	        $datos[] = array(
	          'id' => $row['id'],
	          'name' => $row['name'],
	          'subname' => $row['subname'],
	          'author' => $row['author'],
	          'type' => $_type,
	          'img_alt' => $row['img_alt'],
	          'category' => $_category,
	          'slug' => $row['slug'],
	          'meta' => $row['meta'],
	          'meta_keywords' => $row['meta_keywords'],
	          'img' => $row['img'],
	          'subcategory' => $_subcategory,
	          'cover' => $row['cover'],
	          'cover_alt' => $row['cover_alt'],
	          'created_at' => $row['created_at'],
	          'body' => $row['body'],
	          'video' => $row['video']
	        );
	        if($pedro <= 9) $pedro++;
	      }
	      array_push($datos, array('pedro' => $pedro));
	    } else {
	      if( $id==$cat_arr[0] || $id==$cat_arr[1] || $id==$cat_arr[2] || $id==$cat_arr[3] || $id==$cat_arr[4] || $id==$cat_arr[5] || $id==$cat_arr[6] || $id==$cat_arr[7] || $id==$cat_arr[8] )
	        $blog_type=1;
	      else if( $id=="atm" )
	        $blog_type=2;
	      else if( $id=="capacitacion" )
	        $blog_type=3;


	      if( $id==$cat_arr[0] )
	        $blog_cat = 1;

	      if( $id==$cat_arr[1] )
	        $blog_cat = 2;

	      if( $id==$cat_arr[2] )
	        $blog_cat = 3;

	      if( $id==$cat_arr[3] )
	        $blog_cat = 4;

	      if( $id==$cat_arr[4] )
	        $blog_cat = 5;

	      if( $id==$cat_arr[5] )
	        $blog_cat = 6;

	      if( $id==$cat_arr[6] )
	        $blog_cat = 7;

	      if( $id==$cat_arr[7] )
	        $blog_cat = 8;

	      if( $id==$cat_arr[8] )
	        $blog_cat = 9;


	      $sql = "SELECT * FROM ".$tabla." WHERE";
	      if( $blog_type==1 )
	        $sql .= " type = 1 AND category = $blog_cat";
	      else if( $blog_type==2 )
	        $sql .= " type = 2";
	      else if( $blog_type==3 )
	        $sql .= " type = 3";

	      $sql .= " ORDER BY created_at DESC";
	      // echo $_type;

	      $query = mysqli_query($mysqli,$sql);
	      $datos = array();
	      $pedro = 0;
	      while($row = mysqli_fetch_array($query)) {
	        $datos[] = array(
	          'id' => $row['id'],
	          'name' => $row['name'],
	          'subname' => $row['subname'],
	          'author' => $row['author'],
	          'type' => $blog_type,
	          'img_alt' => $row['img_alt'],
	          'category' => $blog_cat,
	          'subcategory' => $row["subcategory"],
	          'slug' => $row['slug'],
	          'meta' => $row['meta'],
	          'meta_keywords' => $row['meta_keywords'],
	          'img' => $row['img'],
	          'cover' => $row['cover'],
	          'cover_alt' => $row['cover_alt'],
	          'created_at' => $row['created_at'],
	          'body' => $row['body']
	        );
	      }
	    }
	    return $datos;
	    mysqli_close($mysqli);
	  }

	  public static function blog_at($mysqli, $tabla, $types, $noid){
	    if($types == "Diseño de Software") $types = '1';
	    if($types == "Marketing Digital") $types = '2';
	    if($types == "Diseño Gráfico Digital") $types = '3';
	    if($noid == 'no')
	    $sql = "SELECT * FROM ".$tabla." WHERE type = '$types' AND status = '1' ORDER BY created_at DESC";
	    else
	      $sql = "SELECT * FROM ".$tabla." WHERE type = '$types' AND status = '1' AND id <> $noid ORDER BY created_at DESC";

	    $query = mysqli_query($mysqli,$sql);
	    $datos = array();
	    $pedro = 0;

	    while($row = mysqli_fetch_array($query)) {
	      if($row['type'] == 1) $_type = 'Diseño de Software';
	      if($row['type'] == 2) $_type = 'Marketing Digital';
	      if($row['type'] == 3) $_type = 'Diseño Gráfico Digital';
	      $datos[] = array(
	        'id' => $row['id'],
	        'name' => $row['name'],
	        'subname' => $row['subname'],
	        'author' => $row['author'],
	        'type' => $_type,
	        'slug' => $row['slug'],
	        'meta' => $row['meta'],
	        'meta_keywords' => $row['meta_keywords'],
	        'img' => $row['img'],
	        'created_at' => $row['created_at'],
	        'body' => $row['body']
	      );
	      if($pedro <= 9) $pedro++;
	    }
	    array_push($datos, array('pedro' => $pedro));
	    return $datos;
	    mysqli_close($mysqli);
	  }

	  public static function getComments($mysqli,$id_blog) {
	    $sql = "SELECT * FROM blog_comments WHERE id_blog=$id_blog ORDER BY created_at DESC";
	    $res = mysqli_query($mysqli,$sql);
	    $count = mysqli_num_rows($res);

	    if( $count>0 ) {
	      while( $row=mysqli_fetch_array($res) ) {
	        $datos[] = array(
	          "email" => $row["email"],
	          "name" => $row["name"],
	          "comment" => $row["comment"],
	          "created_at" => $row["created_at"],
	        );
	      }
	    } else {
	      $datos = null;
	    }

	    return $datos;
	  }
	}

	// Ejectar el siguiente comando para generar las lineas necesarias en composer
	// $ composer dump
	// Fuente: https://vegibit.com/composer-autoloading-tutorial/
?>
