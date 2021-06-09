<?php
	include("../php/admin.head.php");

	if( !Auth::check() && Tokens::validateToken($_GET["token"]) ) {
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php
		$title="Recuperar Contraseña";
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
									<form id="needs-validation" action="<?php echo $env->APP_URL ?>php/db/requests.php" method="POST" autocomplete="off" novalidate>
										<input type="hidden" name="request" value="reset-password">
										<div class="form-group form-floating mb-3">
											<input type="password" class="form-control fc-admin" name="password" required="" placeholder="************">
											<label class="login-label" for="password">Nueva contraseña</label>
										</div>
										<div class="form-group form-floating mb-3">
											<input type="password" class="form-control fc-admin" name="password_confirm" required="" placeholder="************">
											<label class="login-label" for="password_confirm">Confirmar contraseña</label>
										</div>

										<div class="d-grid">
											<button class="btn btn-orange btn-block" type="submit">Reestablecer Contraseña</button>
										</div>
									</form>
								</div>
								<div class="card-footer text-center py-3">
									<p class="m-0 text-center small">
										<a href="<?php echo $env->APP_URL; ?>admin/login">
											<i class="fa fa-arrow-left"></i> Volver
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
			$("#needs-validation") .formValidation({
					locale: 'es_ES',
					fields: {
	            password: {
	                validators: {
	                    notEmpty: {},
	                    stringLength: {
	                    	min: 6,
	                    	max: 16
	                    },
                        identical_password: {
                            field: 'password_confirm'
                        }
	                }
	            },
              password_confirm: {
                  validators: {
                    notEmpty: {},
                      stringLength: {
                          min: 6,
                          max: 16
                      },
                      identical_password: {
                          field: 'password'
                      }
                  }
              },
					}
				});
		});
	</script>
</body>
</html>
<?php
	} else Redirect::to("index");
?>
