<?php


require_once __DIR__ . '/../../vendor/autoload.php';

$c = \AlecRabbit\carbon('1 month ago');
dump($c);

$c = \AlecRabbit\carbon('1 year ago');
dump($c);