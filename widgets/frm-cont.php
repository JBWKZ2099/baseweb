<?php include("alerts/alerts.php"); ?>
<form id="contact-form" action="<?php echo $path; ?>php/mailer/mailer.php" method="POST">
	<div class="form-group">
		<input id="name" type="text" class="form-control" name="name" value="" placeholder="Nombre:" required>
	</div>
	<div class="form-group">
		<input id="email" type="email" class="form-control" name="email" value="" placeholder="E-Mail:" required>
	</div>
	<div class="form-group">
		<input id="subject" type="text" class="form-control" name="subject" value="" placeholder="Asunto:" required>
	</div>
	<div class="form-group">
		<textarea id="msg" class="form-control" name="msg" rows="5" placeholder="Mensaje:"></textarea>
	</div>
	<?php if( $_SESSION["recaptcha"]=="v2" ) { ?>
		<div class="form-group">
			<div id="g-recaptcha"></div>
		</div>
	<?php } ?>
	<button type="submit" class="btn btn-secondary">Enviar</button>
</form>