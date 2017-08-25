<!DOCTYPE html>
<html lang="es">
<head>
	<?
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
	<? $view_name="title"; include($dir."structure/head.php") ?>
</head>
<body>
	<? $active="index"; include($dir."structure/navbar.php") ?>

	<section class="background-default-02 pt60 pb60">
		<div class="container-custom">
			<div class="row">
				<div class="col-sm-12">CONTENT</div>
			</div>
		</div>
	</section>

	<? include($dir."structure/footer.php") ?>
</body>
</html>