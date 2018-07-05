<?php if( isset($_SESSION["message"]) ) { ?>
	<div class="alert alert-success alert-dismissible mt-3 mb-3 fade show" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<?php /* Obtenemos mensaje */ ?>
		<?php echo $_SESSION["message"]; ?>
	</div>
<?php
		unset($_SESSION["message"]);
	}
?>