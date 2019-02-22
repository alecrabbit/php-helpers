<?php

// @codeCoverageIgnoreStart
namespace AlecRabbit\Helpers\Constants;

/** @internal */
define(__NAMESPACE__ . '\UNIT_OFFSET', 3);
/** @internal */
define(__NAMESPACE__ . '\EMPTY_ELEMENTS', ['', null, false]);

define(__NAMESPACE__ . '\DEFAULT_PRECISION', 3);

define(__NAMESPACE__ . '\UNIT_NANOSECONDS', 1000);
define(__NAMESPACE__ . '\UNIT_MICROSECONDS', 1001);
define(__NAMESPACE__ . '\UNIT_MILLISECONDS', 1002);
define(__NAMESPACE__ . '\UNIT_SECONDS', 1003);
define(__NAMESPACE__ . '\UNIT_MINUTES', 1004);
define(__NAMESPACE__ . '\UNIT_HOURS', 1005);

define(__NAMESPACE__ . '\I_01MIN', 60);
define(__NAMESPACE__ . '\I_03MIN', 180);
define(__NAMESPACE__ . '\I_05MIN', 300);
define(__NAMESPACE__ . '\I_15MIN', 900);
define(__NAMESPACE__ . '\I_30MIN', 1800);
define(__NAMESPACE__ . '\I_45MIN', 2700);
define(__NAMESPACE__ . '\I_01HOUR', 3600);
define(__NAMESPACE__ . '\I_02HOUR', 7200);
define(__NAMESPACE__ . '\I_03HOUR', 10800);
define(__NAMESPACE__ . '\I_04HOUR', 14400);
define(__NAMESPACE__ . '\I_01DAY', 86400);

define(
    __NAMESPACE__ . '\UNITS_LIST',
    [
    0 => UNIT_SECONDS,
    1 => UNIT_MILLISECONDS,
    2 => UNIT_MICROSECONDS,
    3 => UNIT_NANOSECONDS,
    ]
);

define(__NAMESPACE__ . '\BRACKETS_SQUARE', 10); // []
define(__NAMESPACE__ . '\BRACKETS_CURLY', 20); // {}
define(__NAMESPACE__ . '\BRACKETS_PARENTHESES', 30); // ()
define(__NAMESPACE__ . '\BRACKETS_ANGLE', 40); // ⟨⟩


define(
    __NAMESPACE__ . '\BRACKETS_SUPPORTED',
    [
    BRACKETS_SQUARE,
    BRACKETS_CURLY,
    BRACKETS_PARENTHESES,
    BRACKETS_ANGLE,
    ]
);

define(__NAMESPACE__ . '\INT_SIZE_32BIT', 4);
define(__NAMESPACE__ . '\INT_SIZE_64BIT', 8);

/** @deprecated */
define(__NAMESPACE__ . '\PHP_ARCH', PHP_INT_SIZE * 8);
