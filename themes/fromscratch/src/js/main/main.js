// Utils
import '../utils/animations';

// Main
import './menu';
import './scrolled';

// Blocks
import '../blocks/all-blocks';

// Page init
document.addEventListener('DOMContentLoaded', () => {
  setTimeout(function () {
    document.body.classList.add('-init');
  }, 64);
});
