<?php include( "../php/header.lib.php" ); ?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title> <?php echo $title." | ".$env->APP_NAME; ?> </title>
<!-- Bootstrap core CSS-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<!-- Page level plugin CSS-->
<link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
<?php /*FormValidation v0.8.1 */ ?>
<link rel="stylesheet" href="<?php Times::fileTime("assets/js/formvalidation/dist/css/formValidation.min.css"); ?>">
<!-- Custom styles for this template-->
<link href="<?php Times::fileTime("admin/assets/css/sb-admin.css"); ?>" rel="stylesheet">
<link href="<?php Times::fileTime("admin/assets/css/admin.css"); ?>" rel="stylesheet">
<?php /*
<link href="<?php Times::fileTime("../assets/css/core.css"); ?>" rel="stylesheet">
<link href="<?php Times::fileTime("../assets/css/custom.css"); ?>" rel="stylesheet">
*/ ?>

<script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js"></script>
<!-- Bootstrap core JavaScript-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<!-- Page level plugin JavaScript-->
<!-- <script src="<?php Times::fileTime("vendor/chart.js/Chart.min.js") ?>"></script> -->
<!-- <script src="vendor/datatables/dataTables.bootstrap4.js"></script> -->
<!-- Custom scripts for all pages-->
<script src="<?php Times::fileTime("admin/assets/js/sb-admin.min.js") ?>"></script>
<!-- Custom scripts for this page-->
<!-- <script src="assets/js/sb-admin-datatables.min.js"></script> -->
<script src="<?php Times::fileTime("admin/assets/js/script.js") ?>"></script>

<script>
	direction = "<?php echo $env->APP_URL; ?>";
</script>

<?php
	$query = $_SERVER['PHP_SELF'];
	$path = pathinfo( $query );
	$current = str_replace(".php", "", $path['basename']);

	if( $current!="login" && $current!="recuperar-contrasena" && $current!="recuperar-contrasena-confirmar" )
		include("../php/db/session.php");
?>
