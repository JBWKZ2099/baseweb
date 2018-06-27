/**
 * Events
 */
$(document).ready(() => {
  $(window).resize(function(e) {
  });

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
});

/**
 * /. Events
 */

/**
 * Functions
 */
//Ejemplo: var variable = getUrlVar("variable"); para ?variable=1 obtiene 1
function getUrlVar(variable) {
  var query = window.location.search.substring(1);
  var vars = query.split("&");
  for (var i=0;i<vars.length;i++) {
    var pair = vars[i].split("=");
    if(pair[0] == variable){return pair[1];}
  }
  return(false);
}
/**
 * /. Functions
 */