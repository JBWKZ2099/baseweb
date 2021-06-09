<?php
	class Times {
		public static function test() {
			echo "HOLA";
		}

		public static function fileTime( $asset_path, $test=false ) {
		  include( realpath($_SERVER["DOCUMENT_ROOT"])."/"."env.php" );
		  $path = $env->APP_URL;
		  $has_http = strpos($asset_path, "http");
		  $has_https = strpos($asset_path, "https");

		  // if( $test ) {
				// dd( $test, $path.$asset_path );
		  // 	dd( $env );
		  // }

		  if( $has_http!==false || $has_https!==false ) {
		    $asset = $asset_path;
		  } else {
		    $file = filemtime($path.$asset_path);
		    $asset = $path.$asset_path."?".( !$file ? date("YmdHis") : $file );
		  }
		  echo $asset;
		}

		public static function setTimeStamp() {
			date_default_timezone_set("UTC");
			date_default_timezone_set("America/Mexico_City");
			return date("Y-m-d H:i:s");
		}
	}


	class Redirect {
		public static function to($location=null) {
			if($location){
				if(is_numeric($location)){
					switch ($location) {
						case 404:
							//header('HTTP/1.0 404 Not Found')
							//include 'includes/errors/404.php';
							exit();
							break;
					}//fin switch

				}//fin if
				header('Location: ' . $location);
				// exit();
			}//fin if
		}
	}

	class Files {
		public static function uploadPDF($files){
			$upload_path = "../graficador/uploads/pdf/";
			$info = pathinfo( $_FILES["pdf"]["name"] ); // Get file info
			$ext = $info["extension"]; // Get extension
			$validate_ext = "pdf";

			$ret_arr = array();

			if( $ext==$validate_ext ) {
				$fname = $info["filename"]; // Get file name without extension
				$rand = date("Y_m_d_Gis"); // Generate rand string (date)
				$new_name = $rand."_".$fname.".".$ext; // Creating new file name
				$target = $upload_path.$new_name; // Full path to save file
				move_uploaded_file($_FILES["pdf"]["tmp_name"], $target);
				$ret_arr[0] = $new_name;
				$ret_arr[1] = true;
			} else {
				$arr = array("status" => "error_ext");
				if(session_status()==="") session_start();
				$_SESSION["error"] = "La extensión del archivo subido no es correcta, debe ser ".$validate_ext;
				$ret_arr[0] = null;
				$ret_arr[1] = false;
			}
			return $ret_arr;
		}
	}

	class Tokens {
		public static function validateToken($token) {
			$_ret = false;
			session_start();

			if( isset($token) && !empty($token) ) {
				$mysqli = Connection::conectar_db();
				Connection::selecciona_db($mysqli);
				$sql = "SELECT * FROM `users` WHERE `users`.`forgot_password_token`='".$token."' AND `users`.`deleted_at` IS NULL";
				$result = DB::consulta_tb($mysqli,$sql);
				$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

				if( $row ) {
					$_SESSION["mail_forgot_password"] = $row["email"];
					$_SESSION["forgot_password_token"] = $token;
					$_SESSION["user_id"] = $row["id"];
					$_ret = true;
				} else {
					$_SESSION["error"] = "El token no es válido.";
				}
			} else {
				$_SESSION["error"] = "El token no es válido.";
			}

			// http://rak.test/ticketing/rimet/forgot-password-confirm?token=rAMTfUhszDe0dcKo4pf4
			// var_dump($_ret, $_SESSION);
			// exit();

			return $_ret;
		}
	}

	// Ejectar el siguiente comando para generar las lineas necesarias en composer
	// $ composer dump
	// Fuente: https://vegibit.com/composer-autoloading-tutorial/
?>
