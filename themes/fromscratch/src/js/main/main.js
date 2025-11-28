import $ from 'jquery';

// Main
import './menu';
import './scrolled';

// Blocks
import '../blocks/anchor-link';

// Page init
$(function () {
  setTimeout(function () {
    $('body').addClass('-init');
  }, 64);
});
