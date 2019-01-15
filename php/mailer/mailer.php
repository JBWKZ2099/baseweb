<?php
	header('Content-Type: text/html; charset=utf-8');

	//SMTP needs accurate times, and the PHP time zone MUST be set
	//This should be done in your php.ini, but this is how to do it if you don't have access to that
	date_default_timezone_set("America/Mexico_City");
	setlocale(LC_ALL, "es_ES.UTF-8");
	ini_set("display_errors",1);

	session_start();
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
		$_SESSION["_errors"] .= "<li>El campo <b>Asunto</b> es requerido.</li>";
	}
	if( !isset($_POST["msg"]) && empty($_POST["msg"]) ) {
		$_errors++;
		$_SESSION["_errors"] .= "<li>El campo <b>Mensaje</b> es requerido.</li>";
	}

	if( $_SESSION["recaptcha"]=="v3" ) {
		if( !isset($_POST["action"]) && empty($_POST["action"]) && $_POST["action"]!="get_in_touch" ) {
			$_errors++;
			$_SESSION["_errors"] .= "<li>Ocurrió un error, por favor intentalo de nuevo.</li>";
		}
	} else {
		// if( isset($_POST["g-recaptcha-response"]) && !empty($_POST["g-recaptcha-response"]) ) {} else {
		if( !isset($_POST["g-recaptcha-response"]) && empty($_POST["g-recaptcha-response"]) ) {} else {
			$_errors++;
			$_SESSION["_errors"] .= "<li> Por favor da click en el reCaptcha. </li>";
		}
	}

	// var_dump($_POST);
	// echo $_errors;
	// exit();

	if( $_errors==0 ) {
		// Global variables
			$company = "Company Name";
			$webmaster = "iramirez@fabricadesoluciones.com";
			$wm_name = "Contacto Web - $company";
			$wm_password = "iR4M1R3Z2017*";
			$production = false;
			$_debug = 0;
		// Global variables

		// Mail method
		$phpmailer = false;

		//web site secret key
		$secret = "6LdZHooUAAAAAN4-5k86kiijoqVCfvbOokyOeeHN";
		//get verify response data
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$params = array( "secret"=>$secret, "response"=>$_POST["g-recaptcha-response"] );
		curl_setopt( $ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify" );
		curl_setopt( $ch, CURLOPT_POST, true );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query($params) );
		$result = curl_exec( $ch );

		if( $_SESSION["recaptcha"]=="v3" )
			$response_data = json_decode( $result )->success;
		else
			$response_data = json_decode( $result );

		// $response_data = true;
		// var_dump($response_data);
		// var_dump($_POST);
		// exit();

		/*success*/
		if( $response_data ) {
			if( $production ) {
				$mail_data_arr = array(
					"webmaster" => true,
					"main" => "mail1@example.com",
					"cc1" => "mail2@example.com",
				);

			} else {
				$mail_data_arr = array(
					"webmaster" => true,
					"main" => "iramirez@fabricadesoluciones.com",
					"cc1" => "hph2099@hotmail.com",
				);
			}

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

			$supplier_data = json_decode(json_encode(array(
				"webmaster" => false,
				"name" => $_POST["name"],
				"usr_mail" => $_POST["email"],
				"subject" => $_POST["subject"],
				"msg" => $_POST["msg"],
			)), FALSE);


			$mail_data = json_decode(json_encode($mail_data_arr), FALSE);

			if( $phpmailer ) {
				require 'PHPMailerAutoload.php';
				sendMailCustom($supplier_data, $supplier_data);
				sendMailCustom($mail_data, $supplier_data);
			} else {
				sendMailDefault($supplier_data, $supplier_data);
				sendMailDefault($mail_data, $supplier_data);
			}

			$errors = 0;
			unset($_SESSION["_errors"]);
			$_SESSION["_success"] = true;
			$_SESSION["thanks_message"] = "¡Muchas gracias por su interés! En breve nos comunicaremos con usted.";
		} else { /*error*/
			if( $_SESSION["recaptcha"]=="v3" )
				$_SESSION["_errors"] .= "<li> Ocurrió un error al verificar el reCaptcha, por favor intentalo de nuevo. </li>";
			else
				$_SESSION["_errors"] .= "<li> Ocurrió un error, por favor intentalo de nuevo. </li>";
			$_SESSION["_errors"] .= "</ul>";
			header("Location: ../../contacto");
		}
	} else {
		$_SESSION["_errors"] .= "</ul>";
	}

	if( $_errors==0 )
		header("Location: ../../gracias");
	else
		header("Location: ../../contacto");


	// PHPMailer
	function sendMailCustom($_mail, $_supplier_data) {
		global $webmaster;
		global $wm_name;
		global $wm_password;
		global $company;
		global $debug;

		//Create a new PHPMailer instance
		$mail = new PHPMailer;

		//Set Charset
		$mail->CharSet = "UTF-8";

		//Tell PHPMailer to use SMTP
		$mail->isSMTP();

		//Enable SMTP debugging
		// 0 = off (for production use)
		// 1 = client messages
		// 2 = client and server messages
		$mail->SMTPDebug = $debug;

		//Ask for HTML-friendly debug output
		$mail->Debugoutput = 'html';

		//Set the hostname of the mail server
		$mail->Host = 'smtp.gmail.com';
		// use
		// $mail->Host = gethostbyname('smtp.gmail.com');
		// if your network does not support SMTP over IPv6

		//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
		$mail->Port = 587;

		//Set the encryption system to use - ssl (deprecated) or tls
		$mail->SMTPSecure = 'tls';

		//Whether to use SMTP authentication
		$mail->SMTPAuth = true;

		//Username to use for SMTP authentication - use full email address for gmail
		$mail->Username = $webmaster;

		//Password to use for SMTP authentication
		$mail->Password = $wm_password;

		//Set who the message is to be sent from
		$mail->setFrom($webmaster, $wm_name);

		//Set who the message is to be sent to
		if( $_mail->webmaster ) {
			$mail->addAddress($_mail->main, $wm_name);
		} else {
			$mail->addAddress($_mail->usr_mail, $_mail->name);
		}

		if( $_mail->webmaster ) {
			// Unset the webmaster mail who will receive the mail
			unset( $_mail->main );

			// Unset webmaster to read the array correctly
			unset( $_mail->webmaster );

			//Set CC
			foreach( $_mail as $val ) {
				if( isset($val) && !empty($val) ) {
					$mail->AddCC($val); /* Con Copia */
					// $mail->AddBCC($val);  /* Con Copia Oculta */
				}
			}


			$subject = "Recientemente se pusieron en contacto";
			$initial = utf8_encode( file_get_contents("html_files/admin.php") );
			$initial1 = str_replace("%company%", $company, $initial);
			$initial2 = str_replace("%name%", $_supplier_data->name, $initial1);
			$initial3 = str_replace("%email%", $_supplier_data->email, $initial2);
			$initial4 = str_replace("%subject%", $_supplier_data->subject, $initial3);
			$body_file = str_replace("%msg%", $_supplier_data->msg, $initial4);
			$alt_body = "Se pusieron en contacto contigo.";
		} else {
			// Unset webmaster to read the array correctly
			unset( $_mail->webmaster );
			$subject = "Contacto Web - ".$company;
			$initial = utf8_encode( file_get_contents("html_files/supplier.php") );
			$body_file = str_replace("%company%", $company, $initial);
			$alt_body = "¡Muchas gracias por su interés! En breve nos comunicaremos con usted.";
		}

		//Set the subject line
		$mail->Subject = $subject;

		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body
		// $mail->msgHTML( $body_file, dirname(__FILE__) );
		$mail->msgHTML( $body_file );

		//Replace the plain text body with one created manually
		$mail->AltBody = $alt_body;

		// Debug $mail var
		// var_dump($mail->Body);
		// exit();

		// Send mail
		$mail->send();

		//send the message, check for errors
		/*if (!$mail->send()) {
		    echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
		    echo "Message sent!";
		}*/
	}

	// mail() native function
	function sendMailDefault($_mail, $supplier_data) {
		global $webmaster;
		global $company;

		$headers = "MIME-Version: 1.0"."\r\n".
							 "Content-type: text/html; charset=utf-8"."\r\n";

		//Set who the message is to be sent to
		if( $_mail->webmaster ) {
			$to = $_mail->main;
			$subject = "Recientemente se pusieron en contacto";
			$headers .= "From: ".$webmaster."\r\n";
			$initial = utf8_encode( file_get_contents("html_files/admin.php") );
			$initial1 = str_replace("%company%", $company, $initial);
			$initial2 = str_replace("%name%", $_supplier_data->name, $initial1);
			$initial3 = str_replace("%email%", $_supplier_data->email, $initial2);
			$initial4 = str_replace("%subject%", $_supplier_data->subject, $initial3);
			$body_file = str_replace("%msg%", $_supplier_data->msg, $initial4);
		} else {
			$to = $_mail->usr_mail;
			$subject = "Recientemente se pusieron en contacto";
			$headers .= "From: Contacto Web - ".$company."<".$webmaster.">\r\n";
			$initial = utf8_encode( file_get_contents("html_files/supplier.php") );
			$body_file = str_replace("%company%", $company, $initial);
		}

		$headers .= "X-Mailer: PHP/".phpversion();

		$mail_response = mail($to, $subject, $body_file, $headers);
	}
?>
