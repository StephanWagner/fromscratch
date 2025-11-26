import $ from 'jquery';

export function toggleMenu() {
  if (menuIsOpen()) {
    closeMenu();
  } else {
    openMenu();
  }
}

export function openMenu() {
  $('body').addClass('menu-open');
  $('body').addClass('block-scroll');
  //$('.header__menu-overlay').fadeIn(250);
}

export function closeMenu() {
  $('body').removeClass('menu-open');
  $('body').removeClass('block-scroll');
  //$('.header__menu-overlay').fadeOut(250);
}

export function menuIsOpen() {
  return $('body').hasClass('menu-open');
}

$(function () {
  $('[data-toggle-menu]').on('click', toggleMenu);
});
