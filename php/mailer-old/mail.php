<?php
	header('Content-Type: text/html; charset=utf-8');

	/*Ya no muestra warnings y facilita el json parsing*/
	ini_set("display_errors",$_SESSION["d_errors"]); 0);

	if(session_status()==="") session_start();
	$_SESSION["_errors"] = "<ul>";
	$_errors = 0;

	// $_POST["name"] = "Ivan Ramírez";
	// $_POST["email"] = "iramirez@fabricadesoluciones.com";
	// $_POST["subject"] = "Viajes redondos";
	// $_POST["msg"] = "Mensaje de prueba.";

	if( !isset($_POST["name"]) && empty($_POST["name"]) ) {
		$_errors++;
		$_SESSION["_errors"] .= "<li>El campo <b>Nombre</b> es requerido.</li>";
	}
	if( !isset($_POST["email"]) && empty($_POST["email"]) ) {
		$_errors++;
		$_SESSION["_errors"] .= "<li>El campo <b>Correo</b> es requerido.</li>";
	}
	if( !isset($_POST["subject"]) && empty($_POST["subject"]) ) {
		$_errors++;
		$_SESSION["_errors"] .= "<li>El campo <b>Servicio de interés</b> es requerido.</li>";
	}
	if( !isset($_POST["msg"]) && empty($_POST["msg"]) ) {
		$_errors++;
		$_SESSION["_errors"] .= "<li>El campo <b>Mensaje</b> es requerido.</li>";
	}

	if( isset( $_POST["name"] ) && isset( $_POST["email"] ) && isset( $_POST["subject"] ) && isset( $_POST["msg"] ) && $_errors==0 ) {
		$name = $_POST["name"];
		$usr_mail = $_POST["email"];
		$subject = $_POST["subject"];
		$mensaje = $_POST["msg"];
		$production = false;
		$noreply = "contacto@nombre_dominio.com";
		$company = "Domain Name";

		// Save data on database
		include("../db/data.php");
		include("../db/conn.php");

		$mysqli = conectar_db();
		selecciona_db($mysqli);
		$data = array(
			0 => 'NULL',
			1 => "'".$name = $_POST["name"]."'",
			2 => "'".$usr_mail = $_POST["email"]."'",
			3 => "'".$subject = $_POST["subject"]."'",
			4 => "'".$mensaje = $_POST["msg"]."'",
			5 => "'".setTimeStamp()."'",
			6 => 'NULL',
			7 => 'NULL',
		);
		registro_nuevo("contact", $data, $columna=null);

		// GMail account
		// noreply.usogas@gmail.com
		// 0Nq2Hrvo

		if( $production )
			$webmaster = "contacto@nombre_dominio.com";
		else
			$webmaster = "iramirez@fabricadesoluciones.com";

		$body_msg_webmaster = "
			Recientemente $name se puso en contacto.
			<p></p>
			<b>Datos:</b><br>
			<b>Nombre:</b> $name<br>
			<b>Correo:</b> $usr_mail<br>
			<b>Asunto:</b> $subject<br>
			<b>Mensaje:</b> <br><br>$mensaje";

		$subject_webmaster = "Contacto Sitio Web ".$company;

		$body_msg_user = "
			¡Muchas gracias por su interés! En breve nos comunicaremos con usted.
			</br>
			Saludos<br>
			<strong>$company</strong>
		";

		$subject_usr = "Contacto ".$company;

		$headers_usr = "MIME-Version: 1.0"."\r\n".
									 "Content-type: text/html; charset=utf-8"."\r\n".
									 "From: ".$noreply."\r\n".
									 "X-Mailer: PHP/".phpversion();

		$headers_webmaster = "MIME-Version: 1.0"."\r\n".
												 "Content-type: text/html; charset=utf-8"."\r\n".
												 "From: Contacto Web - ".$company."<".$noreply.">\r\n".
												 "X-Mailer: PHP/".phpversion();

		/*Mail to user*/
		$mail_usr = mail($usr_mail, $subject_usr, $body_msg_user, $headers_usr);

		/*Mail to webmaster*/
		$mail_webmaster = mail($webmaster, $subject_webmaster, $body_msg_webmaster, $headers_webmaster);

		unset( $_SESSION["_errors"] );
		$_SESSION["_success"] = "Gracias por contactarnos, pronto nos pondremos en contacto contigo.";
		$errors = 0;
	} else {
		$_SESSION["_errors"] .= "</ul>";
	}

	if( $_errors==0 )
		header("Location: ../../gracias");
	else
		header("Location: ../../contacto");
?>
