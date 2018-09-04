<?php
	ini_set('display_errors', 'Off');
	
	$root = realpath($_SERVER["DOCUMENT_ROOT"])."/";
	require $root."php/vendor/autoload.php";

	$company_name = "Brand";
	/**
	 * Code to make absoulute paths (example: http://www.domain-name.com/assets/img/img_name.jpg);
	 */
	$abs_path = (!empty($_SERVER['HTTPS']) ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'];
	/**
	 * Optimized code to work on local with virtualhosts or localhost or production server
	 */
	$abs_path = (!empty($_SERVER['HTTPS']) ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'];

	$app_name = "base-b4";

	switch( $abs_path ) {
		case "http://localhost":
			$abs_path .= "/".$app_name."/";
			break;

		case "http://fabricadesoluciones.info":
			$abs_path .= "/".$app_name."/";
			break;

		default:
			$abs_path .= "/admin";
			break;
	}
  // $path = $_SERVER['HTTP_HOST'] == 'localhost:8888' ? '/fabricadesoluciones.com/' : '';
?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title> <?php echo $title." | ".$company_name; ?> </title>
<!-- Bootstrap core CSS-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" crossorigin="anonymous">
<!-- Page level plugin CSS-->
<link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
<!-- Custom styles for this template-->
<link href="<?php echo $abs_path."/"; ?>assets/css/sb-admin.css" rel="stylesheet">
<link href="<?php echo $abs_path."/"; ?>assets/css/admin.css" rel="stylesheet">
<link href="<?php echo $abs_path."/"; ?>../assets/css/core.css" rel="stylesheet">
<link href="<?php echo $abs_path."/"; ?>../assets/css/custom.css" rel="stylesheet">

<script src="https://use.fontawesome.com/5b97f125c2.js"></script>
<!-- Bootstrap core JavaScript-->
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" crossorigin="anonymous"></script>
<!-- Page level plugin JavaScript-->
<script src="<?php echo $abs_path."/"; ?>vendor/chart.js/Chart.min.js"></script>
<!-- <script src="vendor/datatables/dataTables.bootstrap4.js"></script> -->
<!-- Custom scripts for all pages-->
<script src="<?php echo $abs_path."/"; ?>assets/js/sb-admin.min.js"></script>
<!-- Custom scripts for this page-->
<!-- <script src="assets/js/sb-admin-datatables.min.js"></script> -->
<script src="<?php echo $abs_path."/"; ?>assets/js/script.js"></script>

<script>
	/*var direction = "http://216.108.227.105/~reactordm";*/
	// var direction = "https://reactordemercados.com";
	var direction = "http://base.test";
</script>

<?php
	$query = $_SERVER['PHP_SELF'];
	$path = pathinfo( $query );
	$current = str_replace(".php", "", $path['basename']);

	if( $current!=login )
		include("../php/db/session.php");
?>