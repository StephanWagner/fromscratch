import $ from 'jquery';

// Utils
import '../utils/animations';

// Main
import './menu';
import './scrolled';

// Blocks
import '../blocks/all-blocks';

// Page init
$(function () {
  setTimeout(function () {
    $('body').addClass('-init');
  }, 64);
});
