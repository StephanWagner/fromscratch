import $ from 'jquery';
import inViewport from 'in-viewport';

$(function () {
  $.each($('[data-animation]'), function (index, el) {
    // Delay
    // let delay = 0;
    // if ($(window).width() > 900) {
    //   delay = (index % 3) * 160;
    // } else if ($(window).width() > 600) {
    //   delay = (index % 2) * 160;
    // }

    // $(el).css('--animation-delay', `${delay}ms`);

    inViewport(el, { offset: 0 }, function () {
      $(el).attr('data-animation-active', '');
    });
  });
});
