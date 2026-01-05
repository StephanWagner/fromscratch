// import $ from 'jquery';

// // Scroll to element

// export function scrollToElement(element, offset, triggerComplete) {
//   let scrollTop = $(element).offset().top;
//   scrollTop = scrollTop + (offset || 0);

//   $('html, body').animate(
//     { scrollTop: scrollTop },
//     {
//       duration: 400,
//       queue: false,
//       complete: function () {
//         if (triggerComplete) {
//           let scrollTop = $(element).offset().top;
//           scrollTop = scrollTop + (offset || 0);
//           window.scrollTo(0, scrollTop);
//         }
//       }
//     }
//   );
// }

// // Get offset

// export function getOffset() {
//   let offset = config.defaultScrollOffset * -1;

//   offset -= config.scrolledHeaderHeight;

//   if ($('#wpadminbar').length) {
//     offset -= $('#wpadminbar').outerHeight();
//   }

//   return offset;
// }
