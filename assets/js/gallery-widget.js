$(document).ready(function() {
	$("[data-deploy='modal']").click(function(e){
		var which = $(this).attr("src");
		var target = $(this).attr("data-id");

		$("#gallery-preview").removeAttr("src").attr("src",which);
		$("#gallery-preview").attr("data-current",target);
		$("#gallery-preview-modal").modal("show");

		if( parseInt(target)==1 ) {
			$("[data-prev]").attr("data-prev",parseInt($("[data-max]").attr("data-max")));
			$("[data-next]").attr("data-next",parseInt(target)+1);
		} else if( parseInt(target)==parseInt($("[data-max]").attr("data-max")) ) {
			$("[data-prev]").attr("data-prev",parseInt(target)-1);
			$("[data-next]").attr("data-next",1);
		} else if( parseInt(target)>=1 && parseInt(target)<=parseInt($("[data-max]").attr("data-max")) ) {
			$("[data-prev]").attr("data-prev",parseInt(target)-1);
			$("[data-next]").attr("data-next",parseInt(target)+1);
		}
	});

	$("[data-dir]").click(function(e){
		var which = $(this).attr("data-dir");
		var data_max = $("[data-max]").attr("data-max");

		if( which=="left" ) {
			var value = $(this).attr("data-prev");
			var target = $("[data-id='"+value+"']").attr("src");
			var prev = parseInt($("[data-id='"+value+"']").attr("data-id"))-1;
			console.log("value: "+value)
			console.log("target: "+target)
			console.log("prev: "+prev)
			$("#gallery-preview").removeAttr("src").attr("src",target);

			if( prev>=1 ) {
				$(this).attr("data-prev",prev);

				var validate = parseInt(value)+1;

				if( validate>data_max )
					$("[data-next]").attr("data-next",1);
				else
					$("[data-next]").attr("data-next",validate);
			} else {
				var validate = parseInt(value)+1;
				$("[data-next]").attr("data-next",validate);
				$(this).attr("data-prev",parseInt($("[data-max]").attr("data-max")));
			}

		} else {
			var value = $(this).attr("data-next");
			var target = $("[data-id='"+value+"']").attr("src");
			var next = parseInt($("[data-id='"+value+"']").attr("data-id"))+1;
			$("#gallery-preview").removeAttr("src").attr("src",target);

			if( next<=parseInt($("[data-max]").attr("data-max")) ) {
				$(this).attr("data-next",next);

				var validate = parseInt(value)-1;

				console.log( validate )

				if( validate==0 )
					$("[data-prev]").attr("data-prev",data_max);
				else
					$("[data-prev]").attr("data-prev",validate);
			} else {
				var validate = parseInt(value)-1;
				$("[data-prev]").attr("data-prev",validate);
				$(this).attr("data-next",1);
			}
		}
	});
});