<?php
	require realpath($_SERVER["DOCUMENT_ROOT"])."/"."php/vendor/autoload.php";
  include( realpath($_SERVER["DOCUMENT_ROOT"])."/"."env.php" );
	include( realpath($_SERVER["DOCUMENT_ROOT"])."/php/db/auth.php" );

	if( Auth::check() ) {
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php
		$title="Inicio";
		$copy_year = date("Y",strtotime("today"));
		include("structure/head.php");
	?>
</head>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
	<?php include("structure/navbar.php"); ?>

	<div class="content-wrapper">
		<div class="contianer-fluid">
			Bienvenido
		</div>
	</div>

	<?php include("structure/footer.php"); ?>

	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fa fa-angle-up"></i>
	</a>
	<?php include("widgets/modal.php"); ?>
</body>
</html>
<?php
	} else {
		Redirect::to("login");
	}
?>
