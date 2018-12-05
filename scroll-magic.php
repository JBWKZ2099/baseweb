<!DOCTYPE html>
<html class="h-100" lang="es">
<head>
	<?php
		$view_name="Scroll Magic";
		include("structure/head.php");
		$asset = "assets/img/folder_name/"; // Path where are storaged media files (img, video, etc)
	?>
	<style>
		.all-slides {
			width: 100%;
			height: 100%;
			overflow: hidden;
		}
		.slide-section {
			width: 100%;
			height: 100%;
			position: absolute;
		}
		.blue { background-color: #3883d8; }
		.aqua { background-color: #38ced7; }
		.green { background-color: green; }
		.red { background-color: #953543; }
	</style>
</head>
<body>
	<?php $active="index"; include("structure/navbar.php"); ?>

	<section id="slides-container" class="container-fluid p-0 all-slides">
		<section class="slide-section col-md-12 blue text-white">
			ONE
		</section>
		<section class="slide-section col-md-12 aqua text-white">
			TWO
		</section>
		<section class="slide-section col-md-12 green text-white">
			THREE
		</section>
		<section class="slide-section col-md-12 red text-white">
			FOUR
		</section>
	</section>

	<?php include("structure/footer.php"); ?>
	<script>
		$(function(){
			var controller = new ScrollMagic.Controller();

			var wipe = new TimelineMax()
								.fromTo("section.slide-section.aqua", 1, {x:"-100%"}, {x:"0%", ease: Linear.easeNone})
								.fromTo("section.slide-section.green", 1, {x:"100%"}, {x:"0%", ease: Linear.easeNone})
								.fromTo("section.slide-section.red", 1, {y:"-100%"}, {y:"0%", ease: Linear.easeNone})

			new ScrollMagic.Scene({
				triggerElement: "#slides-container",
				triggerHook: "onLeave",
				duration: "300%"
			})
			.setPin("#slides-container")
			.setTween(wipe)
			// .addIndicators()
			.addTo(controller);
		});
	</script>
</body>
</html>