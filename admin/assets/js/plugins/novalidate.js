(function() {
	"use strict";
	window.addEventListener("load", function() {
		var form = document.getElementById("needs-validation");
		form.addEventListener("submit", function(event) {
			if (form.checkValidity() == false) {
				event.preventDefault();
				event.stopPropagation();
			}
			form.classList.add("was-validated");
			validateFields();
		}, false);
	}, false);
}());

function validateFields() {
	$("#needs-validation .form-group [required]").each(function(index, el) {
		var other_parent = $(this).parent().attr("other-parent");

		if( $(this).is(":valid") ){
			$(this).removeClass("is-invalid").addClass("is-valid");
			
			/**
			 * If para cuando hay un input date o cualquier otro input que no contenga
			 * como hermano a .invalid-feedback
			 */
			if( other_parent ) {
				$("[required].is-valid").parent().parent().addClass("validated");
	      if( $(this).hasClass("is-valid") ) {
	        $(this).parent().parent().find(".invalid-feedback").removeClass("d-block");
	        $(this).parent().parent().removeClass("no-valid");
	      }
			} else {
				$("[required].is-valid").parent().addClass("validated");
	      if( $(this).hasClass("is-valid") ) {
	        $(this).parent().find(".invalid-feedback").addClass("d-none");
	        $(this).parent().removeClass("no-valid");
	      }
			}/*Fin If Else*/
		} else {
			$(this).removeClass("is-valid").addClass("is-invalid");

			/**
			 * If para cuando hay un input date o cualquier otro input que no contenga
			 * como hermano a .invalid-feedback
			 */
			if( other_parent ) {
				$("[required].is-invalid").parent().parent().addClass("no-valid");	
				if( $(this).hasClass("is-invalid") ) {
	        $(this).parent().parent().find(".invalid-feedback").addClass("d-block");
	        $(this).parent().parent().removeClass("validated");
	      }
			} else {
      	$("[required].is-invalid").parent().addClass("no-valid");
	      if( $(this).hasClass("is-invalid") ) {
	        $(this).parent().find(".invalid-feedback").removeClass("d-none");
	        $(this).parent().removeClass("validated");
	      }
			}/*Fin If Else*/
		}/*Fin If Else*/
	});
}