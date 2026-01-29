import { scrollToElement, getOffset } from '../utils/scroll-to-element';

document.addEventListener('DOMContentLoaded', () => {

  document.querySelectorAll('.accordion__header').forEach((header) => {
    header.addEventListener('click', () => {
      const wrapper = header.closest('.accordion__wrapper');
      if (!wrapper) return;

      const isOpen = wrapper.classList.contains('-accordion-open');

      if (isOpen) {
        closeAccordion(wrapper);
        return;
      }

      if (wrapper.hasAttribute('data-close-other-accordions')) {
        document
          .querySelectorAll('.accordion__wrapper.-accordion-open')
          .forEach((openWrapper) => {
            if (openWrapper !== wrapper) {
              closeAccordion(openWrapper);
            }
          });
      }

      openAccordion(wrapper);
    });
  });

  const wrappers = document.querySelectorAll('.accordion__wrapper');

  wrappers.forEach((item, index) => {
    if (!wrappers[index + 1]) {
      item.classList.add('-last');
    }
    if (!wrappers[index - 1]) {
      item.classList.add('-first');
    }
  });
});

function openAccordion(wrapper) {
  const content = wrapper.querySelector('.accordion__content');
  if (!content) return;

  wrapper.classList.add('-accordion-open');
  slideDown(content, 250, () => {
    if (wrapper.hasAttribute('data-scroll-to-accordion-top')) {
      scrollToElement(wrapper, getOffset() + 8, true);
    }
  });
}

function closeAccordion(wrapper) {
  const content = wrapper.querySelector('.accordion__content');
  if (!content) return;

  wrapper.classList.remove('-accordion-open');
  slideUp(content, 250);
}
