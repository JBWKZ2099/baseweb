<?php
    require('defines.php');
    function conectar_db(){
    	$mysqli = mysqli_connect(SERVER, USER, PASSWORD) 	or die ("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><p>No se pudo establer la conexi¨®n al servidor.</p></div>");
    	mysqli_query($mysqli, 'SET NAMES "utf8"');
    	return $mysqli;
    }

    function selecciona_db($mysqli){
    	mysqli_select_db($mysqli, DATABASE) or die ("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><p>No se pudo establer la conexión con la Base de Datos.</p></div>");
    }

    function registro_nuevo($tabla, $datos, $columna){
    	$mysqli = conectar_db();
    	selecciona_db($mysqli);

    	$Consulta = "INSERT INTO $tabla VALUES (";
    		for ($i=0; $i < count($datos); $i++) {
    			$Consulta = $Consulta.$datos[$i];
    			if ($i != count($datos)-1)
    				$Consulta.=",";
    		}
    		$Consulta.=")";
    	$pConsulta = consulta_tb($mysqli, $Consulta);

    	if (!$pConsulta) {
    		echo "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><p>No se pudo almacenar su informaci¨®n.</p></div>";
    	}
    	else{

    	}
    	cerrar_db($mysqli);
    }

    function getComments($mysqli,$id_blog) {
        $sql = "SELECT * FROM blog_comments WHERE id_blog=$id_blog";
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

     function consulta_tb($mysqli, $Sql){
        global $resultado;
        $resultado = mysqli_query($mysqli, $Sql);
        if($resultado <> NULL){
          return $resultado;
        }else{
          echo mysqli_error($mysqli);
        }
        mysqli_close($mysqli);
      }

      function total_registros($mysqli, $tabla){
    	$result = mysqli_query($mysqli, "SELECT * FROM ".$tabla." ORDER BY name ASC");
    	   return $result;
           mysqli_close($mysqli);
      }
      function filtro_registros($mysqli, $tabla, $tipo){
        $sql = "SELECT * FROM ".$tabla." WHERE type = '".$tipo."' ";

        $result = mysqli_query($mysqli, $sql);
        return $result;
        mysqli_close($mysqli);
      }

      function blog_actual($mysqli, $tabla, $category, $type, $btype, $page) {
        // '$page' es la página actual ($_GET["page"])
        // '$total' es el total de registros y se ocupa para poder calcular el número de resultados por página
        // '$total_pages' guarda la cantidad total de páginas
        // '$limit_1' es la cantidad de resultados, utilizada como tipo variable global tanto para la consulta como para el parámetro '$limit_0'
        // '$limit_0' es la primer "página" de los resultados de la consulta sql

        $btype = explode("?",$btype)[0];

        $query = "SELECT COUNT(*) as num_rows FROM blogs WHERE status = 1 ";
        if( isset($category) && !empty($category) && $type==1 )
            $query .= "AND type = 1 AND category = $category ";
        else if( $btype=="atm" )
            $query .= "AND type = 2 ";
        else if( $btype=="capacitacion" )
            $query .= "AND type = 3 ";

        $res = mysqli_query($mysqli, $query);
        $total = mysqli_fetch_array($res)["num_rows"];
        $limit_1 = 3;
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

      function categories_list($mysqli) {
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

      function blogs_from_cat($mysqli,$category) {
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

      function blogs_list($mysqli, $type){
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

      function blog_ver($mysqli, $tabla, $id, $type){
        if( $id = explode("?", $id) )
            $id = $id[0];

        $categories = categories_list($mysqli);
        
        $pedro = 0;
        foreach( $categories as $category ) {
            $cat_arr[$pedro] = $category["slug"];
            $pedro++;
        }

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
                    'body' => $row['body']
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
            echo $_type;

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

      function blog_at($mysqli, $tabla, $types, $noid){
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


    function actualizar_datos($tabla, $datos, $columna, $id){
            $mysqli = conectar_db();
            selecciona_db($mysqli);
            $Consulta = "UPDATE $tabla SET ";
            for ($i = 0; $i < count($datos); $i++) {
                $Consulta = $Consulta.$columna[$i].'='.$datos[$i];
                if ($i != count($datos) - 1)
                    $Consulta.=",";
            }
            $Consulta.=" WHERE id=".$id;
            // var_dump($Consulta);
            // exit();
            $pConsulta = consulta_tb($mysqli, $Consulta);
            if (!$pConsulta) {
                return 0;
            }else{
                return 1;
            }
            cerrar_db($mysqli);
        }
    function eliminar_registro($mysqli, $tabla, $id){
        $Consulta = "UPDATE ".$tabla." SET status = 3 WHERE id = '".$id."'";
        $result = mysqli_query($mysqli, $Consulta);
        return $result;
        mysqli_close($mysqli);
    }

    function cerrar_db($mysqli){
    	mysqli_close($mysqli);
    }
?>