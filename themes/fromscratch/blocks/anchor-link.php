<?php
// Fields
$id = block_field('id');
?>

<?php if (is_admin()) { ?>
    <div class="block-preview__wrapper">
        <b>Anker Link:</b> <code><?= $id ?></code>
    </div>
<?php } else { ?>
    <div data-anchor="<?= $id ?>"></div>
<?php } ?>