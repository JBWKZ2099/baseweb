<script>
	$(function(){
		fv = $("#form-validation").formValidation({
			locale: "es_ES",
			fields: {
				username: {
					validators: {
						notEmpty: {},
						stringLength: {
							min: 3,
							max: 255
						}
					}
				},
				password: {
					validators: {
						notEmpty: {},
						stringLength: {
							min: 6,
							max: 255
						}
					}
				}
			}
		});
	});
</script>
