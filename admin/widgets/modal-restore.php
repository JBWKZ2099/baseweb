<!-- Modal Restore -->
<div class="modal fade" id="restore-record" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Restaurar registro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        ¿Está seguro que deseas restaurar este registro?
      </div>
      <div class="modal-footer">
        <form id="restore-form" action="<?php echo $env->APP_URL ?>php/db/requests.php" method="POST">
          <input type="hidden" name="request" value="restore">
          <input type="hidden" name="table" value="<?php echo $table; ?>">
          <input type="hidden" name="path" value="<?php echo $env->APP_URL_ADMIN.$_pth; ?>">
          <input type="hidden" name="id" value="">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-warning">Restaurar</button>
        </form>
      </div>
    </div>
  </div>
</div>
