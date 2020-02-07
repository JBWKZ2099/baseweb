<form id="contact-form" class="contact-form" action="<?php echo $path; ?>php/mailer/mailer.php" method="POST" enctype="multipart/form-data">
	<input type="hidden" name="request" value="contact-form">
	<input type="hidden" name="table" value="contacts">
	<input type="hidden" name="current_lang" value="<?php echo $_SESSION["lang"]; ?>">

	<div class="form-row row">
		<div class="col-12 col-sm-6 mb-1">
			<input type="text" name="contact-name" id="contact-name" class="form-control text-left" placeholder="<?php echo $contact->form->name ?>" required="required">
		</div>
		<div class="col-12 col-sm-6 mb-1">
			<select name="contact-section" id="contact-section" class="form-control custom-select" required="required">
				<option value="null" disabled selected hidden><?php echo $contact->form->section->placeholder ?></option>
				<option value="ATENCIÓN_A_CLIENTES"><?php echo $contact->form->section->s1; ?></option>
				<option value="PROVEEDORES"><?php echo $contact->form->section->s4; ?></option>
				<option value="RECURSOS_HUMANOS"><?php echo $contact->form->section->s2; ?></option>
				<option value="VENTAS"><?php echo $contact->form->section->s3; ?></option>
				<option value="OTROS"><?php echo $contact->form->section->s5; ?></option>
			</select>
		</div>
	</div>

	<div class="form-row minus-margin-mobile">
		<div class="col-12 col-sm-6 mb-1" style="display: none; opacity: 1;" data-section="ATENCIÓN_A_CLIENTES,RECURSOS_HUMANOS,VENTAS,PROVEEDORES,OTROS">
			<input type="text" name="contact-company" id="contact-company" class="form-control text-left" placeholder="<?php echo $contact->form->company ?>">
		</div>
		<div class="col-12 col-sm-6 mb-1" style="display: none; opacity: 1;" data-section="VENTAS">
			<select name="contact-company-line" id="contact-company-line" class="form-control custom-select">
				<option value="null" disabled selected hidden><?php echo $contact->form->companyline->placeholder ?></option>
				<option value="<?php echo str_replace(" ", "_", $contact->form->companyline->s1); ?>"><?php echo $contact->form->companyline->s1; ?></option>
				<option value="<?php echo str_replace(" ", "_", $contact->form->companyline->s2); ?>"><?php echo $contact->form->companyline->s2; ?></option>
				<option value="<?php echo str_replace(" ", "_", $contact->form->companyline->s3); ?>"><?php echo $contact->form->companyline->s3; ?></option>
				<option value="<?php echo str_replace(" ", "_", $contact->form->companyline->s4); ?>"><?php echo $contact->form->companyline->s4; ?></option>
				<option value="<?php echo str_replace(" ", "_", $contact->form->companyline->s5); ?>"><?php echo $contact->form->companyline->s5; ?></option>
				<option value="<?php echo str_replace(" ", "_", $contact->form->companyline->s6); ?>"><?php echo $contact->form->companyline->s6; ?></option>
				<option value="<?php echo str_replace(" ", "_", $contact->form->companyline->s7); ?>"><?php echo $contact->form->companyline->s7; ?></option>
				<option value="<?php echo str_replace(" ", "_", $contact->form->companyline->s8); ?>"><?php echo $contact->form->companyline->s8; ?></option>
			</select>
		</div>
	</div>

	<div class="form-row row">
		<div class="col-sm-12 mb-1" style="display: none; opacity: 1;" data-section="RECURSOS_HUMANOS">
			<select name="type-employee" id="type-employee" class="form-control custom-select">
				<option value="null" disabled selected hidden><?php echo $contact->form->type_employee->placeholder ?></option>
				<option value="<?php echo str_replace(" ", "_", $contact->form->type_employee->s1); ?>"><?php echo $contact->form->type_employee->s1; ?></option>
				<option value="<?php echo str_replace(" ", "_", $contact->form->type_employee->s2); ?>"><?php echo $contact->form->type_employee->s2; ?></option>
				<option value="<?php echo str_replace(" ", "_", $contact->form->type_employee->s3); ?>"><?php echo $contact->form->type_employee->s3; ?></option>
			</select>
		</div>
		<div class="col-sm-12 mt-1 mb-1" style="display: none; opacity: 1;" data-subsection="CANDIDATO">
			<label for="type-employee"><?php echo $contact->form->type_employee->s0; ?></label>
			<input id="upload-cv" type="file" name="upload_cv" class="form-control">
			<small><?php echo $contact->form->type_employee->file_extension; ?></small>
		</div>
	</div>

	<div class="form-row row">
		<div class="col-sm-12 mb-1" style="display: none; opacity: 1;" data-section="PROVEEDORES">
			<select name="provider_type" id="provider_type" class="form-control custom-select">
				<option value="null" disabled selected hidden><?php echo $contact->form->provider_type->placeholder ?></option>
				<option value="<?php echo str_replace(" ", "_", $contact->form->provider_type->s1); ?>"><?php echo $contact->form->provider_type->s1; ?></option>
				<option value="<?php echo str_replace(" ", "_", $contact->form->provider_type->s2); ?>"><?php echo $contact->form->provider_type->s2; ?></option>
			</select>
		</div>
	</div>

	<div class="form-row row">
		<div class="col-12 col-sm-6 mb-1" style="display: none; opacity: 1;" data-section="ATENCIÓN_A_CLIENTES,RECURSOS_HUMANOS,VENTAS,PROVEEDORES,OTROS">
			<input type="text" name="contact-phone" id="contact-phone" class="form-control text-left" placeholder="<?php echo $contact->form->phone ?>">
		</div>
		<div class="col-12 col-sm-6 mb-3" style="display: none; opacity: 1;" data-section="ATENCIÓN_A_CLIENTES,RECURSOS_HUMANOS,VENTAS,PROVEEDORES,OTROS">
			<input type="email" name="contact-email" id="contact-email" class="form-control text-left" placeholder="<?php echo $contact->form->email ?>">
		</div>
	</div>

	<div class="form-row">
		<div class="col-12" style="display: none; opacity: 1;" data-section="ATENCIÓN_A_CLIENTES,RECURSOS_HUMANOS,VENTAS,PROVEEDORES,OTROS">
			<textarea name="contact-message" id="contact-message" class="form-control text-left" placeholder="<?php echo $contact->form->message ?>" rows="3"></textarea>
		</div>
	</div>
	<button type="submit" class="btn btn-blue-hard mt-3" id="contact-submit" style="display: none; opacity: 1;"><?php echo $contact->submit; ?></button>
</form>
