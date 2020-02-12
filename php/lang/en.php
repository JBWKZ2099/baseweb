<?php
  // contacto
  $contact = json_decode(json_encode(array(
  	"submit" => "Send",
  	"page_title" => "Contact Us",
  	"title" => "Contact Us",
  	"text" => "Para nosotros tú eres lo más importante.",
  	"button" => "Contactar",
  	"form" => [
  		"name" => "NAME",
  		"section" => [
  			"placeholder" => "SECTION",
  			"s1" => "CUSTOMER SERVICE",
  			"s2" => "HUMAN RESOURCES",
  			"s3" => "SALES",
  			"s4" => "PROVIDERS",
  			"s5" => "OTHERS",
  		],
  		"company" => "COMPANY NAME",
  		"companyline" => [
  			"placeholder" => "BUSSINES TYPE",
  				"s1" => "FASHION",
  				"s2" => "CONSUMPTION",
  				"s3" => "EDITORIAL",
  				"s4" => "E-COMMERCE",
  				"s5" => "BEAUTY",
  				"s6" => "INDUSTRIAL",
  				"s7" => "AUTOMOTIVE INDUSTRY",
  				"s8" => "OTHER",
  		],
  		"type_employee" => [
  			"placeholder" => "EMPLOYEE TYPE",
  			"file_extension" => "Supported files: .pdf, .doc y .docx.",
  			"s0" => "PLEASE ATTACH YOUR CV",
  			"s1" => "EMPLOYEE",
  			"s2" => "CANDIDATE",
  			"s3" => "OTHER",
  		],
  		"provider_type" => [
  			"placeholder" => "PRODUCT OR SERVICE",
  			"s1" => "PRODUCT",
  			"s2" => "SERVICE",
  		],
  		"idemployee" => "# DE EMPEADO",
  		"area" => [
  			"placeholder" => "AREA",
  			"s1" => "OPTION1",
  			"s2" => "OPTION2",
  			"s3" => "OPTION3",
  		],
  		"country" => "COUNTRY",
  		"city" => "CITY",
  		"email" => "E-MAIL",
  		"phone" => "PHOME NUMBER",
  		"message" => "MESSAGE...",
  	],
  ) ), FALSE);
?>
