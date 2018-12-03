<?php
/**
 * User: alec
 * Date: 02.12.18
 * Time: 21:17
 */

namespace AlecRabbit\Constants {

    const BRACKETS_SQUARE = 10; // []
    const BRACKETS_CURLY = 20; // {}
    const BRACKETS_PARENTHESES = 30; // ()
    const BRACKETS_ANGLE = 40; //  ⟨⟩

    const BRACKETS_SUPPORTED = [
        BRACKETS_SQUARE,
        BRACKETS_CURLY,
        BRACKETS_PARENTHESES,
        BRACKETS_ANGLE,
    ];

    const DEFAULT_PRECISION = 3;
    const UNIT_MICROSECONDS = 1001;
    const UNIT_MILLISECONDS = 1002;
    const UNIT_SECONDS = 1003;
    const UNIT_MINUTES = 1004;
    const UNIT_HOURS = 1005;

    const TIME_UNITS = [
        UNIT_MICROSECONDS => 'μs',
        UNIT_MILLISECONDS => 'ms',
        UNIT_SECONDS => 's',
        UNIT_MINUTES => 'm',
        UNIT_HOURS => 'h',
    ];

    const STR_TRUE = 'true';
    const STR_FALSE = 'false';
    const STR_EMPTY = 'empty';
    const STR_NULL = 'null';

    const BYTES_UNITS = [
        'B' => 0,
        'KB' => 1,
        'MB' => 2,
        'GB' => 3,
        'TB' => 4,
        'PB' => 5,
        'EB' => 6,
        'ZB' => 7,
        'YB' => 8
    ];
}
