import $ from 'jquery';

$(function () {
  $(window).on('scroll resize', function () {
    checkScroll();
  });
  checkScroll();
});

// Check for scrolling position

function checkScroll() {
  var startFixedNav = 120;

  if ($(window).scrollTop() >= startFixedNav) {
    $('body').addClass('nav-fixed');
  } else {
    $('body').removeClass('nav-fixed');
  }
}
