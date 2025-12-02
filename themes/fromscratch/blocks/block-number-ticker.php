<?php
$items = [
    [
        'number' => block_value('number1'),
        'text' => block_value('text1'),
        'unit' => block_value('unit1'),
    ],
    [
        'number' => block_value('number2'),
        'text' => block_value('text2'),
        'unit' => block_value('unit2'),
    ],
    [
        'number' => block_value('number3'),
        'text' => block_value('text3'),
        'unit' => block_value('unit3'),
    ],
    [
        'number' => block_value('number4'),
        'text' => block_value('text4'),
        'unit' => block_value('unit4'),
    ],
];
?>

<div class="number-ticker__wrapper -content-margin-xl">
    <div class="number-ticker__container">

        <div class="number-ticker__items">
            <?php
            $index = 1;
            foreach ($items as $item) {
                if ($item['number']) {
            ?>
                    <div class="number-ticker__item -col<?= $index ?>">
                        <div class="number-ticker__number-container">
                            <span class="number-ticker__number" data-countup="<?= $item['number'] ?>">0</span>
                            <?php if ($item['unit']) { ?>
                                <span class="number-ticker__unit"><?= $item['unit'] ?></span>
                            <?php } ?>
                        </div>
                        <div class="number-ticker__number-text h4">
                            <?= $item['text'] ?>
                        </div>
                    </div>
            <?php
                    $index++;
                }
            }
            ?>
        </div>

    </div>
</div>