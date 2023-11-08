// On Scroll Animation System - v1.04
function scrollAnimate($elements) {
	$(window).scroll(function() {
		var winHeight = $(this).height();
		var scrollTop = $(this).scrollTop();

		// Get 10% of window height
		$offsetAmount = ($(window).height() * 0.1);

		// Loop through all animation types in array
		for ($i = 0; $i < $elements.length; $i++) {
			$element = $elements[$i];

			if ($($element['element']).length) {

				// Loop through all elements with animation classes
				$($element['element']).each(function() {
					var elemHeight = $(this).height();
					var elementTop = $(this).position().top;

					// Move Scroll Top
					elementTop = (elementTop + $offsetAmount);
					     
					if (elementTop < scrollTop + winHeight && scrollTop < elementTop + elemHeight) {
					    $(this).addClass("anim-go");
					} else {
						$(this).removeClass("anim-go");
					}
				});
			}
		}
	});
}

// Declare classes and animation classes
$scrollAnimations = [
	{element:".anim-fadeIn"},
	{element:".anim-slideIn"},
	{element:".anim-slideIn_top"},
	{element:".anim-flipIn"},
	{element:".anim-swingIn_left"},
	{element:".anim-trackIn"},
	{element:".anim-flyIn"},
	{element:".anim-swirlIn"},
	{element:".anim-colourise"}
];

scrollAnimate($scrollAnimations);
$(window).scroll();