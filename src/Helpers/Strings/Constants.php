<?php
/**
 * User: alec
 * Date: 02.12.18
 * Time: 21:17
 */

// @codeCoverageIgnoreStart
namespace AlecRabbit\Helpers\Strings\Constants;

use const AlecRabbit\Helpers\Constants\UNIT_HOURS;
use const AlecRabbit\Helpers\Constants\UNIT_MICROSECONDS;
use const AlecRabbit\Helpers\Constants\UNIT_MILLISECONDS;
use const AlecRabbit\Helpers\Constants\UNIT_MINUTES;
use const AlecRabbit\Helpers\Constants\UNIT_NANOSECONDS;
use const AlecRabbit\Helpers\Constants\UNIT_SECONDS;

define(__NAMESPACE__ . '\TIME_UNITS', [
    UNIT_NANOSECONDS => 'ns',
    UNIT_MICROSECONDS => 'μs',
    UNIT_MILLISECONDS => 'ms',
    UNIT_SECONDS => 's',
    UNIT_MINUTES => 'm',
    UNIT_HOURS => 'h',
]);

define(__NAMESPACE__ . '\TIME_COEFFICIENTS', [
    UNIT_NANOSECONDS => 1000000000,
    UNIT_MICROSECONDS => 1000000,
    UNIT_MILLISECONDS => 1000,
    UNIT_SECONDS => 1,
    UNIT_MINUTES => 1 / 60,
    UNIT_HOURS => 1 / 3600,
]);


define(__NAMESPACE__ . '\STR_TRUE', 'true');
define(__NAMESPACE__ . '\STR_FALSE', 'false');
define(__NAMESPACE__ . '\STR_EMPTY', 'empty');
define(__NAMESPACE__ . '\STR_NULL', 'null');

define(__NAMESPACE__ . '\BYTES_UNITS', [
    'B' => 0,
    'KB' => 1,
    'MB' => 2,
    'GB' => 3,
    'TB' => 4,
    'PB' => 5,
    'EB' => 6,
    'ZB' => 7,
    'YB' => 8,
]);
