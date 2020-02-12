<footer class="pt-60 pb-60 bg-default" data-url="<?php echo $path; ?>" data-dir-ln="<?php echo substr($path,0,-1); ?>">
	<div class="container-custom">
		<div class="row">
			<div class="col-sm-12">
				Footer
			</div>
		</div>
	</div>
</footer>


<?php /* JS Tags */ ?>
<?php /*jQuery js minified*/ ?>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<?php /*jQuery UI*/ ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<?php /*Bootstrap js minified*/ ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<?php /*Script Font Awesome*/ ?>
<script src="https://use.fontawesome.com/releases/v5.8.1/js/all.js"></script>
<?php /*Scroll reveal*/ ?>
<script src="<?php Times::fileTime("assets/js/scrollreveal/scrollreveal.min.js"); ?>"></script>
<?php /*Scroll Magic*/ ?>
<script src="<?php Times::fileTime("assets/js/scrollmagic/TweenMax.min.js"); ?>"></script>
<script src="<?php Times::fileTime("assets/js/scrollmagic/ScrollMagic.min.js"); ?>"></script>
<script src="<?php Times::fileTime("assets/js/scrollmagic/animation.gsap.js"); ?>"></script>
<script src="<?php Times::fileTime("assets/js/scrollmagic/debug.addIndicators.js"); ?>"></script>
<?php /*Script Scrollify*/ ?>
<script src="<?php Times::fileTime("assets/js/scrollify/jquery.scrollify.min.js"); ?>"></script>
<?php /*Script custom*/ ?>
<script src="<?php Times::fileTime("assets/js/script.js"); ?>"></script>
<script src="<?php Times::fileTime("assets/js/img-to-svg.js"); ?>"></script>
<?php /*reCaptcha*/ ?>
<?php if( $_SESSION["recaptcha"]=="v3" ) { ?>
<script src='https://www.google.com/recaptcha/api.js?render=<?php echo $env->GRECAPTCHA_PUBLIC; ?>'></script>
<?php } ?>
<script src="<?php Times::fileTime("assets/js/footer.js"); ?>"></script>
