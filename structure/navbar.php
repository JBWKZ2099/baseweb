<?php
	/*
		If page is only one landing you can add  id="parallax-navbar" to <ul class="navbar-nav mr-auto">
		And if you do, add "data-target"=>"#id-to-scroll" to $items array to can make the js work
		Example: array("active" => "none", "link" => "#", "word" => "Nosotros", "sub" => 0, "data_target" => "#nosotros"),
	*/
	function act($item, $active) { echo $item == $active ? " active" : ""; }
	$items = json_decode(json_encode(array(
		array("active" => "index", "link" => "index", "word" => "Inicio", "submenu"=>false, "menu" => array()),
		array("active" => "about", "link" => "about-us", "word" => "About Us", "sub" => 0, "submenu"=>true,
			"menu" => array(
				array(
					"active" => "about-view",
					"link" => "acerca-de-nosotros",
					"word" => "Acerca de nosotros",
				),
				array(
					"active" => "our-sectors",
					"link" => "nuestros-sectores",
					"word" => "Nuestros Sectores",
				),
			)
		),
		array("active" => "services", "link" => "servicios", "word" => "Servicios", "submenu"=>true,
			"menu" => array(
				array(
					"active" => "distribution",
					"link" => "distribucion",
					"word" => "Distribución",
				),
				array(
					"active" => "storage",
					"link" => "almacenaje",
					"word" => "Almacenaje",
				),
				array(
					"active" => "logistics",
					"link" => "logistica",
					"word" => "Logística",
				),
				array(
					"active" => "maquila",
					"link" => "maquila-y-nom",
					"word" => "Maquila y nom",
				),
				array(
					"active" => "fiscal",
					"link" => "fiscal",
					"word" => "Fiscal",
				),
				array(
					"active" => "crosswalk",
					"link" => "cruce-de-anden",
					"word" => "Cruce de anden",
				),
				array(
					"active" => "reverse-logistic",
					"link" => "logistica-inversa",
					"word" => "Logística inversa",
				),
			)
		),
		array("active" => "meetus", "link" => "conocenos", "word" => "Conócenos", "submenu"=>false, "menu" => array()),
	)), FALSE);
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top py-0">
	<div class="container nb-container m-auto">
		<a class="navbar-brand" href="<?php echo $path; ?>">
			<!-- <img src="holder.js/200x50.svg?random=yes&text=200x50 SVG" alt="Brand" class="img-fluid"> -->
			<?php /* <img src="<?php Times::fileTime("assets/img/logo_onest.svg") ?>" alt="logo_onest" class="img-fluid"> */ ?>
			<img src="<?php Times::fileTime("http://placehold.it/150x60.svg?text=150x60.svg") ?>" alt="logo_onest" class="img-fluid">
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto">
				<?php foreach($items as $item) { ?>
					<li class='nav-item<?php act($item->active, $active); if( $item->submenu ) echo " dropdown text-center"; ?> right-separator'>
						<?php if( !$item->submenu ) { ?>
							<a class='nav-link text-center' href='<?php echo $path.$item->link; ?>' <?php if( isset($item->data_target) && !empty($item->data_target) ) echo "data-target='".$item->data_target."'"; ?>><?php echo $item->word ?></a>
						<?php } else { ?>
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<?php echo $item->word ?>
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<?php foreach($item->menu as $imnu) { ?>
									<a class="dropdown-item text-center" href="#"><?php echo $imnu->word; ?></a>
								<?php } ?>
							</div>
						<?php } ?>
					</li>
				<?php } ?>

				<li class="nav-item">
					<form class="form-inline my-2 my-lg-0 ml-auto p-relative">
						<input class="form-control mr-sm-2 nb-input w-100" type="text" placeholder="Buscar" aria-label="Buscar">
						<i class="fa fa-search fa-fw text-blue-hard nb-search"></i>
					</form>
	      </li>

				<li class="nav-item dropdown text-center">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						ES
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="#">EN</a>
					</div>
				</li>
			</ul>
		</div>
	</div>
</nav>
