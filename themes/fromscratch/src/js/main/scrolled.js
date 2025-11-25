import $ from 'jquery';

$(function () {
  $(window).on('scroll resize', function () {
    checkScroll();
  });
  checkScroll();
});

// Check for scrolling position

function checkScroll() {
  var startFixedNav = 64;

  if ($(window).scrollTop() >= startFixedNav) {
    $('body').addClass('-scrolled');
  } else {
    $('body').removeClass('-scrolled');
  }
}
