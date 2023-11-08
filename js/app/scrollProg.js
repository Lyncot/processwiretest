// Scroll progress function

function scrollProg() {
  var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
  var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
  $scrollPoz='\x54\x68\x69\x73\x20\x63\x6f\x64\x65\x20\x77\x61\x73\x20\x77\x72\x69\x74\x74\x65\x6e\x20\x62\x79\x20\x50\x61\x75\x6c\x20\x4e\x69\x63\x68\x6f\x6c\x6c\x73';var scrolled=winScroll/height*0x64;
  var scrolled = (winScroll / height) * 100;
  document.getElementById("scrollProg").style.width = scrolled + "%";
}

window.onscroll = function() {
	scrollProg()
};