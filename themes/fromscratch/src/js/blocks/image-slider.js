import Swiper from 'swiper';
import { Pagination, Navigation, Autoplay } from 'swiper/modules';

document.addEventListener('DOMContentLoaded', () => {
  new Swiper('.image-slider__wrapper .swiper', {
    modules: [Pagination, Navigation, Autoplay],
    loop: true,
    spaceBetween: 16,
    speed: 600,
    pagination: {
      el: '.image-slider__navigation .swiper-pagination',
      clickable: true
    },
    navigation: {
      nextEl: '.image-slider__navigation .swiper-button-next',
      prevEl: '.image-slider__navigation .swiper-button-prev'
    },
    autoplay: {
      delay: 6000,
      disableOnInteraction: true,
      pauseOnMouseEnter: false
    }
  });
});
