<?php
/**
 * User: alec
 * Date: 02.12.18
 * Time: 21:17
 */

namespace AlecRabbit\Constants\String {

    use const \AlecRabbit\Constants\UNIT_HOURS;
    use const \AlecRabbit\Constants\UNIT_MICROSECONDS;
    use const \AlecRabbit\Constants\UNIT_MILLISECONDS;
    use const \AlecRabbit\Constants\UNIT_MINUTES;
    use const \AlecRabbit\Constants\UNIT_SECONDS;

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
