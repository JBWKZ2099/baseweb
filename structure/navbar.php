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

<nav class="navbar navbar-expand-md navbar-light bg-light">
	<div class="container nb-container m-auto">
		<a class="navbar-brand" href="<?php echo $path; ?>">
			<!-- <img src="holder.js/200x50.svg?random=yes&text=200x50 SVG" alt="Brand" class="img-fluid"> -->
			<img src="#" alt="Brand" class="img-fluid">
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<?php foreach($items as $item) { ?>
					<li class='nav-item<?php act($item->active, $active); ?>'>
						<a class='nav-link text-center' href='<?php echo $path.$item->link; ?>' <?php if( isset($item->data_target) && !empty($item->data_target) ) echo "data-target='".$item->data_target."'"; ?>><?php echo $item->word ?></a>
					</li>
				<?php } ?>
			</ul>
			<form class="form-inline my-2 my-lg-0">
				<input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
				<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
			</form>
		</div>
	</div>
</nav>
