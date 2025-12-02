import $ from 'jquery';
import inViewport from 'in-viewport';
import { CountUp } from 'countup.js';

const containerSelector = '.number-ticker__wrapper';

$(function () {
  var tickerContainer = $(containerSelector);
  if (tickerContainer.length) {
    inViewport(tickerContainer[0], { offset: -48 }, function () {
      $.each($(containerSelector + ' [data-countup]'), function (index, el) {
        var startNumber = $(el).html();
        var targetNumber = $(el).attr('data-countup');
        var numAnim = new CountUp(el, targetNumber, {
          startVal: startNumber,
          separator: '',
          decimalPlaces: 0,
          duration: 3
        });
        numAnim.start();
      });
    });
  }
});
