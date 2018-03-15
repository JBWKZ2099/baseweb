<?php
	session_start();
	include("../php/db/conn.php");
	include("../php/db/auth.php");
	
	if( authCheck() ) {
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
	<?php include("structure/navbar.php") ?>
	
	<div class="content-wrapper">
		<div class="contianer-fluid">
			Bienvenido
			<?php echo $_SERVER["REQUEST_URI"] ?>
		</div>
	</div>

	<?php include("structure/footer.php") ?>

	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fa fa-angle-up"></i>
	</a>
	<?php include("widgets/modal.php") ?>
</body>
</html>
<?php
	} else {
		header("Location: login");
	}
?>