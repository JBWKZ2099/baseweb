<?php
include('php/validator.php');
include('php/validator-admin.php');
?>
	<!DOCTYPE html>
	<html lang="en">
	<?php require('structure/head.php'); ?>
	<body>
		<div class="container-custom">
			<div class="row pt30">
				<div class="col-sm-12 text-right mb30">
					<p>
						<?php
							echo"¡Bienvenido! ".$_SESSION['username'];

						 ?>
						 <a href="php/logout.php" class="btn btn-orange">Cerrar Sesión</a>
					</p>
				</div>
				<div class="col-sm-12 text-center mb60">
					<h3 class="color-rosa">Administración de Usuarios</h3>
				</div>
				<div class="col-sm-6 text-center mb30">
					<a href="panel-control.php" class="btn btn-default">Panel de Control</a>
				</div>
				<div class="col-sm-6 text-center mb30">
					<a href="create-user.php" class="btn btn-success">Crear Usuario</a>
				</div>
				<div class="col-sm-12 mt15">
					<div class="table-responsive">
						<table class="table table-hover table-striped table-condensed table-bordered font-lato" id="data">
							<thead>
                <tr>
                	<th class="text-center"><span title="username">Username <i class="glyphicon glyphicon-sort"></i> </span></th>
                	<th class="text-center"><span title="mail">Email <i class="glyphicon glyphicon-sort"></i> </span></th>
                	<th class="text-center"><span title="permission">Permisos</span></th>
                	<th class="text-center"><span title="">Acciones</span></th>
                </tr>
              </thead>
            <tbody>
            </tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Eliminar Usuario</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" id="id-delete">
        <div class="form-group text-center">
          <br>
          <span id="value-modal"></span>
        </div>
      </div>
      <div class="modal-footer">
        <button value="" id="eliminar" OnClick='EliminarUsuario(this);' class='btn btn-danger'>Eliminar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	    <!-- Latest compiled and minified JavaScript -->
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	    <script src='http://code.jquery.com/ui/1.11.3/jquery-ui.js'></script>
	    <script src="assets/js/delete-user.js"></script>
	    <script src="assets/js/table-user.js"></script>
	</body>
	</html>