<?php
	require realpath($_SERVER["DOCUMENT_ROOT"])."/"."php/vendor/autoload.php";
  include( realpath($_SERVER["DOCUMENT_ROOT"])."/"."env.php" );
	include( realpath($_SERVER["DOCUMENT_ROOT"])."/php/db/auth.php" );
	$up_dir = "../../";


	if( isset($_POST["request"]) || isset($_GET["req"]) ) {
		if( $_SERVER["REQUEST_METHOD"]==="POST" ) {
			if( isset($_GET["req"]) )
				$request = $_GET["req"];
			else
				$request = $_POST["request"];

			if( isset($_GET["user_id"]) )
				$user_id = $_GET["user_id"];
		} else
			$request = $_GET["req"];

		switch( $request ) {
			case "login":
				$usr = $_POST["username"];
				$pswd = $_POST["password"];
				$validate = validateLogin( $usr, $pswd );

				if( $validate ) {
					Redirect::to($up_dir."admin/");
				} else {
					$_SESSION["error"] = "<ul><li>Usuario y/o contraseña incorrectos.</li></ul>";
					Redirect::to($up_dir."admin/login");
				}
				break;

			case "logout":
				logout();
				break;

			case "customer":
				$tbl = "`users`";
				$tbl2 = "`permissions`";
				$columns = array(
					0 => "$tbl.id",
					1 => "$tbl.name",
					2 => "$tbl.first_name",
					3 => "$tbl.last_name",
					4 => "$tbl.username",
					5 => "$tbl.email",
					6 => "$tbl.permission",
				);
				$col_clean = array(
					0 => "id",
					1 => "name",
					2 => "first_name",
					3 => "last_name",
					4 => "username",
					5 => "email",
					6 => "permission",
				);
				$sql_data = array(
					0 => "$tbl.`id`, $tbl.`name`, $tbl.`first_name`, $tbl.`last_name`, $tbl.`username`, $tbl.`email`, $tbl.`permission`, $tbl2.`name` AS 'permission' ",
					1 => $tbl,
					2 => "INNER JOIN $tbl2 ON $tbl.`permission`=$tbl2.`id` WHERE $tbl.`deleted_at` IS NULL AND `permission` != 1 "
				);
				echo DataTables::dataTable($_POST, $columns, $col_clean, $sql_data);
				break;

			case "update-customer":
				$password = null;
				if( isset($_POST["password"]) && !empty($_POST["password"]) )
					$password = $_POST["password"];

				$columns = array(
					0 => "name",
					1 => "first_name",
					2 => "last_name",
					3 => "username",
					4 => "email",
				);
				if( isset($password) )
					$columns[] = "password";

				$columns[] = "permission";

				$data = array(
					0 => $_POST["name"],
					1 => $_POST["first_name"],
					2 => $_POST["last_name"],
					3 => $_POST["username"],
					4 => $_POST["email"],
				);
				if( isset($password) )
					$data[] = cryptBlowfish($password);

				$data[] = $_POST["permission"];

				$columns[] = "updated_at";
				$data[] = Times::setTimeStamp();
				$tbl = "users";
				// var_dump($data); exit();
				DB::updateData($_POST["which"], $columns, $data, $tbl);
				// exit();
				Redirect::to($up_dir."admin/customers");

				break;

			case "create-customer":
				$tbl = $_POST["table"];
				$columns = array(
					0 => "id",
					1 => "name",
					2 => "first_name",
					3 => "last_name",
					4 => "username",
					5 => "email",
					6 => "password",
					7 => "permission",
					8 => "created_at",
					9 => "update_at",
					10 => "deleted_at",
				);
				$password = cryptBlowfish($_POST["password"]);
				$data = array(
					0 => 'NULL',
					1 => "'".$_POST["name"]."'",
					2 => "'".$_POST["first_name"]."'",
					3 => "'".$_POST["last_name"]."'",
					4 => "'".$_POST["username"]."'",
					5 => "'".$_POST["email"]."'",
					6 => "'".$password."'",
					7 => "'".$_POST["permission"]."'",
					8 => "'".Times::setTimeStamp()."'",
					9 => 'NULL',
					10 => 'NULL',
				);
				// var_dump($data);
				// exit();

				DB::registro_nuevo($tbl, $data, $columns);
				Redirect::to($up_dir."admin/customers");
				break;

			case "customer-restore":
				$tbl = "`users`";
				$tbl2 = "`permissions`";
				$columns = array(
					0 => "$tbl.id",
					1 => "$tbl.name",
					2 => "$tbl.first_name",
					3 => "$tbl.last_name",
					4 => "$tbl.username",
					5 => "$tbl.email",
					6 => "$tbl.permission",
				);
				$col_clean = array(
					0 => "id",
					1 => "name",
					2 => "first_name",
					3 => "last_name",
					4 => "username",
					5 => "email",
					6 => "permission",
				);
				$sql_data = array(
					0 => "$tbl.`id`, $tbl.`name`, $tbl.`first_name`, $tbl.`last_name`, $tbl.`username`, $tbl.`email`, $tbl.`permission`, $tbl2.`name` AS 'permission' ",
					1 => $tbl,
					2 => "INNER JOIN $tbl2 ON $tbl.`permission`=$tbl2.`id` WHERE $tbl.`deleted_at` IS NOT NULL "
				);
				echo DataTables::dataTable($_POST, $columns, $col_clean, $sql_data);
				break;

			case "blog":
				$tbl = "`blogs`";
				$columns = array(
					0 => "$tbl.id",
					1 => "$tbl.name",
					2 => "$tbl.author",
					3 => "$tbl.created_at",
					4 => "$tbl.updated_at",
				);
				$col_clean = array(
					0 => "id",
					1 => "name",
					2 => "author",
					3 => "created_at",
					4 => "updated_at",
				);
				$sql_data = array(
					0 => "$tbl.`id`, $tbl.`name`, $tbl.`author`, $tbl.`created_at`, $tbl.`updated_at` ",
					1 => $tbl,
					2 => " WHERE $tbl.`deleted_at` IS NULL "
				);
				echo DataTables::dataTable($_POST, $columns, $col_clean, $sql_data);
				break;

			case "create-blog":
				include('../slug.lib.php');
				$tabla = "blogs";
				$dir_subida = $dir_subida02 = '../../uploads/';
				$name = date("Y_m_d_His_").$_FILES['files']['name'];
				$dir_subida = $dir_subida .$name;
				$resultado = move_uploaded_file($_FILES['files']['tmp_name'], $dir_subida);

				$cover_name = date("Y_m_d_His_").$_FILES['cover']['name'];
				$dir_subida02 = $dir_subida02.$cover_name;
				$resultado02 = move_uploaded_file($_FILES['cover']['tmp_name'], $dir_subida02);

				if(!empty($resultado) && !empty($resultado02)){

					$slug = slugger($_POST['name']);

					$columna[0] = "id";
					$columna[1] = "name";
					$columna[2] = "subname";
					$columna[3] = "author";
					$columna[4] = "type";
					$columna[5] = "category";
					$columna[6] = "subcategory";
					$columna[7] = "slug";
					$columna[8] = "meta";
					$columna[9] = "meta_keywords";
					$columna[10] = "img";
					$columna[11] = "img_alt";
					$columna[12] = "cover";
					$columna[13] = "cover_alt";
					$columna[14] = "video";
					$columna[15] = "body";
					$columna[16] = "created_at";
					$columna[17] = "edited_at";
					$columna[18] = "deleted_at";
					$columna[19] = "status";

					if( $_POST['type']==2 || $_POST['type']==3 )
						$category = NULL;
					else
						$category = $_POST['category'];

					$datos[0] = "NULL";
					$datos[1] = "'".$_POST['name']."'";
					$datos[2] = "'NULL'";
					$datos[3] = "'".$_POST['author']."'";
					$datos[4] = "'".$_POST['type']."'";
					$datos[5] = "'".$category."'";
					$datos[6] = "'".$_POST['subcategory']."'";
					$datos[7] = "'".$slug."'";
					$datos[8] = "'".$_POST['meta']."'";
					$datos[9] = "'".$_POST['meta_keywords']."'";
					$datos[10] = "'".$name."'";
					$datos[11] = "'".$_POST['img_alt']."'";
					$datos[12] = "'".$cover_name."'";
					$datos[13] = "'".$_POST['cover_alt']."'";

					if( isset($_POST["is_video"]) && $_POST["is_video"]=="1" )
						$datos[14] = "'".$_POST["url_video"]."'";
					else
						$datos[14] = "NULL";

					$datos[15] = "'".str_replace('"', '\"', $_POST['body'])."'";
					$datos[16] = "'".Times::setTimeStamp()."'";
					$datos[17] = "NULL";
					$datos[18] = "NULL";
					$datos[19] = "'".$_POST['status']."'";
					// echo $_POST["is_video"];
				  // var_dump($columna);
				  // var_dump($datos);
				  // exit();
					DB::registro_nuevo($tabla, $datos, $columna);
				} else {
					session_start();
					$_SESSION["error"] = "Ocurrió un error: No se pudo crear el blog.";
				}
				Redirect::to($up_dir."admin/blogs");
				break;

			case "update-blog":
				include('../slug.lib.php');

				$tabla = "blogs";
				$dir_subida = '../../uploads/';
				$name_real = $_FILES['files']['name'];
				$name = date("Y_m_d_His_").$_FILES['files']['name'];
				$id = $_POST['id'];


				if($name_real != ''){
					$dir_subida = $dir_subida .$name;
					$resultado = move_uploaded_file($_FILES['files']['tmp_name'], $dir_subida);
				}

				$dir_subida02 = '../../uploads/';
				$name_real02 = $_FILES['cover']['name'];
				$name02 = date("Y_m_d_His_").$_FILES['cover']['name'];
				if($name_real02 != ''){
					$dir_subida02 = $dir_subida02 .$name02;
					$resultado02 = move_uploaded_file($_FILES['cover']['tmp_name'], $dir_subida02);
				}

				$slug = slugger($_POST['name']);

				if( $_POST["type"]==2 || $_POST["type"]==3 )
					$category = NULL;
				else
					$category = $_POST['category'];

				$columna[0] = "name";
				$columna[1] = "subname";
				$columna[2] = "author";
				$columna[3] = "type";
				$columna[4] = "category";
				$columna[5] = "subcategory";
				$columna[6] = "slug";
				$columna[7] = "meta";
				$columna[8] = "meta_keywords";
				$columna[9] = "video";
				$columna[10] = "body";
				$columna[11] = "status";
				$filled01 = false;
				if($name_real != '') {
					$columna[12] = "img";
					$columna[13] = "img_alt";
					$filled01 = true;
				}
				if($name_real02 != '' && $filled01) {
					$columna[14] = "cover";
					$columna[15] = "cover_alt";
				} else {
					if( $name_real02 ) {
						$columna[12] = "cover";
						$columna[13] = "cover_alt";
					}
				}

				$datos[0] = $_POST['name'];
				$datos[1] = "NULL";
				$datos[2] = $_POST['author'];
				$datos[3] = $_POST['type'];
				$datos[4] = $category;
				$datos[5] = $_POST['subcategory'];
				$datos[6] = $slug;
				$datos[7] = $_POST['meta'];
				$datos[8] = $_POST['meta_keywords'];
				if( isset($_POST["is_video"]) && $_POST["is_video"]=="1" )
					$id_video = $_POST["url_video"];
				else
					$id_video = NULL;

				$datos[9] = $id_video;
				$datos[10] = str_replace('"', '\"', $_POST['body']);
				$datos[11] = $_POST['status'];
				$filled = false;
				if($name_real != '') {
					$datos[12] = $name;
					$datos[13] = $_POST["img_alt"];
					$filled = true;
				}
				if($name_real02 != '' && $filled) {
					$datos[14] = $name02;
					$datos[15] = $_POST["cover_alt"];
				} else {
					if( $name_real02 ) {
						$datos[12] = $name02;
						$datos[13] = $_POST["cover_alt"];
					}
				}

				// var_dump($columna); echo "<br>";
				// var_dump($datos);
				// exit();

				DB::updateData($id, $columna, $datos, $tabla);
				Redirect::to($up_dir."admin/blogs");
				break;

			case "blog-restore":
				$tbl = "`blogs`";
				$columns = array(
					0 => "$tbl.id",
					1 => "$tbl.name",
					2 => "$tbl.author",
					3 => "$tbl.created_at",
					4 => "$tbl.updated_at",
				);
				$col_clean = array(
					0 => "id",
					1 => "name",
					2 => "author",
					3 => "created_at",
					4 => "updated_at",
				);
				$sql_data = array(
					0 => "$tbl.`id`, $tbl.`name`, $tbl.`author`, $tbl.`created_at`, $tbl.`updated_at` ",
					1 => $tbl,
					2 => " WHERE $tbl.`deleted_at` IS NOT NULL "
				);
				echo DataTables::dataTable($_POST, $columns, $col_clean, $sql_data);
				break;

			case "category":
				$tbl = "`categories`";
				$columns = array(
					0 => "$tbl.id",
					1 => "$tbl.name",
				);
				$col_clean = array(
					0 => "id",
					1 => "name",
				);
				$sql_data = array(
					0 => "$tbl.`id`, $tbl.`name`",
					1 => $tbl,
					2 => " WHERE $tbl.`deleted_at` IS NULL "
				);
				echo DataTables::dataTable($_POST, $columns, $col_clean, $sql_data);
				break;

			case "update-category":
				include('../slug.lib.php');
				$slug_name = slugger($_POST["name"]);

				$columns = array(
					0 => "name",
					1 => "slug_name",
				);

				$data = array(
					0 => $_POST["name"],
					1 => $slug_name,
				);

				$tbl = "categories";
				// var_dump($data); exit();
				DB::updateData($_POST["which"], $columns, $data, $tbl);
				// exit();
				Redirect::to($up_dir."admin/categories");
				break;

			case "create-category":
				include('../slug.lib.php');

				$tbl = $_POST["table"];
				$slug_name = slugger($_POST["name"]);

				$columns = array(
					0 => "id",
					1 => "name",
					2 => "slug_name",
					3 => "created_at",
					4 => "update_at",
					5 => "deleted_at",
				);
				$data = array(
					0 => 'NULL',
					1 => "'".$_POST["name"]."'",
					2 => "'".$slug_name."'",
					3 => "'".Times::setTimeStamp()."'",
					4 => 'NULL',
					5 => 'NULL',
				);

				// var_dump($data);
				// exit();
				DB::registro_nuevo($tbl, $data, $columns);

				Redirect::to($up_dir."admin/categories");
				break;

			case "category-restore":
				$tbl = "`categories`";
				$columns = array(
					0 => "$tbl.id",
					1 => "$tbl.name",
				);
				$col_clean = array(
					0 => "id",
					1 => "name",
				);
				$sql_data = array(
					0 => "$tbl.`id`, $tbl.`name` ",
					1 => $tbl,
					2 => " WHERE $tbl.`deleted_at` IS NOT NULL "
				);
				echo DataTables::dataTable($_POST, $columns, $col_clean, $sql_data);
				break;

			case "subcategory":
				$tbl = "`subcategories`";
				$columns = array(
					0 => "$tbl.id",
					1 => "$tbl.name",
				);
				$col_clean = array(
					0 => "id",
					1 => "name",
				);
				$sql_data = array(
					0 => "$tbl.`id`, $tbl.`name`",
					1 => $tbl,
					2 => " WHERE $tbl.`deleted_at` IS NULL "
				);
				echo DataTables::dataTable($_POST, $columns, $col_clean, $sql_data);
				break;

			case "update-subcategory":
				include('../slug.lib.php');
				$slug_name = slugger($_POST["name"]);

				$columns = array(
					0 => "name",
					1 => "slug_name",
				);

				$data = array(
					0 => $_POST["name"],
					1 => $slug_name,
				);

				$tbl = "subcategories";
				// var_dump($data); exit();
				DB::updateData($_POST["which"], $columns, $data, $tbl);
				// exit();
				Redirect::to($up_dir."admin/subcategories");

				break;

			case "create-subcategory":
				include('../slug.lib.php');

				$tbl = $_POST["table"];
				$slug_name = slugger($_POST["name"]);

				$columns = array(
					0 => "id",
					1 => "name",
					2 => "slug_name",
					3 => "created_at",
					4 => "update_at",
					5 => "deleted_at",
				);
				$data = array(
					0 => 'NULL',
					1 => "'".$_POST["name"]."'",
					2 => "'".$slug_name."'",
					3 => "'".Times::setTimeStamp()."'",
					4 => 'NULL',
					5 => 'NULL',
				);

				// var_dump($data);
				// exit();
				DB::registro_nuevo($tbl, $data, $columns);

				Redirect::to($up_dir."admin/subcategories");
				break;

			case "subcategory-restore":
				$tbl = "`subcategories`";
				$columns = array(
					0 => "$tbl.id",
					1 => "$tbl.name",
				);
				$col_clean = array(
					0 => "id",
					1 => "name",
				);
				$sql_data = array(
					0 => "$tbl.`id`, $tbl.`name` ",
					1 => $tbl,
					2 => " WHERE $tbl.`deleted_at` IS NOT NULL "
				);
				echo DataTables::dataTable($_POST, $columns, $col_clean, $sql_data);
				break;

			case "blog-entry":
				$tbl = $_POST["table"];
				$email = $_POST["email"];
				$name = $_POST["name"];
				$comment = $_POST["comment"];
				$id_blog = $_POST["id_blog"];
				$header = $_POST["header"];


				if( isset( $email ) && isset( $name ) && isset( $comment ) ) {
					$errors = 0;
					session_start();
					$errors = "<ul>";
					if( empty($email) ) {
						$errors .= "<li>El campo 'E-MAIL' es requerido.</li>";
						$errors++;
					}
					if( empty($name) ) {
						$errors .= "<li>El campo 'NOMBRE' es requerido.</li>";
						$errors++;
					}
					if( empty($comment) ) {
						$errors .= "<li>El campo 'MENSAJE' es requerido.</li>";
						$errors++;
					}
					$errors .= "</ul>";

					if( $errors==0 ) {
						$datos[0] = "NULL";
						$datos[1] = "'".$id_blog."'";
						$datos[2] = "'".$email."'";
						$datos[3] = "'".$name."'";
						$datos[4] = "'".$comment."'";
						$datos[5] = "'".Times::setTimeStamp()."'";

						$columna[0] = "id";
						$columna[1] = "id_blog";
						$columna[2] = "email";
						$columna[3] = "name";
						$columna[4] = "comment";
						$columna[5] = "created_at";

						DB::registro_nuevo($tbl, $datos, $columna);

						$_SESSION["message"] = "Gracias por tu comentario.";
						Redirect::to($header);
					} else {
						$_SESSION["error"] = $errors;
						Redirect::to($header);
					}
				}
				break;

			case "delete":
				$id = $_POST["id"];
				$tbl = $_POST["table"];
				$path = $_POST["path"];

				DB::deleteRecord($id, $tbl);
				Redirect::to($up_dir."admin/".$path);
				break;

			case "restore":
				$id = $_POST["id"];
				$tbl = $_POST["table"];
				$path = $_POST["path"];

				DB::restoreRecord($id, $tbl);
				Redirect::to($up_dir."admin/".$path);
				break;

			default:
				break;
		}
	}
?>
