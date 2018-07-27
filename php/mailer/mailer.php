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
		$_SESSION["_errors"] .= "<li>El campo <b>Servicio de interés</b> es requerido.</li>";
	}
	if( !isset($_POST["msg"]) && empty($_POST["msg"]) ) {
		$_errors++;
		$_SESSION["_errors"] .= "<li>El campo <b>Mensaje</b> es requerido.</li>";
	}

	if( isset($_POST["g-recaptcha-response"]) && !empty($_POST["g-recaptcha-response"]) ) {} else {
		$_errors++;
		$_SESSION["_errors"] .= "<li> Por favor da click en el reCaptcha. </li>";
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
		$secret = "6LeLzmYUAAAAAA17cBXzWNxjZjVQ_v99D5je2sBT";
		//get verify response data
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$params = array( "secret"=>$secret, "response"=>$_POST["g-recaptcha-response"] );
		curl_setopt( $ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify" );
		curl_setopt( $ch, CURLOPT_POST, true );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query($params) );
		$result = curl_exec( $ch );
		$response_data = json_decode( $result );


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

			$supplier_data = json_decode(json_encode(array(
				"webmaster" => false,
				"name" => $_POST["nombre"],
				"empresa" => $_POST["empresa"],
				"usr_mail" => $_POST["correo"],
				"phone" => $_POST["telefono"],
				"medio" => $_POST["medio"],
				"msg" => $_POST["mensaje"],
			)), FALSE);


			$mail_data = json_decode(json_encode($mail_data_arr), FALSE);

			if( $phpmailer ) {
				require 'PHPMailerAutoload.php';
				sendMailCustom($supplier_data, null);
				sendMailCustom($mail_data, $supplier_data);
			} else {
				sendMailDefault($supplier_data, null);
				sendMailDefault($mail_data, $supplier_data);
			}

			$errors = 0;
			unset($_SESSION["_errors"]);
		} else { /*error*/
			$_SESSION["_errors"] .= "<li> Ocurrió un error al verificar el reCaptcha, por favor intentalo de nuevo. </li>";
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
			foreach( $_mail as $val )
				$mail->AddCC($val);


			$subject = "Recientemente se pusieron en contacto";
			$initial = utf8_encode( file_get_contents("html_files/admin.php") );
			$initial1 = str_replace("%company%", $company, $initial);
			$initial2 = str_replace("%name%", $_supplier_data->name, $initial1);
			$initial3 = str_replace("%empresa%", $_supplier_data->empresa, $initial2);
			$initial4 = str_replace("%medio%", $_supplier_data->medio, $initial3);
			$initial5 = str_replace("%msg%", $_supplier_data->msg, $initial4);
			$initial6 = str_replace("%usr_mail%", $_supplier_data->usr_mail, $initial5);
			$body_file = str_replace("%phone%", $_supplier_data->phone, $initial6);
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
			$initial3 = str_replace("%empresa%", $_supplier_data->empresa, $initial2);
			$initial4 = str_replace("%medio%", $_supplier_data->medio, $initial3);
			$initial5 = str_replace("%msg%", $_supplier_data->msg, $initial4);
			$initial6 = str_replace("%usr_mail%", $_supplier_data->usr_mail, $initial5);
			$body_file = str_replace("%phone%", $_supplier_data->phone, $initial6);
		} else {
			$to = $_mail->usr_mail;
			$subject = "Recientemente se pusieron en contacto";
			$headers .= "From: Contacto Web - ".$company."<".$webmaster.">\r\n".
			$initial = utf8_encode( file_get_contents("html_files/supplier.php") );
			$body_file = str_replace("%company%", $company, $initial);
		}

		$headers .= "X-Mailer: PHP/".phpversion();

		mail($to, $subject, $body_file, $headers);
	}
?>