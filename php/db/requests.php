<?php
	session_start();
	ini_set("display_errors",$_SESSION["d_errors"]);
	require $_SESSION["path"]["autoload"];
	include( $_SESSION["path"]["env"] );
	// include( realpath($_SERVER["DOCUMENT_ROOT"])."/php/db/auth.php" );
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
				$validate = Auth::validateLogin( $usr, $pswd );

				if( $validate ) {
					Redirect::to($up_dir."admin/");
				} else {
					$_SESSION["error"] = "<ul><li>Usuario y/o contraseña incorrectos.</li></ul>";
					Redirect::to($up_dir."admin/login");
				}
				break;

			case "logout":
				Auth::logout();
				break;

			case "customer":
				$tbl = "`users`";
				$columns = array(
					"$tbl.id",
					"$tbl.name",
					"$tbl.last_name",
					"$tbl.username",
					"$tbl.email",
					"$tbl.permissions",
				);
				$col_clean = array(
					"id",
					"name",
					"last_name",
					"username",
					"email",
					"permissions",
				);
				$sql_data = array(
					"$tbl.`id`, $tbl.`name`, $tbl.`last_name`, $tbl.`username`, $tbl.`email` ",
					$tbl,
					"WHERE $tbl.`deleted_at` IS NULL "
				);
				echo DataTables::dataTable($_POST, $columns, $col_clean, $sql_data);
				break;

			case "update-customer":
				$password = null;
				if( isset($_POST["password"]) && !empty($_POST["password"]) )
					$password = $_POST["password"];

				/* Llenamos array para saber si viene 1 o 0 */
					$permissions = array(
						"permission_users",
						"permission_blogs",
						"permission_categories",
						"permission_subcategories",
					);
					$perms = array();

					foreach( $permissions as $p ) {
						$perms[$p."_c"] = ( $_POST[$p."_c"]=="on" ) ? 1 : 0;
						$perms[$p."_r"] = ( $_POST[$p."_r"]=="on" ) ? 1 : 0;
						$perms[$p."_u"] = ( $_POST[$p."_u"]=="on" ) ? 1 : 0;
						$perms[$p."_d"] = ( $_POST[$p."_d"]=="on" ) ? 1 : 0;
					}
				/* Llenamos array para saber si viene 1 o 0 */

				/* Armamos array para hacer implode de permisos */
					$_perms = "{";

					/* Seteamos las variables para superadmin y admin */
					$_perms .= "\"permission_superadmin\":".(($_POST["permission_superadmin"]=="on") ? 1 : 0).",";
					$_perms .= "\"permission_admin\":".(($_POST["permission_admin"]=="on") ? 1 : 0).",";
					/* Seteamos las variables para superadmin y admin */
					foreach( $perms as $key => $prm ) {
						$_perms .= "\"$key\":".$prm.",";
					}
					$_perms = substr($_perms, 0, -1)."}";


					// Assign permissions
						if( $_POST["permission_superadmin"]=="on" )
							$_perms = '{"permission_superadmin":1,"permission_admin":1,"permission_users_c":1,"permission_users_r":1,"permission_users_u":1,"permission_users_d":1,"permission_blogs_c":1,"permission_blogs_r":1,"permission_blogs_u":1,"permission_blogs_d":1,"permission_categories_c":1,"permission_categories_r":1,"permission_categories_u":1,"permission_categories_d":1,"permission_subcategories_c":1,"permission_subcategories_r":1,"permission_subcategories_u":1,"permission_subcategories_d":1}';
					// /. Assign permissions
				/* Armamos array para hacer implode de permisos */


				// dd( json_decode($_perms, true)["permission_users_c"] );
				// dd( $_perms );

				$columns = array(
					"name",
					"last_name",
					"username",
					"email",
				);
				if( isset($password) )
					$columns[] = "password";

				$columns[] = "permissions";

				$data = array(
					$_POST["name"],
					$_POST["last_name"],
					$_POST["username"],
					$_POST["email"],
				);
				if( isset($password) )
					$data[] = Auth::cryptBlowfish($password);

				$data[] = $_perms;
				$tbl = "users";
				// dd( $data );
				DB::updateData($_POST["which"], $columns, $data, $tbl);
				// exit();
				Redirect::to($up_dir."admin/customers");

				break;

			case "create-customer":
				$tbl = $_POST["table"];

				/* Llenamos array para saber si viene 1 o 0 */
					$permissions = array(
						"permission_users",
						"permission_blogs",
						"permission_categories",
						"permission_subcategories",
					);
					$perms = array();

					foreach( $permissions as $p ) {
						$perms[$p."_c"] = ( $_POST[$p."_c"]=="on" ) ? 1 : 0;
						$perms[$p."_r"] = ( $_POST[$p."_r"]=="on" ) ? 1 : 0;
						$perms[$p."_u"] = ( $_POST[$p."_u"]=="on" ) ? 1 : 0;
						$perms[$p."_d"] = ( $_POST[$p."_d"]=="on" ) ? 1 : 0;
					}
				/* Llenamos array para saber si viene 1 o 0 */

				/* Armamos array para hacer implode de permisos */
					$_perms = "{";

					/* Seteamos las variables para superadmin y admin */
					$_perms .= "\"permission_superadmin\":".(($_POST["permission_superadmin"]=="on") ? 1 : 0).",";
					$_perms .= "\"permission_admin\":".(($_POST["permission_admin"]=="on") ? 1 : 0).",";
					/* Seteamos las variables para superadmin y admin */
					foreach( $perms as $key => $prm ) {
						$_perms .= "\"$key\":".$prm.",";
					}
					$_perms = substr($_perms, 0, -1)."}";


					// Assign permissions
						if( $_POST["permission_superadmin"]=="on" )
							$_perms = '{"permission_superadmin":1,"permission_admin":1,"permission_users_c":1,"permission_users_r":1,"permission_users_u":1,"permission_users_d":1,"permission_blogs_c":1,"permission_blogs_r":1,"permission_blogs_u":1,"permission_blogs_d":1,"permission_categories_c":1,"permission_categories_r":1,"permission_categories_u":1,"permission_categories_d":1,"permission_subcategories_c":1,"permission_subcategories_r":1,"permission_subcategories_u":1,"permission_subcategories_d":1}';
					// /. Assign permissions
				/* Armamos array para hacer implode de permisos */


				// dd( json_decode($_perms, true)["permission_users_c"] );
				// dd( $_perms );

				$columns = array(
					"id",
					"name",
					"last_name",
					"username",
					"email",
					"password",
					"permissions",
					"created_at",
					"update_at",
					"deleted_at",
				);
				$password = Auth::cryptBlowfish($_POST["password"]);
				$data = array(
					'NULL',
					"'".$_POST["name"]."'",
					"'".$_POST["last_name"]."'",
					"'".$_POST["username"]."'",
					"'".$_POST["email"]."'",
					"'".$password."'",
					"'".$_perms."'",
					"'".Times::setTimeStamp()."'",
					'NULL',
					'NULL',
				);
				// dd($data);

				DB::registro_nuevo($tbl, $data, $columns);
				Redirect::to($up_dir."admin/customers");
				break;

			case "customer-restore":
				$tbl = "`users`";
				$tbl2 = "`permissions`";
				$columns = array(
					"$tbl.id",
					"$tbl.name",
					"$tbl.last_name",
					"$tbl.username",
					"$tbl.email",
					"$tbl.permission",
				);
				$col_clean = array(
					"id",
					"name",
					"last_name",
					"username",
					"email",
					"permission",
				);
				$sql_data = array(
					"$tbl.`id`, $tbl.`name`, $tbl.`last_name`, $tbl.`username`, $tbl.`email` ",
					$tbl,
					"WHERE $tbl.`deleted_at` IS NOT NULL "
				);
				echo DataTables::dataTable($_POST, $columns, $col_clean, $sql_data);
				break;

			case "blog":
				$tbl = "`blogs`";
				$columns = array(
					"$tbl.id",
					"$tbl.name",
					"$tbl.author",
					"$tbl.created_at",
					"$tbl.updated_at",
				);
				$col_clean = array(
					"id",
					"name",
					"author",
					"created_at",
					"updated_at",
				);
				$sql_data = array(
					"$tbl.`id`, $tbl.`name`, $tbl.`author`, $tbl.`created_at`, $tbl.`updated_at` ",
					$tbl,
					" WHERE $tbl.`deleted_at` IS NULL "
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

					$columna[] = "id";
					$columna[] = "name";
					$columna[] = "subname";
					$columna[] = "author";
					$columna[] = "type";
					$columna[] = "category";
					$columna[] = "subcategory";
					$columna[] = "meta";
					$columna[] = "meta_keywords";
					$columna[] = "img";
					$columna[] = "img_alt";
					$columna[] = "cover";
					$columna[] = "cover_alt";
					$columna[] = "body";
					$columna[] = "video";
					$columna[] = "status";
					$columna[] = "slug";
					$columna[] = "created_at";
					$columna[] = "edited_at";
					$columna[] = "deleted_at";

					if( $_POST['type']==2 || $_POST['type']==3 )
						$category = NULL;
					else
						$category = $_POST['category'];

					$datos[] = "NULL";
					$datos[] = "'".$_POST['name']."'";
					$datos[] = "'NULL'";
					$datos[] = "'".$_POST['author']."'";
					$datos[] = "'".$_POST['type']."'";
					$datos[] = "'".$category."'";
					$datos[] = "'".$_POST['subcategory']."'";
					$datos[] = "'".$_POST['meta']."'";
					$datos[] = "'".$_POST['meta_keywords']."'";
					$datos[] = "'".$name."'";
					$datos[] = "'".$_POST['img_alt']."'";
					$datos[] = "'".$cover_name."'";
					$datos[] = "'".$_POST['cover_alt']."'";
					$datos[] = "'".str_replace('"', '\"', $_POST['body'])."'";

					if( isset($_POST["is_video"]) && $_POST["is_video"]=="1" )
						$datos[] = "'".$_POST["url_video"]."'";
					else
						$datos[] = "NULL";

					$datos[] = "'".$_POST['status']."'";
					$datos[] = "'".$slug."'";
					$datos[] = "'".Times::setTimeStamp()."'";
					$datos[] = "NULL";
					$datos[] = "NULL";

					// dd($_POST["is_video"]);
					// dd( $columna, $datos );
					DB::registro_nuevo($tabla, $datos, $columna);
				} else {
					if(session_status()==="") session_start();
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

				$columna[] = "name";
				$columna[] = "subname";
				$columna[] = "author";
				$columna[] = "type";
				$columna[] = "category";
				$columna[] = "subcategory";
				$columna[] = "meta";
				$columna[] = "meta_keywords";
				$filled01 = false;
				if($name_real != '') {
					$columna[] = "img";
					$columna[] = "img_alt";
					$filled01 = true;
				}
				if($name_real02 != '' && $filled01) {
					$columna[] = "cover";
					$columna[] = "cover_alt";
				} else {
					if( $name_real02 ) {
						$columna[] = "cover";
						$columna[] = "cover_alt";
					}
				}
				$columna[] = "body";
				$columna[] = "video";
				$columna[] = "status";
				$columna[] = "slug_name";

				$datos[] = $_POST['name'];
				$datos[] = "NULL";
				$datos[] = $_POST['author'];
				$datos[] = $_POST['type'];
				$datos[] = $category;
				$datos[] = $_POST['subcategory'];
				$datos[] = $_POST['meta'];
				$datos[] = $_POST['meta_keywords'];
				if( isset($_POST["is_video"]) && $_POST["is_video"]=="1" )
					$id_video = $_POST["url_video"];
				else
					$id_video = NULL;

				$datos[] = str_replace('"', '\"', $_POST['body']);
				$datos[] = $id_video;
				$datos[] = $_POST['status'];
				$datos[] = $slug;
				$filled = false;
				if($name_real != '') {
					$datos[] = $name;
					$datos[] = $_POST["img_alt"];
					$filled = true;
				}
				if($name_real02 != '' && $filled) {
					$datos[] = $name02;
					$datos[] = $_POST["cover_alt"];
				} else {
					if( $name_real02 ) {
						$datos[] = $name02;
						$datos[] = $_POST["cover_alt"];
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
					"$tbl.id",
					"$tbl.name",
					"$tbl.author",
					"$tbl.created_at",
					"$tbl.updated_at",
				);
				$col_clean = array(
					"id",
					"name",
					"author",
					"created_at",
					"updated_at",
				);
				$sql_data = array(
					"$tbl.`id`, $tbl.`name`, $tbl.`author`, $tbl.`created_at`, $tbl.`updated_at` ",
					$tbl,
					" WHERE $tbl.`deleted_at` IS NOT NULL "
				);
				echo DataTables::dataTable($_POST, $columns, $col_clean, $sql_data);
				break;

			case "category":
				$tbl = "`categories`";
				$columns = array(
					"$tbl.id",
					"$tbl.name",
				);
				$col_clean = array(
					"id",
					"name",
				);
				$sql_data = array(
					"$tbl.`id`, $tbl.`name`",
					$tbl,
					" WHERE $tbl.`deleted_at` IS NULL "
				);
				echo DataTables::dataTable($_POST, $columns, $col_clean, $sql_data);
				break;

			case "update-category":
				include('../slug.lib.php');
				$slug_name = slugger($_POST["name"]);

				$columns = array(
					"name",
					"slug_name",
				);

				$data = array(
					$_POST["name"],
					$slug_name,
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
					"id",
					"name",
					"slug_name",
					"created_at",
					"update_at",
					"deleted_at",
				);
				$data = array(
					'NULL',
					"'".$_POST["name"]."'",
					"'".$slug_name."'",
					"'".Times::setTimeStamp()."'",
					'NULL',
					'NULL',
				);

				// var_dump($data);
				// exit();
				DB::registro_nuevo($tbl, $data, $columns);

				Redirect::to($up_dir."admin/categories");
				break;

			case "category-restore":
				$tbl = "`categories`";
				$columns = array(
					"$tbl.id",
					"$tbl.name",
				);
				$col_clean = array(
					"id",
					"name",
				);
				$sql_data = array(
					"$tbl.`id`, $tbl.`name` ",
					$tbl,
					" WHERE $tbl.`deleted_at` IS NOT NULL "
				);
				echo DataTables::dataTable($_POST, $columns, $col_clean, $sql_data);
				break;

			case "subcategory":
				$tbl = "`subcategories`";
				$columns = array(
					"$tbl.id",
					"$tbl.name",
				);
				$col_clean = array(
					"id",
					"name",
				);
				$sql_data = array(
					"$tbl.`id`, $tbl.`name`",
					$tbl,
					" WHERE $tbl.`deleted_at` IS NULL "
				);
				echo DataTables::dataTable($_POST, $columns, $col_clean, $sql_data);
				break;

			case "update-subcategory":
				include('../slug.lib.php');
				$slug_name = slugger($_POST["name"]);

				$columns = array(
					"name",
					"slug_name",
				);

				$data = array(
					$_POST["name"],
					$slug_name,
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
					"id",
					"name",
					"slug_name",
					"created_at",
					"update_at",
					"deleted_at",
				);
				$data = array(
					'NULL',
					"'".$_POST["name"]."'",
					"'".$slug_name."'",
					"'".Times::setTimeStamp()."'",
					'NULL',
					'NULL',
				);

				// var_dump($data);
				// exit();
				DB::registro_nuevo($tbl, $data, $columns);

				Redirect::to($up_dir."admin/subcategories");
				break;

			case "subcategory-restore":
				$tbl = "`subcategories`";
				$columns = array(
					"$tbl.id",
					"$tbl.name",
				);
				$col_clean = array(
					"id",
					"name",
				);
				$sql_data = array(
					"$tbl.`id`, $tbl.`name` ",
					$tbl,
					" WHERE $tbl.`deleted_at` IS NOT NULL "
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
					if(session_status()==="") session_start();
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
						$datos[] = "NULL";
						$datos[] = "'".$id_blog."'";
						$datos[] = "'".$email."'";
						$datos[] = "'".$name."'";
						$datos[] = "'".$comment."'";
						$datos[] = "'".Times::setTimeStamp()."'";
						$datos[] = "NULL";
						$datos[] = "NULL";

						$columna[] = "id";
						$columna[] = "id_blog";
						$columna[] = "email";
						$columna[] = "name";
						$columna[] = "comment";
						$columna[] = "created_at";
						$columna[] = "updated_at";
						$columna[] = "deleted_at";


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

				// dd( $path );
				DB::deleteRecord($id, $tbl);
				Redirect::to($path);
				break;

			case "restore":
				$id = $_POST["id"];
				$tbl = $_POST["table"];
				$path = $_POST["path"];

				// dd( $path );
				DB::restoreRecord($id, $tbl);
				Redirect::to($path);
				break;

			default:
				break;
		}
	}
?>
