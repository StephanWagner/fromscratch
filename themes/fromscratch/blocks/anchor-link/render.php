<?php
$anchor = isset($attributes['anchorId']) ? sanitize_title($attributes['anchorId']) : '';

if (!empty($anchor)) {
    echo '<div id="' . esc_attr($anchor) . '">YYYYY</div>';
}
