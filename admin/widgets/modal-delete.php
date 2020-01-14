<!-- Modal Delete -->
<div class="modal fade" id="delete-record" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar registro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        ¿Está seguro que deseas eliminar este registro?
      </div>
      <div class="modal-footer">
      	<form id="delete-form" action="<?php echo $env->APP_URL ?>php/db/requests.php" method="POST">
      		<input type="hidden" name="request" value="delete">
      		<input type="hidden" name="table" value="<?php echo $table; ?>">
      		<input type="hidden" name="path" value="<?php echo $env->APP_URL_ADMIN.$_pth; ?>">
      		<input type="hidden" name="id" value="">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
	        <button type="submit" class="btn btn-danger">Eliminar</button>
      	</form>
      </div>
    </div>
  </div>
</div>
