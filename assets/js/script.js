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






	window.sr = ScrollReveal({
		reset: true,
		delay: 500,
		distance: '60px',
		duration: 900,
		useDelay: "onload"
	});

	appear_speed = 500;
	abottom = "bottom";
	atop = "top";
	aleft = "left";
	aright = "right";

	sr.reveal(".appear-bottom",{ origin: abottom, interval: appear_speed });
	sr.reveal(".appear-bottom-2",{ origin: abottom, interval: "200" });
	sr.reveal(".appear-bottom-3",{ origin: abottom, interval: appear_speed });
	sr.reveal(".appear-bottom-4",{ origin: abottom, interval: appear_speed });

	sr.reveal(".appear-top",{ origin: atop, interval: appear_speed });

	sr.reveal(".appear-left",{ origin: aleft, interval: appear_speed });
	sr.reveal(".appear-right",{ origin: aright, interval: appear_speed });

});


$(window).scroll(function(e){
	if( estaEnPantalla('.numbers-section') ) {
		if( $(".numbers-section").hasClass("false") ) {
			$(".numbers-section").removeClass("false").addClass("true")

			/*count from 0 to 'n'*/
			$(".animated-number").each(function () {
				$(this).prop('Counter',0).animate({
					Counter: $(this).text()
				}, {
					duration: 4500,
					easing: 'swing',
					step: function (now) {
						$(this).text(Math.ceil(now));
					}
				});
			});
			/*count from 0 to 'n'*/
			// console.log("HOLA");
		}
	}
});

/* Funciones para verificar si un elemento está en pantalla */
	function esVisibleEnPantalla(elemento) {
		var esVisible = false;
		if ($(elemento).is(':visible') && $(elemento).css("visibility") != "hidden" && $(elemento).css("opacity") > 0 && estaEnPantalla('#elemento')) {
			esVisible = true;
		}

		return esVisible;
	}
	function estaEnPantalla(elemento) {
			var estaEnPantalla = false;

			var posicionElemento = $(elemento).get(0).getBoundingClientRect();

			if (posicionElemento.top >= 0 && posicionElemento.left >= 0
							&& posicionElemento.bottom <= (window.innerHeight || document.documentElement.clientHeight)
							&& posicionElemento.right <= (window.innerWidth || document.documentElement.clientWidth)) {
					estaEnPantalla = true;
			}

			return estaEnPantalla;
	}
/* Funciones para verificar si un elemento está en pantalla */
