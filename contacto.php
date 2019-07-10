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
					<?php include("alerts/alerts.php"); ?>
					<form id="contact-form" action="<?php echo $path; ?>php/mailer/mailer.php" method="POST">
						<div class="form-group">
							<input type="text" class="form-control" name="name" value="" placeholder="Nombre:" required>
						</div>
						<div class="form-group">
							<input type="email" class="form-control" name="email" value="" placeholder="E-Mail:" required>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="subject" value="" placeholder="Asunto:" required>
						</div>
						<div class="form-group">
							<textarea class="form-control" name="msg" rows="5" placeholder="Mensaje:"></textarea>
						</div>
						<?php if( $_SESSION["recaptcha"]=="v2" ) { ?>
							<div class="form-group">
								<div id="g-recaptcha"></div>
							</div>
						<?php } ?>
						<button type="submit" class="btn btn-secondary">Enviar</button>
					</form>
					<?php if( $_SESSION["recaptcha"]=="v3" ) { ?>
						<script>
						  $('form#contact-form').submit(function(event) {
						    // we stoped it
						    event.preventDefault();
						    // needs for recaptacha ready
						    grecaptcha.ready(function() {
						      // do request for recaptcha token
						      // response is promise with passed token
						      grecaptcha.execute('<?php echo $env->GRECAPTCHA_PUBLIC; ?>', {action: 'get_in_touch'}).then(function(token) {
						          // add token to form
						          $('form#contact-form').prepend('<input type="hidden" name="g-recaptcha-response" value="' + token + '">');
						          $('form#contact-form').prepend('<input type="hidden" name="action" value="get_in_touch">');
						          // return false;
						          // submit form now
						          $('form#contact-form').unbind('submit').submit();
						      });
						    });
						  });
						</script>
					<?php } ?>
				</div>
			</div>
		</div>
	</section>

	<?php include(/*$dir.*/"structure/footer.php"); ?>
</body>
</html>
