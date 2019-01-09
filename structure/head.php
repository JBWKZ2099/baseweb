<?php
	ini_set('display_errors', 'Off');

	$root = realpath($_SERVER["DOCUMENT_ROOT"])."/";

	require $root."php/vendor/autoload.php";


	/**
	 * Code to make absoulute paths (example: http://www.domain-name.com/assets/img/img_name.jpg);
	 */
	$path = (!empty($_SERVER['HTTPS']) ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'];
	/**
	 * Optimized code to work on local with virtualhosts or localhost or production server
	 */
	$path = (!empty($_SERVER['HTTPS']) ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'];

	$app_name = "base-b4";
	switch( $path ) {
		case "http://localhost":
			$path .= "/".$app_name."/";
			break;

		case "http://fabricadesoluciones.info":
			$path .= "/".$app_name."/";
			break;

		default:
			$path .= "/";
			break;
	}
  // $path = $_SERVER['HTTP_HOST'] == 'localhost:8888' ? '/fabricadesoluciones.com/' : '';

	function fileTime( $asset_path ) {
		global $path;
		$file = filemtime($asset_path);
		$asset = $path.$asset_path."?".$file;

		return $asset;
	}
?>
<link rel="shortcut icon" href="http://placehold.it/32.png"/>
<meta charset="UTF-8">
<title> <?php echo $view_name; ?> | site_name </title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<?php /* CSS Tags */ ?>
<?php /*Bootstrap css minified*/ ?>
<link rel="stylesheet" href="<?php echo fileTime("assets/css/bootstrap.min.css"); ?>">
<?php /*Style Core*/ ?>
<link rel="stylesheet" href="<?php echo fileTime("assets/css/core.css"); ?>">
<?php /*Style Custom*/ ?>
<link rel="stylesheet" href="<?php echo fileTime("assets/css/custom.css"); ?>">

<?php /* JS Tags */ ?>
<?php /*jQuery js minified*/ ?>
<script src="<?php echo fileTime("assets/js/jquery/jquery.min.js"); ?>" async="async" defer="defer"></script>
<?php /*jQuery UI*/ ?>
<script src="<?php echo fileTime("assets/js/jquery/jquery-ui.min.js"); ?>" async="async" defer="defer"></script>
<?php /*Bootstrap js minified*/ ?>
<script src="<?php echo fileTime("assets/js/bootstrap/popper.min.js") ?>" async="async" defer="defer"></script>
<script src="<?php echo fileTime("assets/js/bootstrap/bootstrap.min.js"); ?>" async="async" defer="defer"></script>
<?php /*Fontawesome*/ ?>
<script defer src="https://use.fontawesome.com/releases/v5.1.0/js/all.js"></script>
<?php /*Scroll reveal*/ ?>
<script src="<?php echo fileTime("assets/js/scrollreveal.min.js"); ?>" async="async" defer="defer"></script>
<?php /*Scroll Magic*/ ?>
<script src="<?php echo fileTime("assets/js/scrollmagic/TweenMax.min.js"); ?>" async="async" defer="defer"></script>
<script src="<?php echo fileTime("assets/js/scrollmagic/ScrollMagic.min.js"); ?>" async="async" defer="defer"></script>
<script src="<?php echo fileTime("assets/js/scrollmagic/animation.gsap.js"); ?>" async="async" defer="defer"></script>
<script src="<?php echo fileTime("assets/js/scrollmagic/debug.addIndicators.js"); ?>" async="async" defer="defer"></script>
<?php /*Script Scrollify*/ ?>
<script src="<?php echo fileTime("assets/js/scrollify/jquery.scrollify.min.js"); ?>" async="async" defer="defer"></script>
<?php /*Script custom*/ ?>
<script src="<?php echo fileTime("assets/js/head.js"); ?>" async="async" defer="defer"></script>
<script src="<?php echo fileTime("assets/js/img-to-svg.js"); ?>" async="async" defer="defer"></script>
<script>
	var direction = "<?php echo $path; ?>";
</script>
