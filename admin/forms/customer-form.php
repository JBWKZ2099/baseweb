<div class="form-group mb-3">
	<input id="name" type="text" class="form-control" name="name" value="<?php echo $row["name"]; ?>" placeholder="Nombre" required>
</div>
<div class="form-group mb-3">
	<input id="last_name" type="text" class="form-control" name="last_name" value="<?php echo $row["last_name"]; ?>" placeholder="Apellido(s)" required>
</div>
<div class="form-group mb-3">
	<input id="username" type="text" class="form-control" name="username" value="<?php echo $row["username"]; ?>" placeholder="Usuario" required>
</div>
<div class="form-group mb-3">
	<input id="email" type="email" class="form-control" name="email" value="<?php echo $row["email"]; ?>" placeholder="Correo Electrónico" required>
</div>
<div class="form-group mb-3">
	<input type="password" class="form-control" name="password" placeholder="Contraseña" <?php if( !isset($edit) ) echo 'required' ?>>
		<?php if( isset($row) ) { ?>
				<small class="help-block">Si no es deseas cambiar la contraseña, deja el campo en blanco.</small>
		<?php } ?>
</div>
<div class="form-group mb-3">
	<input type="password" class="form-control" name="password_confirm" placeholder="Confirmar Contraseña" <?php if( !isset($edit) ) echo 'required' ?>>
		<?php if( isset($row) ) { ?>
				<small class="help-block">Si no es deseas cambiar la contraseña, deja el campo en blanco.</small>
		<?php } ?>
</div>
<?php include("../widgets/permissions.php"); ?>

<?php if( Auth::user()->permission_superadmin && Auth::user()->permission_admin ) { ?>
	<div class="form-group mb-3">
		<label>Selecciona los permisos para ésta cuenta:</label>
	</div>
	<div class="form-group mb-3">
		<label for="permission_superadmin">
			<?php if( isset($row_obj) && $row_obj->permission_superadmin ) { $admin_checked="checked='checked'"; } else $admin_checked = ""; ?>
			<input id="permission_superadmin" name="permission_superadmin" <?php echo $admin_checked; ?> type="checkbox"> Super Admin
		</label>
		<p><small class="block-help text-info"> <i class="fa fa-info-circle"></i> Si deseas seleccionar todos los permisos marca esta opción (Super Admin).</small></p>
	</div>

	<div id="permissions-container" <?php if( Auth::user()->permission_admin==0 ) { echo "style='display:none;'"; } ?>>
		<div class="form-group mb-3">
			<label for="permission_admin">
				<?php if( isset($row_obj) && $row_obj->permission_admin ) { $admin_checked="checked='checked'"; } else $admin_checked = ""; ?>
				<input id="permission_admin" name="permission_admin" <?php echo $admin_checked; ?> type="checkbox"> Administrador
			</label>
			<p><small class="block-help text-info"> <i class="fa fa-info-circle"></i> Para poder acceder a cada módulo, este permiso debe estar activo (Administrador).</small></p>
		</div>

		<table class="table table-striped">
			<thead>
				<tr>
					<th>Módulo</th>
					<th class="text-center">Crear</th>
					<th class="text-center">Leer</th>
					<th class="text-center">Actualizar</th>
					<th class="text-center">Eliminar</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach( $permissions as $key => $permission ) { ?>
					<?php
						// dd( in_array("create", $permission["permissions"]) );
					?>
					<tr>
						<td><?php echo $permission["name"]; ?></td>
						<td class="text-center">
								<?php if( in_array("create", $permission["permissions"]) ) { ?>
									<input name="<?php echo $key; ?>_c" type="checkbox" <?php if( $row_obj->{$key."_c"} ) { ?>checked="true"<?php } ?>>
								<?php } ?>
						</td>
						<td class="text-center">
								<?php if( in_array("read", $permission["permissions"]) ) { ?>
								<input name="<?php echo $key; ?>_r" type="checkbox" <?php if( $row_obj->{$key."_r"} ) { ?>checked="true"<?php } ?>>
							<?php } ?>
						</td>
						<td class="text-center">
								<?php if( in_array("update", $permission["permissions"]) ) { ?>
									<input name="<?php echo $key; ?>_u" type="checkbox" <?php if( $row_obj->{$key."_u"} ) { ?>checked="true"<?php } ?>>
								<?php } ?>
						</td>
						<td class="text-center">
								<?php if( in_array("delete", $permission["permissions"]) ) { ?>
									<input name="<?php echo $key; ?>_d" type="checkbox" <?php if( $row_obj->{$key."_d"} ) { ?>checked="true"<?php } ?>>
								<?php } ?>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
<?php } else { ?>
	<?php foreach( $permissions as $key => $permission ) { ?>
		<?php if( in_array("create", $permission["permissions"]) ) { ?>
			<input name="<?php echo $key; ?>_c" type="hidden" <?php if( $row_obj->{$key."_c"} ) { ?>value="on"<?php } ?>>
		<?php } ?>
		<?php if( in_array("read", $permission["permissions"]) ) { ?>
			<input name="<?php echo $key; ?>_r" type="hidden" <?php if( $row_obj->{$key."_r"} ) { ?>value="on"<?php } ?>>
		<?php } ?>
		<?php if( in_array("update", $permission["permissions"]) ) { ?>
			<input name="<?php echo $key; ?>_u" type="hidden" <?php if( $row_obj->{$key."_u"} ) { ?>value="on"<?php } ?>>
		<?php } ?>
		<?php if( in_array("delete", $permission["permissions"]) ) { ?>
			<input name="<?php echo $key; ?>_d" type="hidden" <?php if( $row_obj->{$key."_d"} ) { ?>value="on"<?php } ?>>
		<?php } ?>
	<?php }?>
<?php }?>