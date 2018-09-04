$(document).ready(function() {
	$("#search-btn").click(function(event) {
		$.ajax({
			url: "php/blog/search.php",
			type: "POST",
			dataType: "html",
			data: { search: $("#search").val() },
			success: function( response ) {
				console.log(response);
				if( response ) {
					var container = $("#blogs-container");
					var pagination = $("#section-paginate");
					// console.log( response );
					container.empty();
					container.append(response);
					pagination.empty();
				}/*End if response*/
			}
		});
	});
});