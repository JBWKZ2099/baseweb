$(document).ready(function() {
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
});