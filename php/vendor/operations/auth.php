<?php
	// if(session_status()==="") session_start();
	// logout();
	// unset( $_SESSION );
	// $pswd_ed = "asdasd";
	// echo $pswd_encrypted = Auth::cryptBlowfish("$pswd_ed");
	// exit();

	class Auth {
		public static function validateLogin($usr, $pswd) {
			$mysqli = Connection::conectar_db();
			Connection::selecciona_db( $mysqli );


			$sql = "SELECT * FROM users WHERE username = '$usr' AND deleted_at IS NULL";
			$result = mysqli_query( $mysqli, $sql );

			$row = mysqli_fetch_array($result);
			$check = Auth::checkPass( $pswd, $row["password"] );

			if( !$check ) {
				return false;
			} else {
				Auth::loginAfterReg($row["username"]);
				return true;
			}
		}

		public static function loginAfterReg($username) {
			$_SESSION["auth"] = true;
			$_SESSION["usr"] = $username;
			$_SESSION["start"] = time();
			$_SESSION["expire"] = $_SESSION["start"] + (60*120); /* (sec*min) = total secs */
			/* Si se desea modificar el tiempo de la sesión, también hay que modificar el archivo /php/db/session.php */
		}

		public static function check() {
			if( isset($_SESSION["auth"]) ) return true;
			else return false;
		}

		public static function user() {
			$mysqli = Connection::conectar_db();
			Connection::selecciona_db( $mysqli );
			$usr = $_SESSION["usr"];
			$sql = "SELECT * FROM users WHERE username = '$usr'";

			$result = mysqli_query(  $mysqli, $sql );
			$usr_res = mysqli_fetch_array($result, MYSQLI_ASSOC);
			$usr_obj[] = json_decode( $usr_res["permissions"] );
			$usr_obj[] = json_decode( json_encode($usr_res), false );

			/* unimos array de objectos para que tenga permisos y los demás campos de usuarios */
			$response = (object) array_merge( (array)$usr_obj[0], (array)$usr_obj[1] );
			return $response;
		}

		public static function logout() {
			/*Vaciar sesión*/
			$_SESSION = array();
			/*Destruir Sesión*/
			session_destroy();

			Redirect::to("../../admin/");
		}

		public static function checkPass($pswd, $db_pswd) {
			if( crypt($pswd, $db_pswd) == $db_pswd ) return true;
			else return false;
		}

		public static function cryptBlowfish($psswd, $dig=7) {
			$set_salt = "./1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
			$salt = sprintf('$2a$%02d$', $dig);

			for($i = 0; $i < 22; $i++)
			 $salt .= $set_salt[mt_rand(0, 63)];

			return crypt($psswd, $salt);
		}
	}

	// Ejectar el siguiente comando para generar las lineas necesarias en composer
	// $ composer dump
	// Fuente: https://vegibit.com/composer-autoloading-tutorial/
?>
