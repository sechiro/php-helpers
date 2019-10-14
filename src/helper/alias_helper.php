<?php

/**
 * htmlspecialcharsの別名
 * @param string $str
 * @return string
 */
function h(string $str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}