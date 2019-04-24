<?php include( "php/header.lib.php" ); ?>
<link rel="shortcut icon" href="http://placehold.it/32.png"/>
<meta charset="UTF-8">
<title> <?php echo $view_name; ?> | <?php echo $env->APP_NAME; ?> </title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<?php /* CSS Tags */ ?>
<?php /*Bootstrap css minified*/ ?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<?php /*Style Core*/ ?>
<link rel="stylesheet" href="<?php echo fileTime("assets/css/core.css"); ?>">
<?php /*Style Custom*/ ?>
<link rel="stylesheet" href="<?php echo fileTime("assets/css/custom.css"); ?>">

<?php /* JS Tags */ ?>
<?php /*jQuery js minified*/ ?>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<?php /*jQuery UI*/ ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<?php /*Bootstrap js minified*/ ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.j"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<?php /*Script Font Awesome*/ ?>
<script src="https://use.fontawesome.com/releases/v5.8.1/js/all.j"></script>
<?php /*Scroll reveal*/ ?>
<script src="<?php echo fileTime("assets/js/scrollreveal/scrollreveal.min.js"); ?>"></script>
<?php /*Scroll Magic*/ ?>
<script src="<?php echo fileTime("assets/js/scrollmagic/TweenMax.min.js"); ?>"></script>
<script src="<?php echo fileTime("assets/js/scrollmagic/ScrollMagic.min.js"); ?>"></script>
<script src="<?php echo fileTime("assets/js/scrollmagic/animation.gsap.js"); ?>"></script>
<script src="<?php echo fileTime("assets/js/scrollmagic/debug.addIndicators.js"); ?>"></script>
<?php /*Script Scrollify*/ ?>
<script src="<?php echo fileTime("assets/js/scrollify/jquery.scrollify.min.js"); ?>"></script>
<?php /*Script custom*/ ?>
<script src="<?php echo fileTime("assets/js/script.js"); ?>"></script>
<script src="<?php echo fileTime("assets/js/img-to-svg.js"); ?>"></script>
<?php /*reCaptcha*/ ?>
<?php if( $_SESSION["recaptcha"]=="v3" ) { ?>
<script src='https://www.google.com/recaptcha/api.js?render=<?php echo $env->GRECAPTCHA_PUBLIC; ?>'></script>
<?php } ?>
<script>
	var direction = "<?php echo $path; ?>";
	var recaptcha = "<?php echo $_SESSION["recaptcha"]; ?>";
</script>
