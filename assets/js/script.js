$(document).ready(function() {
	$("#parallax-navbar > li > a").click(function(e){
		if( $(this).attr("data-target")!="no-parallax" ) {
			e.preventDefault();
			var which = $(this).attr("data-target");
			$("#parallax-navbar > li").removeClass("active");
			$(this).parent().addClass("active");
			$("html, body").animate({
				scrollTop: $(which).offset().top-70
			},800);
		}
	});

	$(".btn-animated").mousemove(function(e){
		x=e.offsetX;
		y=e.offsetY;

		$(this).css({"--x": x+"px","--y": y+"px"});
	});


	$("#contact-section").change(function(e) {
		var section = $(this).val();
		e.stopImmediatePropagation();
		$("[data-section] > input").removeAttr("required","");
		$("[data-section] > select").removeAttr("required","");
		$("[data-section] > textarea").removeAttr("required","");
		$("[data-subsection] > input").removeAttr("required","");

		var providers_opt = "PROVEEDORES";
		var supplier_atention = "ATENCIÓN_A_CLIENTES";
		var hr = "RECURSOS_HUMANOS";
		var sales = "VENTAS";
		var other = "OTROS";

		if( $(this).val()==sales ) {
			$(".form-row:nth-child(5)").addClass("row");
		} else {
			$(".form-row:nth-child(5)").removeClass("row");
		}


		if( $(this).val()==providers_opt || $(this).val()==supplier_atention || $(this).val()==hr || $(this).val()==other ) {
			$("input[name='contact-company']").parent().removeClass("col-sm-6")
		} else {
			if( !$("input[name='contact-company']").parent().hasClass("col-sm-6") ) {
				$("input[name='contact-company']").parent().addClass("col-sm-6");
			}
		}

		// console.log()
		// if( !$("#contact-submit").is(":visible") )
		$("#contact-submit").show();
		$(".form-row.row").show();
		$("[data-section]").hide();
		$("[data-section*="+section+"]").show();
		$("[data-subsection]").hide();
		$("[data-section*="+section+"] > input").attr("required","");
		$("[data-section*="+section+"] > select").attr("required","");
		$("[data-section*="+section+"] > textarea").attr("required","");

		// $(".form-row.row, #contact-submit").stop().fadeIn(function() {
		// 	$("[data-section]").stop().fadeOut(function() {
		// 		$("[data-section*="+section+"]").stop().fadeIn();
		// 		$("[data-subsection]").fadeOut();
		// 		$("[data-section*="+section+"] > input").attr("required","");
		// 		$("[data-section*="+section+"] > select").attr("required","");
		// 		$("[data-section*="+section+"] > textarea").attr("required","");
		// 	});
		// });

	});
});
