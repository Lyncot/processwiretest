// Reveal modal window

//On Load

$(".reveal").wrap("<div class=\"reveal-overlay\"></div>");
$(".reveal").prepend("<button type=\"button\" class=\"reveal-close\"><i class=\"far fa-times\"></i></button>");

// On click function to open reveal
function reveal($id) {
	$("#" + $id).closest(".reveal-overlay").fadeIn();
}

// Reveal close button
$(".reveal-close").click(function(e) {
	$(this).closest(".reveal-overlay").fadeOut();
});

// Overlay background close
$(".reveal-overlay").click(function(e) {
	if ($(e.target).is(this)) {
		$(this).fadeOut();
	}
});