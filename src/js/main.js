import jQuery from 'jquery';
window.$ = window.jQuery = jQuery;

// Document is ready

$(function () {
  // Append scroll check events
  $(window).on('resize', function () {
    checkScroll();
  });

  $(window).on('scroll', function () {
    checkScroll();
  });
  checkScroll();

  // Append navigation events
  $('.header-menu__toggler-container').on('click', function () {
    $('body').toggleClass('menu-open');
  });
});

// Check for scrolling position

function checkScroll() {
  var activateMinimizedNav = 120;

  if ($(window).scrollTop() > activateMinimizedNav) {
    $('body').addClass('nav-fixed');
    return;
  }

  $('body').removeClass('nav-fixed');
}
