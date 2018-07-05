<?php if( isset($_SESSION["error"]) ) { ?>
	<div class="alert alert-danger alert-dismissible mt-3 mb-3 fade show" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<?php /* Obtenemos mensaje */ ?>
		<?php echo $_SESSION["error"]; ?>
	</div>
<?php
		unset($_SESSION["error"]);
	}
?>