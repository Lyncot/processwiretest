$(document).ready(function(){
  $('.slideshow').slick({
    infinite: true,
    cssEase: 'linear',
    fade: true,
    speed: 3000,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2500,
    draggable: false,
    arrows: false
    // prevArrow: '<button type="button" class="vcent slick-prev"><i class="far fa-arrow-left"></i></button>',
    // nextArrow: '<button type="button" class="vcent slick-next"><i class="far fa-arrow-right"></i></button>'
  });
});