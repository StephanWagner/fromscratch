import { onEnterViewport } from '../utils/viewport';
import { CountUp } from 'countup.js';

const containerSelector = '.number-ticker__wrapper';

document.addEventListener('DOMContentLoaded', () => {
  const tickerContainer = document.querySelector(containerSelector);

  if (!tickerContainer) return;

  onEnterViewport(containerSelector, () => {
    const items = tickerContainer.querySelectorAll('[data-countup]');

    items.forEach((el) => {
      const startNumber = Number(el.textContent.trim()) || 0;
      const targetNumber = Number(el.getAttribute('data-countup'));

      const numAnim = new CountUp(el, targetNumber, {
        startVal: startNumber,
        separator: '',
        decimalPlaces: 0,
        duration: 3
      });

      if (!numAnim.error) {
        numAnim.start();
      } else {
        console.error(numAnim.error);
      }
    });
  });
});
