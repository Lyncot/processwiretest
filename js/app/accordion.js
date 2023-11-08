// Accordion Javascript

// Hide Nested Elements
//$(".accordion .nested").hide();

// Open first item
$(".accordion.linked li:first-of-type .nested").addClass("open");
$(".accordion.linked li:first-of-type > a").addClass("active");

// All open
$(".accordion.all-open li .nested").show();
$(".accordion.all-open li .nested").addClass("active");

// Open menu on click
$(".accordion > li > a").click(function(e) {

	// Close all linked menus
	$(this).closest(".accordion.linked").find(".nested").slideUp("fast");
	$(this).closest(".accordion.linked").find("a").not(this).removeClass("active");

	if ($(this).hasClass("active")) {
		$(this).removeClass("active");
		$(this).closest("li").children(".nested").slideUp("fast");
	} else {
		// Open clicked menu
		$(this).addClass("active");
		$(this).closest("li").children(".nested").slideToggle("fast");
	}
});