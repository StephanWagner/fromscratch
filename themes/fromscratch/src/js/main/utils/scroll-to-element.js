import $ from 'jquery';

// Scroll to element

export function scrollToElement(element, offset, triggerComplete) {
  let scrollTop = getScrollTopOfElement(element);
  scrollTop = scrollTop + (offset || 0);

  $('html, body').animate(
    { scrollTop: scrollTop },
    {
      duration: 400,
      queue: false,
      complete: function () {
        if (triggerComplete) {
          var scrollTop = getScrollTopOfElement(element);
          window.scrollTo(0, scrollTop);
        }
      }
    }
  );
}

function getScrollTopOfElement(element) {
  return $(element).offset().top;
}
