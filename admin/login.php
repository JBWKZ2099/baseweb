<?php
	include("../php/admin.head.php");

	if( !Auth::check() ) {
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php
		$title="Login";
		$copy_year = date("Y",strtotime("today"));
		include("structure/head.php");
	?>
</head>
<body class="bg-dark" id="page-top">

	<?php if( Auth::check() ) { ?>
		<?php include("structure/navbar.php"); ?>
	<?php } ?>


	<div class="container-fluid bg-white">
		<div class="row">
			<div class="jumbotron-container col-md-12">
				<div class="row h-100 align-items-center justify-content-center">
				  <div class="jumbotron col-md-4">
				    <div class="card card-login">
							<div class="card-header fill-white">
								<a href="/">
									<img src="http://placehold.it/200x50.svg?text=BrandLogo" alt="RDMLogo" class="img-fluid svg d-block m-auto">
								</a>
							</div>
							<div class="card-body">
								<?php include("../alerts/errors.php"); ?>
								<form id="needs-validation" action="<?php echo $env->APP_URL ?>php/db/requests.php" method="POST" autocomplete="off" novalidate>
									<input type="hidden" name="request" value="login">
									<div class="form-group">
										<label for="username">Usuario</label>
										<input type="text" class="form-control" name="username" placeholder="Usuario" required="">
										<div class="invalid-feedback">
							        El campo 'usuario' no debe de estar vacío.
							      </div>
									</div>
									<div class="form-group">
										<label for="password">Contraseña</label>
										<input type="password" class="form-control" name="password" placeholder="Contraseña" required="">
										<div class="invalid-feedback">
							        El campo 'contraseña' no debe de estar vacío.
							      </div>
									</div>

									<button class="btn btn-orange btn-block">Entrar</button>
								</form>
							</div>
						</div>
				  </div>
				 </div>
			</div>
		</div>
	</div>

	<?php include("structure/footer.php"); ?>

	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fa fa-angle-up"></i>
	</a>

	<?php include("widgets/modal.php"); ?>
	<script src="assets/js/plugins/novalidate.js"></script>
</body>
</html>
<?php
	} else Redirect::to("index");
?>
