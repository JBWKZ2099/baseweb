<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<i class="fa fa-list fa-fw"></i>
				Lista de <?php echo $data_table_which; ?>
			</div>
			<div class="card-body">
				<?php
					include("../alerts/errors.php");
					include("../alerts/success.php");
				?>
				<div class="table-responsive">
					<table id="table-gen" class="table table-inverse table-hover table-striped table-bordered">
						<thead>
							<tr>
								<th>ID</th>
								<?php foreach( $table_head as $th ) { ?>
									<th> <?php echo $th; ?> </th>
								<?php } ?>
								<th>Acciones</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
