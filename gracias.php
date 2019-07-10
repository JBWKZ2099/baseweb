<?php
	if(session_status()==="") session_start();
	if( !isset($_SESSION['_success']) ) {
		// echo "<script> window.location.href = 'contacto.php' </script>";
		header("Location: index");
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php $view_name="Gracias"; include("structure/head.php") ?>
</head>
<body>
	<?php $active="contact"; include("structure/navbar.php") ?>

	<section class="container-custom thanks-page">
		<div class="row h-100 align-items-center">
			<div class="col-md-12 text-center">
				<div class="row mb-3">
					<div class="col-md-12">
						<?php /*<img src="<?php echo $path.$asset_root; ?>logo-03.svg" alt="LogoSVG" class="img-fluid d-block m-auto">*/ ?>
						<img src="http://placehold.it/300x80.svg" alt="LogoSVG" class="img-fluid d-block m-auto">
					</div>
				</div>
				<h1 class="mb-3"><?php echo $_SESSION["thanks_message"]; ?></h1>

				<div class="row justify-content-center">
					<div class="col-md-3">
						<a href="<?php echo $path; ?>" class="btn btn-success btn-block btn-noradius">Volver</a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php include("structure/footer.php") ?>
	<?php
		unset($_SESSION["_success"]);
		unset($_SESSION["_errors"]);
		// echo $_SESSION["_success"];
	?>
</body>
</html>
