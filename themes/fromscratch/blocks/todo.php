<?php
// Fields
$text = ecb_field('text');
?>

<div class="todo__wrapper -content-margin-s">
    <?= $text ? nl2br($text) : 'TODO' ?>
</div>