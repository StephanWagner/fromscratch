import $ from 'jquery';

function toggleMenu() {
  if (menuIsOpen()) {
    closeMenu();
  } else {
    openMenu();
  }
}

function openMenu() {
  $('body').addClass('menu-open');
  $('body').addClass('block-scroll');
  //$('.header__menu-overlay').fadeIn(250);
}

function closeMenu() {
  $('body').removeClass('menu-open');
  $('body').removeClass('block-scroll');
  //$('.header__menu-overlay').fadeOut(250);
}

function menuIsOpen() {
  return $('body').hasClass('menu-open');
}

var windowWidth;

$(function () {
  $('[data-toggle-menu]').on('click', toggleMenu);

  windowWidth = $(window).width();

  $(window).on('resize', function () {
    if ($(window).width() != windowWidth) {
      windowWidth = $(window).width();
      closeMenu();
    }
  });
});
