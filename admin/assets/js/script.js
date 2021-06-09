// Funcionalidad por si se quiere el menu oculto cuando cargue el admin
// $(window).on("load", function(){
// 	ws = $(window).width();
// 	pedro = 0;
// 	$(".navbar-sidenav > .nav-item").each(function(i, el){
// 		if( $(el).hasClass("active") )
// 			pedro++;
// 	});

// 	if( pedro==0 && ws>767 )
// 		$("#sidenavToggler").trigger("click");
// });

$(document).ready(function() {
	$(".nav-link:not('#sidenavToggler')").click(function(e){
		if( $("body").hasClass("sidenav-toggled") )
			$("#sidenavToggler").click();
	});

	$("img.svg").each(function(){
	  var $img = jQuery(this);
	  var imgID = $img.attr('id');
	  var imgClass = $img.attr('class');
	  var imgURL = $img.attr('src');

	  jQuery.get(imgURL, function(data) {
	      // Get the SVG tag, ignore the rest
	      var $svg = jQuery(data).find('svg');

	      // Add replaced image's ID to the new SVG
	      if(typeof imgID !== 'undefined') {
	          $svg = $svg.attr('id', imgID);
	      }
	      // Add replaced image's classes to the new SVG
	      if(typeof imgClass !== 'undefined') {
	          $svg = $svg.attr('class', imgClass+' replaced-svg');
	      }

	      // Remove any invalid XML tags as per http://validator.w3.org
	      $svg = $svg.removeAttr('xmlns:a');

	      // Check if the viewport is set, if the viewport is not set the SVG wont't scale.
	      if(!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
	          $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
	      }

	      // Replace image with new SVG
	      $img.replaceWith($svg);

	  }, 'xml');
	});

	/*Alerts*/
		$("#close-alert").click(function(e) {
			$("#my-alert").fadeOut(300);
			$("#my-alert").removeClass("alert-success");
			$("#my-alert").removeClass("alert-danger");
			$("#my-alert").removeClass("alert-warning");
			$("#alert-text").text("");
		});
	/*Alerts*/

	// Toggle the side navigation
		$("#sidenavToggler").click(function(e) {
			e.preventDefault();
			$("body").toggleClass("sidenav-toggled");
			$(".navbar-sidenav .nav-link-collapse").addClass("collapsed");
			$(".navbar-sidenav .sidenav-second-level, .navbar-sidenav .sidenav-third-level").removeClass("show");
		});
		// Force the toggled class to be removed when a collapsible nav link is clicked
		// $(".navbar-sidenav .nav-link-collapse").click(function(e) {
		//   e.preventDefault();
		//   $("body").removeClass("sidenav-toggled");
		// });
		// Prevent the content wrapper from scrolling when the fixed side navigation hovered over
		$('body.fixed-nav .navbar-sidenav, body.fixed-nav .sidenav-toggler, body.fixed-nav .navbar-collapse').on('mousewheel DOMMouseScroll', function(e) {
		  var e0 = e.originalEvent,
		    delta = e0.wheelDelta || -e0.detail;
		  this.scrollTop += (delta < 0 ? 1 : -1) * 30;
		  e.preventDefault();
		});
		// Scroll to top button appear
		$(document).scroll(function() {
		  var scrollDistance = $(this).scrollTop();
		  if (scrollDistance > 100) {
		    $('.scroll-to-top').fadeIn();
		  } else {
		    $('.scroll-to-top').fadeOut();
		  }
		});
		// Configure tooltips globally
		// Smooth scrolling using jQuery easing
		$(document).on('click', 'a.scroll-to-top', function(event) {
		  var $anchor = $(this);
		  $('html, body').stop().animate({
		    scrollTop: ($($anchor.attr('href')).offset().top)
		  }, 1000, 'easeInOutExpo');
		  event.preventDefault();
		});
});