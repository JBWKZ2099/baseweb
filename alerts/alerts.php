<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
        	<?php if( isset($_SESSION["_errors"]) && !empty($_SESSION["_errors"]) ) { ?>
        		Error al enviar datos de contacto:
        	<?php } ?>
        	<?php if( isset($_SESSION["_success"]) && !empty($_SESSION["_success"]) ) { ?>
        		Gracias por contactarnos
        	<?php } ?>
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
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
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
