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
<body>

	<?php if( Auth::check() ) { ?>
		<?php include("structure/navbar.php"); ?>
	<?php } ?>

	<div id="layoutAuthentication">
		<div id="layoutAuthentication_content">
			<main>
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-5">
							<div class="card card-login shadow-lg border-0 rounded-lg mt-5">
								<div class="card-header">
									<a href="<?php echo $env->APP_URL; ?>">
										<img src="http://placehold.it/200x50.svg?text=BrandLogo" alt="logo" class="img-fluid svg d-block m-auto">
									</a>
								</div>
								<div class="card-body">
									<?php include("../alerts/success.php"); ?>
									<?php include("../alerts/errors.php"); ?>
									<form id="form-validation" action="<?php echo $env->APP_URL ?>php/db/requests.php" method="POST" autocomplete="off">
										<input type="hidden" name="request" value="login">
										<div class="form-group form-floating mb-3">
											<input type="text" class="form-control" name="username" placeholder="Usuario">
											<label for="username">Usuario</label>
										</div>
										<div class="form-group form-floating mb-3">
											<input type="password" class="form-control" name="password" placeholder="Contraseña">
											<label for="password">Contraseña</label>
										</div>

										<div class="d-grid">
											<button type="submit" class="btn btn-orange">Entrar</button>
										</div>
									</form>
								</div>
								<div class="card-footer text-center py-3">
									<p class="m-0 text-center small">
										<a class="btn btn-link" href="<?php echo $env->APP_URL; ?>admin/recuperar-contrasena">
											¿Olvidaste tu contraseña?
										</a>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</main>
		</div>
		<div id="layoutAuthentication_footer">
			<footer class="py-4 bg-light mt-auto">
				<?php include("structure/footer.php"); ?>
			</footer>
		</div>
	</div>

	<?php include("structure/footer-scripts.php"); ?>

	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fa fa-angle-up"></i>
	</a>

	<?php include("widgets/modal.php"); ?>

	<script>
		$(function(){
			$("#form-validation").formValidation({
				locale: 'es_ES',
				fields: {
					username: {
						validators: {
							notEmpty: {},
							stringLength: {
								min: 6,
								max: 255
							}
						}
					},
					password: {
						validators: {
							notEmpty: {},
							stringLength: {
								min: 6,
								max: 255
							}
						}
					}
				}
			});
		});
	</script>
</body>
</html>
<?php
	} else Redirect::to("index");
?>
