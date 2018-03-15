<!-- Logout Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">¿Estás seguro?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				Selecciona "Logout" si quieres terminar tu sesión actual.
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				<form action="../php/db/requests" method="POST">
					<input type="hidden" name="request" value="logout">
					<button type="submit" class="btn btn-danger">Logout</button>
				</form>
			</div>
		</div>
	</div>
</div>