import { onEnterViewport } from './viewport';

document.addEventListener('DOMContentLoaded', () => {
  onEnterViewport('[data-animation]', (el) => {
    // Delay
    // let delay = 0;
    // if ($(window).width() > 900) {
    //   delay = (index % 3) * 160;
    // } else if ($(window).width() > 600) {
    //   delay = (index % 2) * 160;
    // }

    // $(el).css('--animation-delay', `${delay}ms`);

    el.setAttribute('data-animation-active', '');
  });
});
