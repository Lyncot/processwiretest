$(document).ready(function(){
	$('.carousel').slick({
	    infinite: true,
	    speed: 3500,
	    cssEase: 'ease-in-out',
	    slidesToShow: 4,
	    slidesToScroll: 1,
	    autoplay: true,
	    autoplaySpeed: 0,
	    draggable: false,
	    arrows: false,
   		// prevArrow: '<button type="button" class="vcent slick-prev"><i class="far fa-arrow-left"></i></button>',
    	// nextArrow: '<button type="button" class="vcent slick-next"><i class="far fa-arrow-right"></i></button>',
	    responsive: [
		      {
		        breakpoint: 1024,
		        settings: {
		          slidesToShow: 2,
		          slidesToScroll: 1,
		          infinite: true,
		          speed: 5000
		        }
		      },
		    ]
	    });
});