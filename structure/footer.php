<footer class="py-3 py-md-5 bg-default" data-url="<?php echo $path; ?>" data-dir-ln="<?php echo substr($path,0,-1); ?>">
	<div class="container-custom">
		<div class="row">
			<div class="col-md-12">
				Footer
			</div>
		</div>
	</div>
</footer>


<?php /* JS Tags */ ?>
<?php /*jQuery js minified*/ ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<?php /*jQuery UI*/ ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<?php /*Bootstrap Bundle (Bootstrap and Popper) js minified*/ ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<?php /*Script Font Awesome*/ ?>
<script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js"></script>
<?php /*Scroll reveal*/ ?>
<script src="https://unpkg.com/scrollreveal"></script>
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
<?php /*FormValidation v0.8.1*/ ?>
<script src="<?php Times::fileTime("assets/js/formvalidation/dist/js/formValidation.min.js"); ?>"></script>
<script src="<?php Times::fileTime("assets/js/formvalidation/dist/js/framework/bootstrap.min.js"); ?>"></script>
<script src="<?php Times::fileTime("assets/js/formvalidation/dist/js/language/es_ES.js"); ?>"></script>
<?php /*FormValidation v0.8.1*/ ?>
<?php /*reCaptcha*/ ?>
<?php if( $_SESSION["recaptcha"]=="v3" ) { ?>
<script src='https://www.google.com/recaptcha/api.js?render=<?php echo $env->GRECAPTCHA_PUBLIC; ?>'></script>
<?php } ?>
<script src="<?php Times::fileTime("assets/js/footer.js"); ?>"></script>
<script src="<?php Times::fileTime("assets/js/contact.js"); ?>"></script>

<?php if( $_SESSION["recaptcha"]=="v3" ) { ?>
	<script defer>
		$("#msg").focus(function(){
			grecaptcha.ready(function() {
				// do request for recaptcha token
				// response is promise with passed token
				grecaptcha.execute('<?php echo $env->GRECAPTCHA_PUBLIC; ?>', {action: 'get_in_touch'}).then(function(token) {
					$(document).find(".g-recaptcha-generated").remove();
					// add token to form
					$('form#contact-form').prepend('<input class="g-recaptcha-generated" type="hidden" name="g-recaptcha-response" value="' + token + '">');
					$('form#contact-form').prepend('<input class="g-recaptcha-generated" type="hidden" name="action" value="get_in_touch">');
				});
			});
		});
	</script>
<?php } ?>

<?php if( isset($_SESSION["_errors"]) || isset($_SESSION["_success"]) ) { ?>
	<script>
		$(function(){ $(".modal").modal("show"); });
	</script>
<?php
		unset($_SESSION["_errors"]);
		unset($_SESSION["_success"]);
	}
?>
