<?php
  // contacto
  $contact = json_decode(json_encode(array(
  	"submit" => "Enviar",
  	"page_title" => "Contacto",
  	"title" => "Contacto",
  	"text" => "Para nosotros tú eres lo más importante.",
  	"button" => "Contactar",
  	"form" => [
  		"name" => "NOMBRE COMPLETO",
  		"section" => [
  			"placeholder" => "SECCIÓN",
  			"s1" => "ATENCIÓN A CLIENTES",
  			"s2" => "RECURSOS HUMANOS",
  			"s3" => "VENTAS",
  			"s4" => "PROVEEDORES",
  			"s5" => "OTROS",
  		],
  		"company" => "EMPRESA",
  		"companyline" => [
  			"placeholder" => "GIRO",
  				"s1" => "FASHION",
  				"s2" => "CONSUMO",
  				"s3" => "EDITORIAL",
  				"s4" => "E-COMMERCE",
  				"s5" => "BELLEZA",
  				"s6" => "INDUSTRIAL",
  				"s7" => "AUTOMOTRÍZ",
  				"s8" => "OTRO",
  		],
  		"type_employee" => [
  			"placeholder" => "TIPO DE EMPLEADO",
  			"file_extension" => "Archivos admitidos: .pdf, .doc y .docx.",
  			"s0" => "POR FAVOR ANEXA TU CV",
  			"s1" => "EMPLEADO",
  			"s2" => "CANDIDATO",
  			"s3" => "OTRO",
  		],
  		"provider_type" => [
  			"placeholder" => "PRODUCTO O SERVICIO",
  			"s1" => "PRODUCTO",
  			"s2" => "SERVICIO",
  		],
  		"idemployee" => "# DE EMPEADO",
  		"area" => [
  			"placeholder" => "ÁREA",
  			"s1" => "OPTION1",
  			"s2" => "OPTION2",
  			"s3" => "OPTION3",
  		],
  		"country" => "PAÍS",
  		"city" => "CIUDAD",
  		"email" => "CORREO",
  		"phone" => "TELÉFONO",
  		"message" => "MENSAJE...",
  	],
  ) ), FALSE);
?>
