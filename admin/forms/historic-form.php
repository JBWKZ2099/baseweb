<div class="form-group">
		<input type="text" class="form-control" name="name" value="<?php echo $row["name"]; ?>" placeholder="Nombre" required>
</div>
<div class="form-group">
		<label for="pdf">Buscar Archivo</label>
		<input id="pdf" type="file" class="form-control-file" name="pdf" <?php if( !isset($edit) ) echo 'required'; ?>>
</div>
<?php if( isset($row) ) { ?>
		<?php if( $row["user"] == Auth::user()->id ) { ?>
				<input type="hidden" name="user" value="<?php echo $row["user"]; ?>">
		<?php } else { ?>
				<div class="form-group">
					<label for="u-name">
						<b>Cliente:</b>
						<?php
							if( mysqli_num_rows($u_result)>0 ) {
								while( $u_row=mysqli_fetch_array($u_result) ) {
									if( $u_row["id"]==$row["user"] )
										echo $u_row["name"]." ".$u_row["first_name"]." | ".$u_row["company"];
								}
							}
						?>
					</label>
				</div>
		<?php } ?>
<?php } else { ?>
		<div class="form-group">
			<select name="user" id="user" class="form-control">
				<option value="null" checked hidden>Selecciona un usuario...</option>
				<?php
					if( mysqli_num_rows($u_result)>0 ) {
						while( $u_row=mysqli_fetch_array($u_result) ) {
							if( $u_row["id"] )
							echo "<option value='".$u_row["id"]."'>".$u_row["name"].$u_row["first_name"]." | ".$u_row["company"]."</option>";
						}
					}
				?>
			</select>
		</div>
<?php } ?>
