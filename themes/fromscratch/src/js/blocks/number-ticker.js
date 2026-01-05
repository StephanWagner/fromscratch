// import $ from 'jquery';
// import { onEnterViewport } from '../utils/viewport';
// import { CountUp } from 'countup.js';

// const containerSelector = '.number-ticker__wrapper';

// document.addEventListener('DOMContentLoaded', () => {
//   var tickerContainer = $(containerSelector);
//   if (tickerContainer.length) {
//     onEnterViewport(containerSelector, (el) => {
//       $.each($(containerSelector + ' [data-countup]'), function (index, el) {
//         var startNumber = $(el).html();
//         var targetNumber = $(el).attr('data-countup');
//         var numAnim = new CountUp(el, targetNumber, {
//           startVal: startNumber,
//           separator: '',
//           decimalPlaces: 0,
//           duration: 3
//         });
//         numAnim.start();
//       });
//     });
//   }
// });
