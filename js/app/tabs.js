// Tabs Javascript

// Open first item
$(".tabs-content .tabs-panel:first-of-type").addClass("open");
$(".tabs li:first-of-type a").addClass("active");

// Open corresponding tab on click
$(".tabs > li > a").click(function(e) {
	e.preventDefault();

	// Get ID
	$element = $(this).attr('href');

	// Close other tabs
	$(this).closest(".tabs").find("li a").not(this).removeClass("active");
	$($element).closest(".tabs-content").find(".tabs-panel").not($element).removeClass("open");

	// Open corresponding tab
	$(this).addClass("active");
	$($element).addClass("open");
});

