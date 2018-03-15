<?php
	// ini_set("display_errors","On");
	session_start();
	// logout();
	// unset( $_SESSION );
	// $pswd_ed = "abc123";
	// echo $pswd_encrypted = cryptBlowfish("$pswd_ed");

	function validateLogin($usr, $pswd) {
		$mysqli = conectar_db();
		selecciona_db( $mysqli );

		$sql = "SELECT * FROM users WHERE username = '$usr' AND deleted_at IS NULL";
		$result = mysqli_query( $mysqli, $sql );

		$row = mysqli_fetch_array($result);
		$check = checkPass( $pswd, $row["password"] );

		if( !$check ) {
			return false;
		} else {
			$_SESSION["auth"] = true;
			$_SESSION["usr"] = $row["username"];
			$_SESSION["start"] = time();
			$_SESSION["expire"] = $_SESSION["start"] + (60*120); /* (sec*min) = total secs */
			return true;
		}
	}

	function authCheck() {
		if( isset($_SESSION["auth"]) ) return true;
		else return false;
	}

	function user() {
		$mysqli = conectar_db();
		selecciona_db( $mysqli );
		$usr = $_SESSION["usr"];
		$sql = "SELECT * FROM users WHERE username = '$usr'";

		$result = mysqli_query(  $mysqli, $sql );
		return mysqli_fetch_array($result, MYSQLI_ASSOC);
	}

	function logout() {
		/*Vaciar sesión*/
		$_SESSION = array();
		/*Destruir Sesión*/
		session_destroy();

		header("Location: ../../admin/");
	}

	function checkPass($pswd, $db_pswd) {
		if( crypt($pswd, $db_pswd) == $db_pswd ) return true;
		else return false;
	}

	function cryptBlowfish($psswd, $dig=7) {
		$set_salt = "./1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
		$salt = sprintf('$2a$%02d$', $dig);

		for($i = 0; $i < 22; $i++)
		 $salt .= $set_salt[mt_rand(0, 63)];

		return crypt($psswd, $salt);
	}
?>