<?php
	/*
		If page is only one landing you can add  id="parallax-navbar" to <ul class="navbar-nav mr-auto">
		And if you do, add "data-target"=>"#id-to-scroll" to $items array to can make the js work
		Example: array("active" => "none", "link" => "#", "word" => "Nosotros", "sub" => 0, "data_target" => "#nosotros"),
	*/
	function act($item, $active) { echo $item == $active ? " active" : ""; }
	$items = json_decode(json_encode(array(
		array("active" => "index", "link" => "index", "word" => "Home", ["submenu"=>false, "menu" => []]),
		array("active" => "slugger", "link" => "slugger", "word" => "Slugger", ["submenu"=>false, "menu" => []]),
		array("active" => "blog", "link" => "blog", "word" => "Blog", ["submenu"=>false, "menu" => []]),
		array("active" => "link", "link" => "scroll-magic", "word" => "Scroll Magic", ["submenu"=>false, "menu" => []]),
		array("active" => "disabled", "link" => "#", "word" => "Disabled", ["submenu"=>false, "menu" => []]),
		array("active" => "contacto", "link" => "contacto", "word" => "Contacto", ["submenu"=>false, "menu" => []]),
	)), FALSE);
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<div class="container nb-container m-auto">
		<a class="navbar-brand" href="<?php echo $path; ?>">
			<!-- <img src="holder.js/200x50.svg?random=yes&text=200x50 SVG" alt="Brand" class="img-fluid"> -->
			<img src="<?php Times::fileTime("http://placehold.it/200x50.svg?text=200x50.svg") ?>" alt="logo" class="img-fluid nb-logo">
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto">
				<?php foreach($items as $item) { ?>
					<li class='nav-item<?php act($item->active, $active); if( $item->submenu ) echo " dropdown text-center"; ?>'>
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
					</form>
	      </li>

	      <li class="nav-item dropdown text-center">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            ES
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">EN</a>
          </ul>
        </li>
			</ul>
		</div>
	</div>
</nav>
