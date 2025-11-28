<?php
// Fields
$text = ecb_field('text');
?>

<div class="todo__wrapper -content-margin-m">
    <div class="todo__content">
        <?= $text ? nl2br($text) : 'TODO' ?>
    </div>
</div>