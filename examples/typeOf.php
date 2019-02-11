<?php


require_once __DIR__ . '/../vendor/autoload.php';

dump(\AlecRabbit\typeOf(1.0));
dump(\AlecRabbit\typeOf('1.0'));
dump(\AlecRabbit\typeOf(new \stdClass()));
dump(\AlecRabbit\typeOf(\AlecRabbit\carbon()));
dump(\AlecRabbit\typeOf(curl_init()));

