//Change header class on scroll
$(window).scroll(function(){
  var sticky = $('header'),
      scroll = $(window).scrollTop();

  if (scroll >= 50) {
  		sticky.addClass('fixHeader')
  } else {
   		sticky.removeClass('fixHeader');
  }
});