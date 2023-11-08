/* Navigation Javascript */

// Toggle Hamburger Menu
function burgerToggle($element) {
	$($element).toggleClass("is-active");
	$("body").toggleClass("noscroll");

	// Slide in from right
	$("#nav").toggle("slide", { direction: "right" }, 400);

	//Close all open submenus
	$(".submenu").removeClass("menuSlideIn");

	// Refocus Main Menu
	$(".dropdown-menu > li > a").removeClass("deFocus");
}

// Add has-submenu class to parents
$(".submenu").parent("li").addClass("has-submenu");

// Add back buttons to submenus
$(".submenu").prepend("<li class=\"back\"><a>Back</a></li>");

// Mobile Slide Menu / Desktop Dropdown
$(".has-submenu > a").click(function(e) {

	// Toggle open class on menu with submenu
	$(this).toggleClass("open");

	$currentElement = $(this).closest(".has-submenu").children(".submenu");

	// Close sub-menus when clicking anywhere but the menu
	$(document).click(function(){
		$(".has-submenu > a").removeClass("open");
		$(".submenu").removeClass("menu-popIn");
	});

	// Stop body click from running
	e.stopPropagation();

	// Close open menus
	$(".has-submenu > a").not(this).removeClass("open");
	$(".submenu").not($currentElement).removeClass("menu-popIn");

	// Defocus Main Menu
	$(".dropdown-menu > li > a").addClass("deFocus");

	$(this).closest(".has-submenu").children(".submenu").toggleClass("menuSlideIn");
	$(this).closest(".has-submenu").children(".submenu").toggleClass("menu-popIn");
});

$(".submenu").click(function(e){
	// Stop body click from running
	e.stopPropagation();
});

// Back Button - Close Menu
$(".submenu > .back").click(function() {
	// Refocus Main Menu
	$(".dropdown-menu > li > a").removeClass("deFocus");

	$(".submenu").removeClass("menuSlideIn");
});