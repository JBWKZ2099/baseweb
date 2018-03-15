<?php
	session_start();

	require('defines.php');

	$tbl_name = "users";

	$conexion = new mysqli(SERVER, USER, PASSWORD, DATABASE);

	if ($conexion->connect_error) {
		die("La conexion falló: " . $conexion->connect_error);
	}
	mysqli_query($conexion, 'SET NAMES "utf8"');

	$username = $_POST['user'];
	$password = base64_encode($_POST['password']);

	$sql = "SELECT * FROM $tbl_name WHERE username = '$username'";

	$result = $conexion->query($sql);
	if ($result->num_rows > 0) {
	}
	$row = $result->fetch_array(MYSQLI_ASSOC);
	if ($password == $row['password'] && $username == $row['username']) {
		$_SESSION['loggedin'] = true;
		$_SESSION['username'] = $row['username'];
		$_SESSION['permission'] = $row['permission'];
 		$_SESSION['start'] = time();
    $_SESSION['expire'] = $_SESSION['start'] + (60 * 120); /* (sec*min) = total secs */
    echo 1;
	} else echo 2;
	mysqli_close($conexion);
?>
