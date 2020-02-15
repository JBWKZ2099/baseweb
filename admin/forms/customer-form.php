<div class="form-group">
	<input id="name" type="text" class="form-control" name="name" value="<?php echo $row["name"]; ?>" placeholder="Nombre" required>
</div>
<div class="form-group">
	<input id="last_name" type="text" class="form-control" name="last_name" value="<?php echo $row["last_name"]; ?>" placeholder="Apellido Materno" required>
</div>
<div class="form-group">
	<input id="username" type="text" class="form-control" name="username" value="<?php echo $row["username"]; ?>" placeholder="Usuario" required>
</div>
<div class="form-group">
	<input id="email" type="email" class="form-control" name="email" value="<?php echo $row["email"]; ?>" placeholder="Correo Electrónico" required>
</div>
<div class="form-group">
	<input type="password" class="form-control" name="password" placeholder="Contraseña" <?php if( !isset($edit) ) echo 'required' ?>>
		<?php if( isset($row) ) { ?>
				<small class="help-block">Si no es deseas cambiar la contraseña, deja el campo en blanco.</psmall>
		<?php } ?>
</div>
<?php
	$permissions = array(
		"permission_users" => "Usuarios",
		"permission_blogs" => "Blogs",
		"permission_categories" => "Categorías",
		"permission_subcategories" => "Subcategorías",
	);
?>

<?php if( Auth::user()->permission_superadmin==1 && Auth::user()->permission_admin==1 ) { ?>
	<div class="form-group">
		<label>Selecciona los permisos para ésta cuenta:</label>
	</div>
	<div class="form-group">
		<label for="permission_superadmin">
			<?php if( isset($row_obj) && $row_obj->permission_superadmin==1 ) { $admin_checked="checked='checked'"; } else $admin_checked = ""; ?>
			<input id="permission_superadmin" name="permission_superadmin" <?php echo $admin_checked; ?> type="checkbox"> Super Admin
		</label>
		<p><small class="block-help text-info"> <i class="fa fa-info-circle"></i> Si deseas seleccionar todos los permisos marca esta opción (Super Admin).</small></p>
	</div>

	<div id="permissions-container" <?php if( Auth::user()->permission_admin==0 ) { echo "style='display:none;'"; } ?>>
		<div class="form-group">
			<label for="permission_admin">
				<?php if( isset($row_obj) && $row_obj->permission_admin==1 ) { $admin_checked="checked='checked'"; } else $admin_checked = ""; ?>
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
					<tr>
						<td><?php echo $permission; ?></td>
						<td class="text-center">
								<input name="<?php echo $key; ?>_c" type="checkbox" <?php if( $row_obj->{$key."_c"}==1 ) { ?>checked="true"<?php } ?>>
						</td>
						<td class="text-center">
							<input name="<?php echo $key; ?>_r" type="checkbox" <?php if( $row_obj->{$key."_r"}==1 ) { ?>checked="true"<?php } ?>>
						</td>
						<td class="text-center">
								<input name="<?php echo $key; ?>_u" type="checkbox" <?php if( $row_obj->{$key."_u"}==1 ) { ?>checked="true"<?php } ?>>
						</td>
						<td class="text-center">
								<input name="<?php echo $key; ?>_d" type="checkbox" <?php if( $row_obj->{$key."_d"}==1 ) { ?>checked="true"<?php } ?>>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
<?php } else { ?>
	<?php foreach( $permissions as $key => $permission ) { ?>
		<input name="<?php echo $key; ?>_c" type="hidden" <?php if( $row_obj->{$key."_c"}==1 ) { ?>value="on"<?php } ?>>
		<input name="<?php echo $key; ?>_r" type="hidden" <?php if( $row_obj->{$key."_r"}==1 ) { ?>value="on"<?php } ?>>
		<input name="<?php echo $key; ?>_u" type="hidden" <?php if( $row_obj->{$key."_u"}==1 ) { ?>value="on"<?php } ?>>
		<input name="<?php echo $key; ?>_d" type="hidden" <?php if( $row_obj->{$key."_d"}==1 ) { ?>value="on"<?php } ?>>
	<?php }?>
<?php }?>