import { scrollToElement, getOffset } from '../utils/scroll-to-element';
import { closeMenu } from '../main/menu';
import config from '../config';

document.addEventListener('DOMContentLoaded', () => {
  const anchorItems = document.querySelectorAll('[data-anchor-id]');
  if (!anchorItems.length) return;

  // Handle anchor links
  document.querySelectorAll('a[href*="#"]').forEach((link) => {
    const href = link.getAttribute('href');
    if (!href || !href.includes('#')) return;

    const parts = href.split('#');
    const anchorId = parts[parts.length - 1];

    let targetEl = document.querySelector(
      `[data-anchor-id="${anchorId}"]`
    );

    if (!targetEl) return;

    if (targetEl.nextElementSibling) {
      targetEl = targetEl.nextElementSibling;
    }

    link.addEventListener('click', (e) => {
      e.preventDefault();

      closeMenu();

      const offset = getOffset(targetEl);
      scrollToElement(targetEl, offset, true);
    });
  });

  // Active navigation highlighting
  const checkActiveNav = () => {
    const windowTop = window.scrollY || document.documentElement.scrollTop;

    const reversedAnchors = Array.from(anchorItems).reverse();

    reversedAnchors.some((item) => {
      const id = item.getAttribute('data-anchor-id');

      let itemTop = item.getBoundingClientRect().top + windowTop;

      if (item.nextElementSibling) {
        itemTop =
          item.nextElementSibling.getBoundingClientRect().top + windowTop;
      }

      document
        .querySelectorAll('header .menu-item')
        .forEach((el) => el.classList.remove('-current-active'));

      let offset = config.defaultScrollOffset + 4;
      offset += config.scrolledHeaderHeight;

      const adminBar = document.getElementById('wpadminbar');
      if (adminBar) {
        offset += adminBar.offsetHeight;
      }

      if (windowTop >= 16 && windowTop > itemTop - offset) {
        document
          .querySelectorAll(`header .menu-item > a[href*="#${id}"]`)
          .forEach((link) => {
            link.closest('.menu-item')?.classList.add('-current-active');
          });

        return true;
      }

      return false;
    });
  };

  window.addEventListener('scroll', checkActiveNav);
  window.addEventListener('resize', checkActiveNav);

  checkActiveNav();
});

// Automatic scroll on load (hash)
window.addEventListener('load', () => {
  if (!window.location.hash) return;

  const hashId = window.location.hash.replace('#', '');
  const targetEl = document.querySelector(
    `[data-anchor-id="${hashId}"]`
  );

  if (!targetEl) return;

  const offset = getOffset(targetEl);
  scrollToElement(targetEl, offset, true);
});
