// Store app data in global var

var app = {};

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

// Toggle menu

function toggleMenu() {
  $('body').toggleClass('menu-open');
}

function closeMenu() {
  $('body').removeClass('menu-open');
}
