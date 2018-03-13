<?php
	header('Content-Type: text/html; charset=utf-8');
	
	/*Ya no muestra warnings y facilita el json parsing*/
	ini_set("display_errors", 0);

	session_start();
	$_SESSION["_errors"] = "<ul>";
	$_errors = 0;

	// $_POST["name"] = "Ivan Ramírez";
	// $_POST["email"] = "iramirez@fabricadesoluciones.com";
	// $_POST["subject"] = "Asunto de prueba";
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
		$_SESSION["_errors"] .= "<li>El campo <b>Asunto</b> es requerido.</li>";
	}
	if( !isset($_POST["msg"]) && empty($_POST["msg"]) ) {
		$_errors++;
		$_SESSION["_errors"] .= "<li>El campo <b>Mensaje</b> es requerido.</li>";
	}

	if( isset( $_POST["name"] ) && isset( $_POST["email"] ) && isset( $_POST["subject"] ) && isset( $_POST["msg"] ) && $_errors==0 ) {
		$name = $_POST["name"];
		$usr_mail = $_POST["email"];
		$asunto = $_POST["subject"];
		$mensaje = $_POST["msg"];
		$production = false;
		$noreply = "contacto@nombre_dominio.com";
		$company = "Nombre Compañía";

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
			<b>Asunto:</b> $asunto<br>
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
		$_SESSION["_success"] = "Pronto nos pondremos en contacto contigo.";
	} else {
		$_SESSION["_errors"] .= "</ul>";
	}

	header("Location: ../../contacto");
?>