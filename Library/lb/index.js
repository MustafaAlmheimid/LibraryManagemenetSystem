

//Scroll-to -top
let mybutton = document.getElementById("myBtn");
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}




// for Typed JS functionality

var typed = new Typed('.typed-animation', {
  strings: [
    'Fun',
    'Easy',
    'Interactive',
    'For Us'
  ],
  typeSpeed: 150,
  backSpeed: 100,
  loop: true,
  loopCount: Infinity,
  // smartBackspace: true,
  });
