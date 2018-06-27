<!DOCTYPE html>
<html lang="es">
<head>
	<?php
		$view_name="Galería";
		include("structure/head.php");
		$asset = "assets/img/home/"; // Path where are storaged media files (img, video, etc)
	?>
	<script src="<?php echo $path; ?>assets/js/gallery.js" defer></script>
</head>
<body class="bg-dots no-backdrop">
	<?php $active="gallery"; include("structure/navbar.php"); ?>

	<section id="gallery-title" class="bg-blue-hard box-shadow-inner pt-45 pb-45 relativer">
		<img class="dots-2" src="http://placehold.it/100x150.png?text=100x150.png" alt="">
		<img class="dots-3" src="http://placehold.it/100x150.png?text=100x150.png" alt="">
		
		<div class="container-custom">
			<img class="title-penguin" src="http://placehold.it/140x180.png?text=140x180.png" alt="">
			<div class="row">
				<div class="col-md-12">
					<h1 class="h1-bigger text-white adam-gorry-font"><strong>GALERÍA</strong></h1>
				</div>
			</div>
		</div>
	</section>

	<section class="container-fluid pt-60 pb-60 mb-0 mb-md-5">
		<div class="row gal-container" data-max="6">
			<div class="col-md-4">
				<img data-deploy="modal" data-id="1" data-text="Lorem ipsum" class="img-fluid d-block m-auto" src="http://placehold.it/900x700.png?text=900x700 1.jpg" alt="">
			</div>
			<div class="col-md-4">
				<img data-deploy="modal" data-id="2" data-text="Lorem ipsum" class="img-fluid d-block m-auto" src="http://placehold.it/900x700.png?text=900x700 2.jpg" alt="">
			</div>
			<div class="col-md-4">
				<img data-deploy="modal" data-id="3" data-text="Lorem ipsum" class="img-fluid d-block m-auto" src="http://placehold.it/900x700.png?text=900x700 3.jpg" alt="">
			</div>
			<div class="col-md-4">
				<img data-deploy="modal" data-id="4" data-text="Lorem ipsum" class="img-fluid d-block m-auto" src="http://placehold.it/900x700.png?text=900x700 4.jpg" alt="">
			</div>
			<div class="col-md-4">
				<img data-deploy="modal" data-id="5" data-text="Lorem ipsum" class="img-fluid d-block m-auto" src="http://placehold.it/900x700.png?text=900x700 5.jpg" alt="">
			</div>
			<div class="col-md-4">
				<img data-deploy="modal" data-id="6" data-text="Lorem ipsum" class="img-fluid d-block m-auto" src="http://placehold.it/900x700.png?text=900x700 6.jpg" alt="">
			</div>
		</div>
	</section>

	<!-- Modal -->
	<div class="modal fade" id="gallery-preview-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
	    <div class="modal-content">
	      <?php /*
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      */ ?>
	      <div class="modal-body">
	      	<img id="gallery-preview" data-current="null" class="img-fluid d-block m-auto" src="" alt="">
	      	<div class="gallery-text">OSAS</div>
	        <div class="gallery-control">
	        	<span data-prev="" data-dir="left" >
		        	<i class="fas fa-angle-left fa-2x"></i>
	        	</span>
	        	<span data-next="" data-dir="right" >
		        	<i class="fas fa-angle-right fa-2x"></i>
	        	</span>
	        </div>
	      </div>
	    </div>
	  </div>
	</div>

	<?php include("widgets/frm-cont.php"); ?>

	<?php include("structure/footer.php"); ?>
	<script src="<?php echo $path; ?>assets/js/gallery-widget.js"></script>
</body>
</html>