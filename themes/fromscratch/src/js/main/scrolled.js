import $ from 'jquery';
import config from '../config';

$(function () {
  $(window).on('scroll resize', function () {
    checkScroll();
  });
  checkScroll();
});

// Check for scrolling position

function checkScroll() {
  const startFixedNav = config.startScrolledNav;

  if ($(window).scrollTop() >= startFixedNav) {
    $('body').addClass('-scrolled');
  } else {
    $('body').removeClass('-scrolled');
  }
}
