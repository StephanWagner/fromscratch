import $ from 'jquery';
import { scrollToElement, getOffset } from '../utils/scroll-to-element';

$(function () {
  $('.accordion__header').on('click', function () {
    var wrapper = $(this).parents('.accordion__wrapper');
    var accordionIsOpen = wrapper.hasClass('-accordion-open');
    if (accordionIsOpen) {
      closeAccordion(wrapper);
      return;
    }
    if (wrapper.is('[data-close-other-accordions]')) {
      closeAccordion($('.accordion__wrapper.-accordion-open'));
    }
    openAccordion(wrapper);
  });

  $('.accordion__wrapper').each(function (index, item) {
    if (!$(item).next().hasClass('accordion__wrapper')) {
      $(item).addClass('-last');
    }
    if (!$(item).prev().hasClass('accordion__wrapper')) {
      $(item).addClass('-first');
    }
  });
});

function openAccordion(wrapper) {
  wrapper.addClass('-accordion-open');
  wrapper.find('.accordion__content').slideDown({
    duration: 250,
    complete: function () {
      if (wrapper.is('[data-scroll-to-accordion-top]')) {
        scrollToElement(wrapper, getOffset() + 8, true);
      }
    }
  });
}

function closeAccordion(wrapper) {
  wrapper.removeClass('-accordion-open');
  wrapper.find('.accordion__content').slideUp({
    duration: 250
  });
}
