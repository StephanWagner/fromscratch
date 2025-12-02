<?php
$images = block_value('images');
?>

<?php if (ecb_admin()) { ?>
  <div class="admin-block-preview">
    <b>Bild Slider</b>
  </div>
<?php } else { ?>
  <div class="image-slider__wrapper">
    <div class="image-slider__container">
      <div class="image-slider__slides">
        <div class="swiper">
          <div class="swiper-wrapper">
            <?= $images ?>
          </div>
        </div>
      </div>
      <div class="image-slider__navigation">
        <div class="swiper-button-next">
          <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor">
            <path d="M664.46-450H210q-12.77 0-21.38-8.62Q180-467.23 180-480t8.62-21.38Q197.23-510 210-510h454.46L532.77-641.69q-8.92-8.93-8.81-20.89.12-11.96 8.81-21.27 9.31-9.3 21.38-9.61 12.08-.31 21.39 9l179.15 179.15q5.62 5.62 7.92 11.85 2.31 6.23 2.31 13.46t-2.31 13.46q-2.3 6.23-7.92 11.85L575.54-275.54q-8.93 8.92-21.19 8.81-12.27-.12-21.58-9.42-8.69-9.31-9-21.08-.31-11.77 9-21.08L664.46-450Z"/>
          </svg>
        </div>
        <div class="swiper-button-prev">
          <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor">
            <path d="m287.46-450 131.69 131.69q8.93 8.93 8.81 20.89-.11 11.96-8.81 21.27-9.3 9.3-21.38 9.61-12.08.31-21.38-9L197.23-454.69q-10.84-10.85-10.84-25.31 0-14.46 10.84-25.31l179.16-179.15q8.92-8.92 21.19-8.81 12.27.12 21.57 9.42 8.7 9.31 9 21.08.31 11.77-9 21.08L287.46-510h470.62q12.77 0 21.38 8.62 8.62 8.61 8.62 21.38t-8.62 21.38q-8.61 8.62-21.38 8.62H287.46Z"/>
          </svg>
        </div>
        <div class="swiper-pagination"></div>
      </div>
    </div>
  </div>
<?php } ?>