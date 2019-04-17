<?php


require_once __DIR__ . '/../vendor/autoload.php';

dump(\AlecRabbit\typeOf(1)); // "integer"
dump(\AlecRabbit\typeOf(1.0)); // "float"
dump(\AlecRabbit\typeOf('1.0')); // "string"
dump(\AlecRabbit\typeOf(new \stdClass())); // "stdClass"
dump(\AlecRabbit\typeOf(\AlecRabbit\carbon())); // "Carbon\Carbon"
// requires ext-curl
dump(\AlecRabbit\typeOf(curl_init())); // "resource"

