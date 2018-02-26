<?php
	ini_set('display_errors', 'Off');
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
?>
<link rel="shortcut icon" href="http://placehold.it/64.png"/>
<meta charset="UTF-8">
<title> <?php echo $view_name; ?> | site_name </title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<?php /* CSS Tags */ ?>
<?php /*Bootstrap css minified*/ ?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" crossorigin="anonymous">
<?php /*Style custom*/ ?>
<link rel="stylesheet" href="<?php echo $path; ?>assets/css/custom.css">

<?php /* JS Tags */ ?>
<?php /*jQuery js minified*/ ?>
<script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
<?php /*jQuery UI*/ ?>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<?php /*Bootstrap js minified*/ ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" crossorigin="anonymous"></script>
<?php /*Fontawesome*/ ?>
<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
<?php /*Scroll reveal*/ ?>
<script src="https://unpkg.com/scrollreveal/dist/scrollreveal.min.js"></script>
<?php /*Script custom*/ ?>
<script src="<?php echo $path; ?>assets/js/head.js"></script>