<?php if( isset($_SESSION["error"]) ) { ?>
	<div class="alert alert-danger alert-dismissible fade show my-3" role="alert">
	  <?php /* Obtenemos mensaje */ ?>
	  <?php echo $_SESSION["error"]; ?>
	  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
<?php
		unset($_SESSION["error"]);
	}
?>