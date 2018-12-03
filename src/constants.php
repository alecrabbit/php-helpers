<?php
/**
 * User: alec
 * Date: 02.12.18
 * Time: 21:17
 */

namespace AlecRabbit {

    const STR_CONST = 'AlecRabbit';

//    define(__NAMESPACE__ . '\\STR_CONST', 'AlecRabbit');

    define(__NAMESPACE__ . '\\BRACKETS_SQUARE', 10); // []
    define(__NAMESPACE__ . '\\BRACKETS_CURLY', 20); // {}
    define(__NAMESPACE__ . '\\BRACKETS_PARENTHESES', 30); // ()
    define(__NAMESPACE__ . '\\BRACKETS_ANGLE', 40); //  ⟨⟩

    define(
        __NAMESPACE__ . '\\BRACKETS_SUPPORTED',
        [
            BRACKETS_SQUARE,
            BRACKETS_CURLY,
            BRACKETS_PARENTHESES,
            BRACKETS_ANGLE,
        ]
    );

    define(__NAMESPACE__ . '\\TIME_DEFAULT_PRECISION', 3);
    define(__NAMESPACE__ . '\\TIME_UNIT_MICROSECONDS', 1001);
    define(__NAMESPACE__ . '\\TIME_UNIT_MILLISECONDS', 1002);
    define(__NAMESPACE__ . '\\TIME_UNIT_SECONDS', 1003);
    define(__NAMESPACE__ . '\\TIME_UNIT_MINUTES', 1004);
    define(__NAMESPACE__ . '\\TIME_UNIT_HOURS', 1005);

    define(
        __NAMESPACE__ . '\\TIME_UNITS',
        [
            TIME_UNIT_MICROSECONDS => 'μs',
            TIME_UNIT_MILLISECONDS => 'ms',
            TIME_UNIT_SECONDS => 's',
            TIME_UNIT_MINUTES => 'm',
            TIME_UNIT_HOURS => 'h',
        ]
    );

}

