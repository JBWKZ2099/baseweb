<!DOCTYPE html>
<html lang="es">
<head>
	<?php
		$view_name="title";
		include("structure/head.php");
		$asset = "assets/img/test/"; // Path where are storaged media files (img, video, etc)

		include("php/slug.lib.php");
	?>
</head>
<body>
	<?php $active="slugger"; include("structure/navbar.php") ?>
	
	<?php if(isFile()[0] == "no") { ?>
		<section class="bg-default-02 pt-60 pb-60">
			<div class="container-custom">
				<div class="row">
					<div class="col-md-12">
						CONTENT <br>
						<a href="<?php echo $path.isFile()[1]."/".slugger("nombre link"); ?>">Link Test 1</a> <br>
						<a href="<?php echo $path.isFile()[1]."/".slugger("otro link"); ?>" title="">Link Test 2</a>
					</div>
				</div>
			</div>
		</section>
	<?php } else { ?>
		<section class="bg-default-02 pt-60 pb-60">
			<div class="container-custom">
				<div class="row">
					<div class="col-md-12">
						Otro link
						<img src="<?php echo $path.$asset; ?>500x300.jpg" alt="TestIMG">

					</div>
				</div>
			</div>
		</section>
	<?php } ?>

	<?php include("structure/footer.php") ?>
</body>
</html>