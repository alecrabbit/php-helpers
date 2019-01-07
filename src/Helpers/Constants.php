<?php

namespace AlecRabbit\Helpers\Constants {

    /** @internal */
    const UNIT_OFFSET = 3;

    const DEFAULT_PRECISION = 3;
    const UNIT_NANOSECONDS = 1000;
    const UNIT_MICROSECONDS = 1001;
    const UNIT_MILLISECONDS = 1002;
    const UNIT_SECONDS = 1003;
    const UNIT_MINUTES = 1004;
    const UNIT_HOURS = 1005;

    const UNITS = [
        3 => UNIT_NANOSECONDS,
        2 => UNIT_MICROSECONDS,
        1 => UNIT_MILLISECONDS,
        0 => UNIT_SECONDS,
    ];

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
}