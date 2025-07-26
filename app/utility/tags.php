<?php

function add_tags($text) {
    $text = str_replace("\r\n", $text);
    $text = str_replace("\r", "\n", $text);
}
