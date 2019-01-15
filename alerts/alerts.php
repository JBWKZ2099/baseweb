<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">
					<?php if( isset($_SESSION["_errors"]) && !empty($_SESSION["_errors"]) ) { ?>
						Error al enviar datos de contacto:
					<?php } ?>
					<?php if( isset($_SESSION["_success"]) && !empty($_SESSION["_success"]) ) { ?>
						Gracias por contactarnos
					<?php } ?>
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body text-center">
				<?php if( isset($_SESSION["_errors"]) ) { ?>
					<div class="text-danger">
						<?php /* Obtenemos mensaje */ ?>
						<?php echo $_SESSION["_errors"]; ?>
					</div>
				<?php } ?>

				<?php if( isset($_SESSION["_success"]) ) { ?>
					<div class="text-success">
						<h2>
							<?php /* Obtenemos mensaje */ ?>
							<?php echo $_SESSION["_success"]; ?>
						</h2>
						<p>(Si no encuentras el correo en tu "Bandeja de entrada", recuerda buscar en tu carpeta de "Correo no deseado")</p>
					</div>
				<?php } ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>

<?php if( isset($_SESSION["_errors"]) || isset($_SESSION["_success"]) ) { ?>
	<script>
		$(".modal").modal("show");
	</script>
<?php
		unset($_SESSION["_errors"]);
		unset($_SESSION["_success"]);
	}
?>
