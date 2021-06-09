<?php
	session_start();
	// ini_set("display_errors",$_SESSION["d_errors"]);
	ini_set("display_errors",1);
	require $_SESSION["path"]["autoload"];
	include( $_SESSION["path"]["env"] );
	// include( realpath($_SERVER["DOCUMENT_ROOT"])."/php/db/auth.php" );
	$up_dir = "../../";

	// GMAIL
	$_mailer = json_decode(json_encode(array(
		"settings" => array(
			"host" => "smtp.gmail.com",
			"port" => 465,
			"smtpsecure" => "ssl",
			"smtpauth" => true,
			"username" => $env->MAIL_USER,
			"password" => $env->MAIL_PASSWORD,
			"setfrom" => $env->MAIL_USER,
			"name" => $env->APP_NAME,
		)
	)), FALSE);


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

			case "contact":
				$tbl = "`contact`";
				$columns = array(
					"$tbl.id",
					"$tbl.name",
					"$tbl.email",
				);
				$col_clean = array(
					"id",
					"name",
					"email",
				);
				$sql_data = array(
					"$tbl.`id`, $tbl.`name`, $tbl.`email` ",
					$tbl,
					"WHERE $tbl.`deleted_at` IS NULL "
				);
				echo DataTables::dataTable($_POST, $columns, $col_clean, $sql_data);
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

				$permissions = permissionJSONGenerator($_SESSION["permissions"], $_POST);
				// dd( $permissions );

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

				$data[] = $permissions;
				$tbl = "users";
				// dd( $data );
				DB::updateData($_POST["which"], $columns, $data, $tbl);
				// exit();
				Redirect::to($up_dir."admin/customers");

				break;

			case "create-customer":
				$tbl = $_POST["table"];

				$permissions = permissionJSONGenerator($_SESSION["permissions"], $_POST);

				// dd( $permissions );

				$columns = array(
					"id",
					"name",
					"last_name",
					"username",
					"email",
					"password",
					"forgot_password_token",
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
					'NULL',
					"'".$permissions."'",
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

				// dd( $sql_data );
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

			case "forgot-password":
				require ("../mailer/class.phpmailer.php");
				require ("../mailer/PHPMailerAutoload.php");

				$mail = new PHPMailer;

				$mail->IsSMTP();
				$mail->Debug = 0;

				global $_mailer;

				$mail->Host = $_mailer->settings->host;
				$mail->Port = $_mailer->settings->port;
				$mail->SMTPSecure = $_mailer->settings->smtpsecure;
				$mail->SMTPAuth = $_mailer->settings->smtpauth;

				$mail->Username = $_mailer->settings->username;
				$mail->Password = $_mailer->settings->password;
				$mail->From = $_mailer->settings->setfrom;
				$mail->FromName = $_mailer->settings->name;

				$mysqli = Connection::conectar_db();
				Connection::selecciona_db($mysqli);

				/* Obtenemos Nombre y Apellido del usuario */
				$sql = "SELECT * FROM `users` WHERE `users`.`email`='".$_POST["email"]."' AND `users`.`deleted_at` IS NULL";
				$result = DB::consulta_tb($mysqli,$sql);
				$count_row = mysqli_num_rows($result);

				if( $count_row>0 ) {
					$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
					$full_last_name = ( isset($row["last_name"]) && !empty($row["last_name"]) ? " ".$row["last_name"] : "" );

					/* Add token */
					$_token = randomString(20);
					$columns[] = "forgot_password_token";
					$data[] = $_token;
					DB::updateData($row["id"], $columns, $data, "users");
					$token_url = $env->APP_URL."admin/recuperar-contrasena-confirmar?token=$_token";

					$msg = "
						<table border='0' cellspacing='0' cellpadding='0' style='width: 600px; margin: 0 auto; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;'>
							<tbody>
								<tr>
									<!-- <td><img src='".$env->APP_URL."/assets/img/rak.png' alt='logo_rak'></td> -->
									<!-- <td><img src='".$env->APP_URL."/assets/img/RimetAzul.png' alt='logo_rimet'></td> -->

									<td><img style='width:150px;display:block;margin:0 auto;padding-bottom:15px;' src='".$env->APP_URL."assets/img/logo.png' alt='logo_email'></td>
								</tr>
								<tr>
									<td colspan='2'>
										<p style='font-family: Arial, Helvetica Neue, Helvetica, sans-serif;margin-bottom:15px;'>Hola,</p>
										<p style='font-family: Arial, Helvetica Neue, Helvetica, sans-serif;margin-bottom:15px;'>Enviamos el enlace de recuperación de contraseña a continuación:</p>
										<p style='font-family: Arial, Helvetica Neue, Helvetica, sans-serif;margin:0;'><a style='color:#006ea3;' href='".$token_url."' target='_blank'>Recuperar contraseña</a></p>

										<p style='font-family: Arial, Helvetica Neue, Helvetica, sans-serif;margin-bottom:15px;'>Si el enlace anterior no funciona intenta copiar la siguiente dirección:</p>
										<p style='font-family: Arial, Helvetica Neue, Helvetica, sans-serif;margin-bottom:15px;'>".$token_url."</p>
										<p style='font-family: Arial, Helvetica Neue, Helvetica, sans-serif;margin-top:30px;'>Enviado desde <a style='color:#006ea3;' href='".$env->APP_URL."' target='_blank'>".$env->APP_URL."</a></p>
									</td>
								</tr>
							</tbody>
						</table>
					";

					// echo $msg;
					// dd("???");

					$mail->addAddress($_POST["email"], utf8_decode($row["name"].$full_last_name));
					$mail->Subject = utf8_decode($env->APP_NAME." | Recuperar contraseña");
					$mail->msgHTML( utf8_decode($msg) );

					// dd( $token_url, $abs_path );
					// dd( $mail->send() );

					if( $mail->send() )
						$_SESSION["message"] = "Le enviamos un correo con un enlace para reestablecer su contraseña.";
					else
						$_SESSION["error"] = "Ocurrió un error, si éste persiste contacte al administrador del sistema.";

					header("Location: ".$up_dir."admin/login");
				} else {
					$_SESSION["error"] = "El correo proporcionado no existe, por favor intente de nuevo.";
					header("Location: ".$up_dir."admin/recuperar-contrasena");
				}

				exit();

				break;

			case "reset-password":
				session_start();

				if( $_POST["password"]==$_POST["password_confirm"]  ) {

					$id = $_SESSION["user_id"];

					$columns[] = "forgot_password_token";
					$columns[] = "password";

					$data[] = NULL;
					$data[] = Auth::cryptBlowfish($_POST["password"]);
					DB::updateData($id, $columns, $data, "users");

					unset($_SESSION["mail_forgot_password"]);
					unset($_SESSION["forgot_password_token"]);
					unset($_SESSION["user_id"]);

					$_SESSION["message"] = "Se reestableció correctamente su contraseña.";

					header("Location: ".$up_dir."admin/login");
				} else {
					$_SESSION["error"] = "Las contraseñas deben coincidir";
					header("Location: ".$up_dir."admin/recuperar-contrasena-confirmar?token=".$_SESSION["forgot_password_token"]);
					exit();
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

	function permissionJSONGenerator($permissions, $postvar) {
		/* Llenamos array para saber si viene 1 o 0 */
			$perms = array();

			foreach( $permissions as $key => $p ) {
				if( in_array("create", $p["permissions"]) )
					$perms[$key."_c"] = ( $postvar[$key."_c"]=="on" ) ? 1 : 0;
				if( in_array("read", $p["permissions"]) )
					$perms[$key."_r"] = ( $postvar[$key."_r"]=="on" ) ? 1 : 0;
				if( in_array("update", $p["permissions"]) )
					$perms[$key."_u"] = ( $postvar[$key."_u"]=="on" ) ? 1 : 0;
				if( in_array("delete", $p["permissions"]) )
					$perms[$key."_d"] = ( $postvar[$key."_d"]=="on" ) ? 1 : 0;
			}
		/* Llenamos array para saber si viene 1 o 0 */

		/* Armamos array para hacer implode de permisos */
			$_perms = "{";

			/* Seteamos las variables para superadmin y admin */
			$_perms .= "\"permission_superadmin\":".(($postvar["permission_superadmin"]=="on") ? 1 : 0).",";
			$_perms .= "\"permission_admin\":".(($postvar["permission_admin"]=="on") ? 1 : 0).",";
			/* Seteamos las variables para superadmin y admin */
			foreach( $perms as $key => $prm ) {
				$_perms .= "\"$key\":".$prm.",";
			}
			$_perms = substr($_perms, 0, -1)."}";


			// Assign permissions
				if( $postvar["permission_superadmin"]=="on" ) {
					$_perms = '{"permission_superadmin":1,"permission_admin":1,"permission_users_c":1,"permission_users_r":1,"permission_users_u":1,"permission_users_d":1,';

					foreach( $perms as $key => $p_2 ) {
						$_perms .= '"'.$key.'":1,';
					}
					$_perms = ( substr($_perms, 0, -1) ).'}';
					// $_perms = '"permission_blogs_c":1,"permission_blogs_r":1,"permission_blogs_u":1,"permission_blogs_d":1,"permission_categories_c":1,"permission_categories_r":1,"permission_categories_u":1,"permission_categories_d":1,"permission_subcategories_c":1,"permission_subcategories_r":1,"permission_subcategories_u":1,"permission_subcategories_d":1}';
					// dd("???", $_perms);
				}
			// /. Assign permissions
		/* Armamos array para hacer implode de permisos */


		// dd( json_decode($_perms, true)["permission_users_c"] );
		// dd( $_perms, $postvar, $permissions );

		return $_perms;
	}

	function randomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
	}
?>
