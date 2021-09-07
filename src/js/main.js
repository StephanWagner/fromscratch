// Store app data in global var

var app = {};

// Document is ready

$(function () {

  // Append scroll check events
  $(window).on('resize', function () {
    checkScrollToTop();
    checkScroll();
  });
  checkScrollToTop();

  $(window).on('scroll', function () {
    checkScroll();
  });
  checkScroll();

});

// Scrolling

function scrollToTop() {
  $('html, body').animate({ scrollTop: 0 }, 800);
}

function scrollToContentElement(targetElement, duration) {
  var top = targetElement.offset().top;
  var scrollTop = getScrollTopWithOffset(top);
  $('html, body').animate(
    { scrollTop: scrollTop },
    {
      duration: duration || 800,
      complete: function () {
        if (targetElement.offset().top != top) {
          $('html, body').scrollTop(
            getScrollTopWithOffset(targetElement.offset().top)
          );
        }
      }
    }
  );
}

function getScrollTopWithOffset(top) {
  var anchorLinkOffset = 72 + 8;
  if ($(window).width() <= 600) {
    anchorLinkOffset = 60 + 8;
  }
  return top - anchorLinkOffset;
}

// Check for scrolling availability

function checkScrollToTop() {
  if ($('body').height() - 120 <= $(window).height()) {
    $('body').addClass('no-scroll');
  } else {
    $('body').removeClass('no-scroll');
  }
}

// Check for scrolling position

function checkScroll() {
  var targetElement = $('.main-menu__placeholder');

  if (!targetElement.length) {
    return;
  }

  var top = targetElement.offset().top;

  if ($(window).scrollTop() >= top) {
    $('body').addClass('nav-fixed');
  } else {
    $('body').removeClass('nav-fixed');
  }
}

// Toggle menu

function toggleMenu() {
  $('body').toggleClass('menu-open');
}

function closeMenu() {
  $('body').removeClass('menu-open');
}
