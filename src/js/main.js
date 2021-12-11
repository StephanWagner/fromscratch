import jQuery from 'jquery';
window.$ = window.jQuery = jQuery;

// Document is ready

jQuery(function () {
  // Append scroll check events
  jQuery(window).on('resize', function () {
    checkScroll();
  });

  jQuery(window).on('scroll', function () {
    checkScroll();
  });
  checkScroll();
});

// Check for scrolling position

function checkScroll() {
  console.log(1);
  var activateMinimizedNav = 20;

  if (jQuery(window).scrollTop() > activateMinimizedNav) {
    jQuery('body').addClass('nav-fixed');
    return;
  }

  jQuery('body').removeClass('nav-fixed');
}

// Toggle menu

function toggleMenu() {
  jQuery('body').toggleClass('menu-open');
}

function closeMenu() {
  jQuery('body').removeClass('menu-open');
}
