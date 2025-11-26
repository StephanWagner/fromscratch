import $ from 'jquery';

import './menu';
import './scrolled';

$(function () {
  setTimeout(function () {
    $('body').addClass('-init');
  }, 64);
});
