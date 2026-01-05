<?php
// Fields
$text = ecb_field('text');
?>

<div class="construction__wrapper -content-margin-m">
    <div class="construction__title">
        <?= $text ? nl2br($text) : 'In Bearbeitung' ?>
    </div>
    <?php if ($title) { ?>
        <div class="construction__title">
            <?= nl2br($title) ?>
        </div>
    <?php } ?>
    <?php if ($text) { ?>
        <div class="construction__text">
            <?= nl2br($text) ?>
        </div>
    <?php } ?>
</div>