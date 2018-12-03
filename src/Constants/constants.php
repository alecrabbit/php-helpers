<?php
/**
 * User: alec
 * Date: 02.12.18
 * Time: 21:17
 */

// @codeCoverageIgnoreStart
namespace AlecRabbit\Constants {

    const DEFAULT_PRECISION = 3;
    const UNIT_MICROSECONDS = 1001;
    const UNIT_MILLISECONDS = 1002;
    const UNIT_SECONDS = 1003;
    const UNIT_MINUTES = 1004;
    const UNIT_HOURS = 1005;

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
