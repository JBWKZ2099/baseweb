$("#confirm_password").change(function(e){
	var pswd = $("#password").val();
	var conf = $(this).val();

	if( pswd!=conf ) {
		$("#my-alert").addClass("alert-warning");
		$("#alert-text").text("La contraseña no coincide");
		$("#my-alert").fadeIn(500);
		$("#contact-submit").attr("disabled","");
	} else {
		$("#dismiss-my-alert").click();
	}
});
$("#password").change(function(e){
	var pswd = $("#confirm_password").val();
	var conf = $(this).val();

	if( pswd!=conf ) {
		$("#my-alert").addClass("alert-warning");
		$("#alert-text").text("La contraseña no coincide");
		$("#my-alert").fadeIn(500);
		$("#contact-submit").attr("disabled","");
	} else {
		$("#dismiss-my-alert").click();
	}
});

/*E-Mail only*/
$("#email").change(function(e) {
	var is_email = validateEmail( $(this).val() );

	if( !is_email ) {
		$("#my-alert").addClass("alert-warning");
		$("#alert-text").text("Introduzca un email válido.");
		$("#my-alert").fadeIn(500);
	} else {
		$("#my-alert").removeClass("alert-warning");
		$("#alert-text").text("");
		$("#my-alert").fadeOut(500);
	}
});

$("#users-form").on("submit", function(e){
	var is_email = validateEmail( $("#email").val() );
	var confirm_password = $("#confirm_password").val();
	var password = $("#password").val();
	var message = "<ul>";
	var _errors = 0;

	$("#dismiss-my-alert").click();

	if( confirm_password!=password ) {
		_errors++;
		message+="<li>Las contraseñas no coinciden.</li>";
	}

	if( !is_email ) {
		_errors++;
		message+="<li>Introduzca un email válido.</li>";
	}

	if( _errors==0 ) {
		$("#users-form").submit();
	} else {
		e.preventDefault();
		$("#my-alert").addClass("alert-warning");
		$("#alert-text").append(message);
		$("#my-alert").fadeIn(500);
		$("#contact-submit").attr("disabled");
	}
});

function validateEmail(email) {
	var email_pattern = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/,
			is_email = email_pattern.test(email);

	return is_email;
}
/*E-Mail only*/

$("#permission_superadmin").click(function(e){
	if( !$("#permissions-container").is(":visible") )
		$("#permissions-container").show(500);
	else
		$("#permissions-container").hide(500);
});

if( $("#permission_superadmin").prop("checked") )
	$("#permissions-container").hide(500);
else
	$("#permissions-container").show(500);


$("#dismiss-my-alert").click(function(e) {
	$("#my-alert").fadeOut(500);
	$("#my-alert").removeClass("alert-success");
	$("#my-alert").removeClass("alert-danger");
	$("#my-alert").removeClass("alert-warning");
	$("#alert-text").text("");
});