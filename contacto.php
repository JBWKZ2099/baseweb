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
</head>
<body>
	<?php $active="contact"; include(/*$dir.*/"structure/navbar.php") ?>

	<section class="bg-default-02 pt-60 pb-60">
		<div class="container-custom">
			<div class="row">
				<div class="col-md-12">
					<form action="<?php echo $path; ?>php/mailer/mail.php" method="POST">
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
						<button type="submit" class="btn btn-secondary">Enviar</button>
					</form>
				</div>
			</div>
		</div>
	</section>

	<?php /*ALERTAS DE ERROR O ÉXITO*/ ?>
	<?php session_start(); include("alerts/alerts.php"); ?>

	<?php include(/*$dir.*/"structure/footer.php") ?>
</body>
</html>