<!DOCTYPE html>
<html lang="es">
<head>
	<?php
		$view_name="Inicio";
		include(/*$dir.*/"structure/head.php");
		$asset = "assets/img/home/"; // Path where are storaged media files (img, video, etc)

		// if(session_status()==="") session_start();
		// logout();
		// unset( $_SESSION );
		// $pswd_ed = "asdasd";
		// echo $pswd_encrypted = Auth::cryptBlowfish("asdasd");
		// exit();
	?>
</head>
<body>
	<?php $active="index"; include(/*$dir.*/"structure/navbar.php"); ?>
	<section class="container-fluid zi-2 mb-3 mb-md-0">
		<div class="row">
			<div class="col-md-12 px-0">
				<div id="home-carousel" class="carousel slide full-carousel" data-ride="carousel" data-interval="0">
				  <div class="carousel-inner">
				    <div class="carousel-item active" style="background-image: url('<?php Times::fileTime("assets/img/home/banner.jpg") ?>')">
							<?php /* <img class="img-fluid d-block m-auto banner-logo" src="<?php Times::fileTime("http://placehold.it/400x250.png/fff/000/?text=400x250.png") ?>" alt="banner_logo_onest"> */ ?>
				    </div>
				  </div>
				</div>
			</div>
		</div>
	</section>


	<section class="container-custom zi-2">
		<div class="row align-items-center">
			<div class="col-md-5 appear-left">
				<h1 class="h1-bigger text-blue-hard text-center d-block d-md-none"> <strong> HAZ CRECER TU NEGOCIO</strong> </h1>
				<p class="h1-bigger text-left text-blue-hard d-none d-md-block"><strong>HAZ CRECER</strong></p>
			</div>
			<div class="col-2"></div>
			<div class="col-md-5 text-right appear-right">
				<p class="h1-bigger text-blue-hard d-none d-md-block"><strong>TU NEGOCIO</strong></p>
			</div>
		</div>
	</section>

	<div class="subsec-separator"></div>

	<section class="container-custom zi-2">
		<div class="row align-items-center">
			<div class="col-md-5 appear-left mb-3 mb-md-0">
				<h2 class="h1-bigger text-center text-md-left text-blue-hard appear-left"><strong>¡CONÓCENOS!</strong></h2>
			</div>
			<div class="col-2"></div>
			<div class="col-md-5 text-justify text-md-right appear-right">
				<p class="">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</p>
			</div>
		</div>
	</section>

	<section class="container-custom zi-5">
		<div class="row">
			<div class="col-md-5 mt-3 mt-md-4">
				<div class="row">
					<div class="col-md-12">
						<h3 class="h1 text-center text-blue-hard zi-2 appear-left"><strong>DISTRIBUCIÓN</strong></h3>
						<div class="appear-bottom home-img-margin home-img-margin">
							<img class="img-fluid d-block m-auto" src="<?php Times::fileTime($asset."distribucion_2.jpg"); ?>" alt="distribucion">
						</div>

						<div class="appear-top p-relative zi-3">
							<a class="btn btn-animated btn-blue-transp btn-circle btn-br fa-spin-custom" href="#"><span class="btn-text">
								<img class="btn-ico svg" src="<?php Times::fileTime($asset."icono-distribucion.svg"); ?>" alt="distribucion_ver_mas">
								<p class="pt-2">VER MÁS...</p>
							</span></a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-2"></div>

			<div class="col-md-5 text-right">
				<div class="subsec-separator"></div>
				<h3 class="h1 text-center text-blue-hard zi-2 appear-right"><strong>ALMACENAJE</strong></h3>
				<div class="appear-bottom home-img-margin">
					<img class="img-fluid d-block m-auto" src="<?php Times::fileTime($asset."almacenaje_2.jpg"); ?>" alt="almacenaje">
				</div>

				<div class="appear-top p-relative zi-3">
					<a class="btn btn-animated btn-blue-transp btn-circle btn-bl fa-spin-custom" href="#"><span class="btn-text">
						<img class="btn-ico svg" src="<?php Times::fileTime($asset."icono-almacenaje.svg"); ?>" alt="almacenaje_ver_mas">
						<p class="pt-2">VER MÁS...</p>
					</span></a>
				</div>
			</div>
		</div>
	</section>

	<section class="container-custom zi-4">
		<div class="row">
			<div class="col-md-5 mt-3 mt-md-4">
				<div class="row">
					<div class="col-md-12">
						<h3 class="h1 text-center text-blue-hard zi-2 appear-left"><strong>ECOMMERCE</strong></h3>
						<div class="appear-bottom home-img-margin">
							<img class="img-fluid d-block m-auto" src="<?php Times::fileTime($asset."ecommerce_2.jpg"); ?>" alt="ecommerce">
						</div>

						<div class="appear-top p-relative zi-3">
							<a class="btn btn-animated btn-blue-transp btn-circle btn-br fa-spin-custom" href="#"><span class="btn-text">
								<img class="btn-ico svg" src="<?php Times::fileTime($asset."icono-ecomm.svg"); ?>" alt="ecommerce_ver_mas">
								<p class="pt-2">VER MÁS...</p>
							</span></a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-2"></div>

			<div class="col-md-5 text-right">
				<div class="subsec-separator"></div>
				<h3 class="h1 text-center text-blue-hard zi-2 appear-right"><strong>ALMACENAJE FISCAL</strong></h3>
				<div class="appear-bottom home-img-margin">
					<img class="img-fluid d-block m-auto" src="<?php Times::fileTime($asset."almacenaje_fiscal.jpg"); ?>" alt="almacenaje_fiscal">
				</div>

				<div class="appear-top p-relative zi-3">
					<a class="btn btn-animated btn-blue-transp btn-circle btn-bl fa-spin-custom" href="#"><span class="btn-text">
						<img class="btn-ico svg" src="<?php Times::fileTime($asset."icono-almfiscal.svg"); ?>" alt="almacenaje_fiscal_ver_mas">
						<p class="pt-2">VER MÁS...</p>
					</span></a>
				</div>
			</div>
		</div>
	</section>

	<section class="container-custom zi-3">
		<div class="row">
			<div class="col-md-5 mt-3 mt-md-4">
				<div class="row">
					<div class="col-md-12">
						<h3 class="h1 text-center text-blue-hard zi-2 appear-left"><strong>OPERACIÓN IN HOUSE</strong></h3>
						<div class="appear-bottom home-img-margin">
							<img class="img-fluid d-block m-auto" src="<?php Times::fileTime($asset."operacion_inhouse_2.jpg"); ?>" alt="operacion_in_house">
						</div>

						<div class="appear-top p-relative zi-3">
							<a class="btn btn-animated btn-blue-transp btn-circle btn-br fa-spin-custom" href="#"><span class="btn-text">
								<img class="btn-ico svg" src="<?php Times::fileTime($asset."icono-operacioninhouse.svg"); ?>" alt="operacion_in_house_ver_mas">
								<p class="pt-2">VER MÁS...</p>
							</span></a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-2"></div>

			<div class="col-md-5 text-right">
				<div class="subsec-separator"></div>
				<h3 class="h1 text-center text-blue-hard zi-2 appear-right"><strong>MAQUILAS</strong></h3>
				<div class="appear-bottom home-img-margin">
					<img class="img-fluid d-block m-auto" src="<?php Times::fileTime($asset."maquila_2.jpg"); ?>" alt="maquilas">
				</div>

				<div class="appear-top p-relative zi-3">
					<a class="btn btn-animated btn-blue-transp btn-circle btn-bl fa-spin-custom" href="#"><span class="btn-text">
						<img class="btn-ico svg" src="<?php Times::fileTime($asset."icono-maquilas.svg"); ?>" alt="maquilas_ver_mas">
						<p class="pt-2">VER MÁS...</p>
					</span></a>
				</div>
			</div>
		</div>
	</section>

	<section class="container-fluid zi-2 container-separator"></section>

	<section class="container-fluid bg-blue-hard zi-2">
		<div class="row">
			<div class="container-custom pt-60 pb-60 numbers-section false">
				<div class="row">
					<div class="col-md-12 text-center mb-3 mb-md-5">
						<h2 class="text-white h1"><strong>NÚMEROS QUE TRABAJAN PARA TI</strong></h2>
					</div>

					<div class="col-6 col-md-3 text-center px-3 px-md-5 mb-3 mb-md-0">
						<img class="img-fluid d-block m-auto" src="<?php Times::fileTime($asset."numeros1.png"); ?>" alt="numeros1.png">
						<h3 class="h1 text-white"><strong class="animated-number">1004</strong></h3>
						<img class="img-fluid d-block m-auto" src="<?php Times::fileTime($asset."numeros2.png"); ?>" alt="numeros2.png">
					</div>

					<div class="col-6 col-md-3 text-center px-3 px-md-5 mb-3 mb-md-0">
						<img class="img-fluid d-block m-auto" src="<?php Times::fileTime($asset."numeros1.png"); ?>" alt="numeros1.png">
						<h3 class="h1 text-white"><strong class="animated-number">1004</strong></h3>
						<img class="img-fluid d-block m-auto" src="<?php Times::fileTime($asset."numeros2.png"); ?>" alt="numeros2.png">
					</div>

					<div class="col-6 col-md-3 text-center px-3 px-md-5 mb-3 mb-md-0">
						<img class="img-fluid d-block m-auto" src="<?php Times::fileTime($asset."numeros1.png"); ?>" alt="numeros1.png">
						<h3 class="h1 text-white"><strong class="animated-number">1004</strong></h3>
						<img class="img-fluid d-block m-auto" src="<?php Times::fileTime($asset."numeros2.png"); ?>" alt="numeros2.png">
					</div>

					<div class="col-6 col-md-3 text-center px-3 px-md-5 mb-3 mb-md-0">
						<img class="img-fluid d-block m-auto" src="<?php Times::fileTime($asset."numeros1.png"); ?>" alt="numeros1.png">
						<h3 class="h1 text-white"><strong class="animated-number">1004</strong></h3>
						<img class="img-fluid d-block m-auto" src="<?php Times::fileTime($asset."numeros2.png"); ?>" alt="numeros2.png">
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="container-custom zi-2 pt-60 pb-60 bg-white">
		<div class="row mb-3 mb-md-5">
			<div class="col-md-12 text-center mb-3 mb-md-4">
				<h2 class="h1-bigger text-blue-hard"><strong>NUESTROS SECTORES</strong></h2>
			</div>

			<div class="col-md-12">
				<div id="footer-carousel" class="carousel slide circle-indicators blue-indicators" data-ride="carousel">
				  <ol class="carousel-indicators">
				    <li data-target="#footer-carousel" data-slide-to="0" class="active">
				    	<div class="inner-circle"></div>
				    </li>
				  </ol>
				  <div class="carousel-inner">
				    <div class="carousel-item active">
				      <div class="row align-items-center">
				      	<div class="col-md-8 pr-0">
									<img class="img-fluid d-block m-auto" src="<?php Times::fileTime($asset."nuestros_sectores_fashion.jpg") ?>" alt="sector_fashion">
									<h3 class="sr-only">Fashion</h3>
				      	</div>
								<div class="col-md-4 text-justify">
									<div class="row">
										<div class="col-md-11 text-md-right border-r border-b border-t border-blue-hard py-3">
											<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
										</div>
									</div>
								</div>
				      </div>
				    </div>
				  </div>
				</div>
			</div>
		</div>

		<div class="row align-items-center">
			<div class="col-md-12 text-center mb-3 mb-md-5">
				<h2 class="h1 text-blue-hard"><strong>Y TÚ, ¿HASTA DONDE QUIERES LLEGAR?</strong></h2>
			</div>

			<div class="col-md-6 mb-3 mb-md-0">
				<img class="img-fluid d-block m-auto" src="<?php Times::fileTime($asset."contactanos.png"); ?>" alt="formulario_de_contacto">
			</div>
			<div class="col-md-6 text-center">
				<h3 class="h1 text-blue-hard mb-3"><strong>¡CONTÁCTANOS!</strong></h3>
				<p class="mb-3 mb-md-4">Lorem ipsum color sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>

				<?php include("widgets/frm-cont.php"); ?>
			</div>
		</div>
	</section>


	<div class="rail-container">
		<div class="rail"></div>
		<div class="rail-dot rd1"></div>
		<div class="rail-dot rd2"></div>
		<div class="rail-dot rd3"></div>
		<div class="rail-dot rd4"></div>
		<div class="rail-dot rd5"></div>
		<div class="rail-dot rd6"></div>
		<div class="rail-dot rd7"></div>
		<div class="rail-dot rd8"></div>
		<div class="rail-dot rd9"></div>
		<div class="rail-dot rd10"></div>
		<div class="rail-dot rd11"></div>
		<div class="rail-dot rd12"></div>
		<div class="rail-dot rd13"></div>
		<div class="rail-dot rd14"></div>
		<div class="rail-dot rd15"></div>
		<div class="rail-dot rd16"></div>
		<div class="rail-dot rd17"></div>
		<div class="rail-dot rd18"></div>
		<div class="rail-dot rd19"></div>
		<div class="rail-dot rd20"></div>
		<div class="rail-dot rd21"></div>
		<div class="rail-dot rd22"></div>
		<div class="rail-dot rd23"></div>
		<div class="rail-dot rd24"></div>
		<div class="rail-dot rd25"></div>
		<div class="rail-dot rd26"></div>
		<div class="rail-dot rd27"></div>
		<div class="rail-dot rd28"></div>
		<div class="rail-dot rd29"></div>
		<div class="rail-dot rd30"></div>
		<div class="rail-dot rd31"></div>
		<div class="rail-dot rd32"></div>
		<div class="rail-dot rd33"></div>
		<div class="rail-dot rd34"></div>
		<div class="rail-dot rd35"></div>
		<div class="rail-dot rd36"></div>
		<div class="rail-dot rd37"></div>
		<div class="rail-dot rd38"></div>
		<div class="rail-dot rd39"></div>
		<div class="rail-dot rd40"></div>
	</div>
	<img class="img-fluid parallax-rack static d-none d-md-block" src="<?php Times::fileTime($asset."rack.png"); ?>" alt="ONEST_rack">

	<?php include(/*$dir.*/"structure/footer.php"); ?>
	<script type="text/javascript">
		$(".rail-container").css("height", "--rc-height: "+$("body").height()+"px");
		console.log($("body").height())
	</script>
</body>
</html>
