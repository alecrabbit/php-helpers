<?php

namespace AlecRabbit\Helpers\Constants;

/** @internal */
define(__NAMESPACE__ . '\UNIT_OFFSET', 3);

define(__NAMESPACE__ . '\DEFAULT_PRECISION', 3);

define(__NAMESPACE__ . '\UNIT_NANOSECONDS', 1000);
define(__NAMESPACE__ . '\UNIT_MICROSECONDS', 1001);
define(__NAMESPACE__ . '\UNIT_MILLISECONDS', 1002);
define(__NAMESPACE__ . '\UNIT_SECONDS', 1003);
define(__NAMESPACE__ . '\UNIT_MINUTES', 1004);
define(__NAMESPACE__ . '\UNIT_HOURS', 1005);

define(
    __NAMESPACE__ . '\UNITS', [
    0 => UNIT_SECONDS,
    1 => UNIT_MILLISECONDS,
    2 => UNIT_MICROSECONDS,
    3 => UNIT_NANOSECONDS,
]);

define(__NAMESPACE__ . '\BRACKETS_SQUARE', 10);  // []
define(__NAMESPACE__ . '\BRACKETS_CURLY', 20);  // {}
define(__NAMESPACE__ . '\BRACKETS_PARENTHESES', 30);  // ()
define(__NAMESPACE__ . '\BRACKETS_ANGLE', 40);  // ⟨⟩


define(
    __NAMESPACE__ . '\BRACKETS_SUPPORTED', [
    BRACKETS_SQUARE,
    BRACKETS_CURLY,
    BRACKETS_PARENTHESES,
    BRACKETS_ANGLE,
]);
