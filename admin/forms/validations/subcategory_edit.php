<script>
	$(function(){
		$("#form-validation").formValidation({
			locale: "es_ES",
			fields: {
				name: {
					validators: {
						notEmpty: {},
						stringLength: {
							min: 3,
							max: 255
						}
					}
				}
			}
		});
	});
</script>
