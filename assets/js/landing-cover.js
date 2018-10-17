$(document).ready(function() {
	$(".play-container").click(function(e) {

		if( $(this).hasClass("bg-thumbnail") )
			$(this).removeClass("bg-thumbnail");

		$(".play-ico").fadeOut(300);
		$(".custom-thumbnail").fadeOut(300).removeClass("d-block").addClass("d-none");
		$(".embed-responsive.d-none").removeClass("d-none");

		var iframe_src = $("#emb-iframe").attr("src");
		iframe_src += "?rel=0&autoplay=1";
		$("#emb-iframe").removeAttr("src").attr("src",iframe_src);
	});
});