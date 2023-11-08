// TrackyNav Javascript

function trackyNav() {
	$(window).scroll(function() {
		var scrollTop = $(this).scrollTop();

		// Get 10% of window height
		$offsetAmount = ($(window).height() * 0.1);

		// Check each nav element
		$(".trackynav > li > a").each(function(e){
			$target = $(this).attr("href");

			// Get the element position plus the offset
			$elementTop = ($($target).position().top - $offsetAmount);

			if (scrollTop >= $elementTop) {
				$(".trackynav > li > a").removeClass("active");
				$(this).addClass("active");
			} else {
				$(this).removeClass("active");
			}
		});
	});
}

trackyNav();