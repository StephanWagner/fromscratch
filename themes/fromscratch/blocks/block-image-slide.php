<?php
$image = block_value('image');
if (!empty($image)) {
  $imageSrc = wp_get_attachment_image_src($image, 'medium');
  $imageSrc = $imageSrc[0];
}
?>

<?php if (ecb_admin()) { ?>
  <div class="admin-block-preview">
      <b>Bild Slider: Bild</b>
  </div>
<?php } else { ?>
  <?php if (!empty($imageSrc)) { ?>
    <div
      class="image-slider__slide swiper-slide"
      style="background-image: url('<?= $imageSrc ?>');"
    ></div>
  <?php } ?>
<?php } ?>