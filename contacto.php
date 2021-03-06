<!DOCTYPE html>
<html lang="es">
<head>
	<?php
		/*
		* Cambiar los valores de $up_dir dependiendo de en que nivel se encuentre
		* la vista que se agregó, por ejemplo:
		*	proyecto/
		*	├── assets/
		*	├── structure/
		* ├── otra_carpeta/
		* │   └── Subcarpeta/
		* │   		├── archivo01.php -> En este caso $up_dir debe ser igual a 2
		* │   		└── archivo02.php
		*	└── carpeta_donde_hay_vistas/
		*	    ├── archivo01.php -> En este caso $up_dir debe ser igual a 1
		*	    ├── archivo02.php
		*	    ├── archivo03.php
		*	    ├── archivo04.php
		*	    └── archivo05.php
		*/
		$up_dir = 0; for( $i01=1; $i01<=$up_dir; $i01++ ) { $dir.="../"; }
	?>
	<?php
		$view_name="Contact";
		include(/*$dir.*/"structure/head.php");
		$asset = "assets/img/folder_name/"; // Path where are storaged media files (img, video, etc)
	?>

	<?php if( $_SESSION["recaptcha"]=="v2" ) { ?>
		<!-- Google reCaptcha -->
		<script src="https://www.google.com/recaptcha/api.js?onload=renderCaptcha&render=explicit" async="async" defer="defer"></script>
		<script>
			var recaptcha;
			var renderCaptcha = function() {
				recaptcha = grecaptcha.render('g-recaptcha', {
					'sitekey': '6LeQ02YUAAAAAKBAujSmwV4MvJ04ea6Lo2qvvlt2',
					'theme': 'light'
				});
			};
		</script>
		<!-- Google reCaptcha -->
	<?php } ?>
</head>
<body>
	<?php $active="contact"; include(/*$dir.*/"structure/navbar.php"); ?>
	<?php /*ALERTAS DE ERROR O ÉXITO*/ ?>
	<?php if(session_status()==="") session_start(); include("alerts/alerts.php"); ?>

	<section class="bg-default-02 pt-60 pb-60">
		<div class="container-custom">
			<div class="row">
				<div class="col-md-12">
					<?php include("widgets/frm-cont.php"); ?>
				</div>
			</div>
		</div>
	</section>

	<?php include(/*$dir.*/"structure/footer.php"); ?>
</body>
</html>
