<div class="form-group">
	<input type="text" class="form-control" name="name" value="<?php echo $row["name"]; ?>" placeholder="Nombre" required>
</div>
<div class="form-group">
	<input type="text" class="form-control" name="first_name" value="<?php echo $row["first_name"]; ?>" placeholder="Apellido Paterno" required>
</div>
<div class="form-group">
	<input type="text" class="form-control" name="last_name" value="<?php echo $row["last_name"]; ?>" placeholder="Apellido Materno" required>
</div>
<div class="form-group">
	<input type="text" class="form-control" name="username" value="<?php echo $row["username"]; ?>" placeholder="Usuario" required>
</div>
<div class="form-group">
	<input type="email" class="form-control" name="email" value="<?php echo $row["email"]; ?>" placeholder="Correo Electrónico" required>
</div>
<div class="form-group">
	<input type="password" class="form-control" name="password" placeholder="Contraseña" <?php if( !isset($edit) ) echo 'required' ?>>
		<?php if( isset($row) ) { ?>
				<small class="help-block">Si no es deseas cambiar la contraseña, deja el campo en blanco.</psmall>
		<?php } ?>
</div>
<?php if( isset($row) ) { ?>
		<?php if( $row["id"]==user()["id"] ) { ?>
			<input type="hidden" name="permission" value="<?php echo $row["permission"]; ?>">
		<?php } else { ?>
				<div class="form-group">
					<select name="permission" id="permission" class="form-control">
						<option value="null" selected hidden>Selecciona un permiso...</option>
						<?php
							if( mysqli_num_rows($u_result)>0 ) {
								while( $u_row=mysqli_fetch_array($u_result) ) {
									if( $u_row["id"]==$row["permission"] )
										$selected = "selected";
									else
										$selected = "";
									echo "<option value='".$u_row["id"]."' ".$selected.">".$u_row["name"]."</option>";
								}
							}
						?>
					</select>
				</div>
		<?php } ?>
<?php } else { ?>
		<div class="form-group">
			<select name="permission" id="permission" class="form-control">
				<option value="null" selected hidden>Selecciona un permiso...</option>
				<?php
					if( mysqli_num_rows($u_result)>0 ) {
						while( $u_row=mysqli_fetch_array($u_result) ) {
							if( $u_row["id"]==$row["permission"] )
								$selected = "selected";
							else
								$selected = "";
							echo "<option value='".$u_row["id"]."' ".$selected.">".$u_row["name"]."</option>";
						}
					}
				?>
			</select>
		</div>
<?php } ?>