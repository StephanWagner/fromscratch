<?php
$title = block_value('title');
$content = block_value('content');

global $accordionId;

if (empty($accordionId)) {
	$accordionId = 0;
}
$accordionId += 1;
?>

<div
    class="accordion__wrapper"
	data-id="<?= $accordionId ?>"
    data-close-other-accordions
    data-scroll-to-accordion-top
>
	<div class="accordion__container">
		<div class="accordion__header noselect -hover-line-trigger">
			<div class="accordion__title has-l-font-size -small-mobile-font">
				<?= $title ?>
			</div>
			<div class="accordion__icon hover-line"><span></span></div>
		</div>
		<div class="accordion__content">
            <div class="accordion__content-inner">
                <?= $content ?>
            </div>
		</div>
	</div>
</div>
