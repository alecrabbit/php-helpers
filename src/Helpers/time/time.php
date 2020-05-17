<?php
/**
 * User: alec
 * Date: 12.10.18
 * Time: 14:18
 */

namespace AlecRabbit;

use Carbon\Carbon;

use Carbon\CarbonInterface;
use DateTimeZone;
use Exception;

use function intdiv;
use function is_int;

/**
 * Create a new Carbon instance for the current time.
 *
 * @param  DateTimeZone|string|null $tz
 * @return CarbonInterface
 * @throws Exception
 */
function now($tz = null)
{
    return Carbon::now($tz);
}

/**
 * @param string|null|int $time
 * @param DateTimeZone|string|null $tz
 * @return CarbonInterface
 * @throws Exception
 */
function carbon($time = null, $tz = null)
{
    return
        is_int($time) ?
            Carbon::createFromTimestamp($time, $tz) :
            new Carbon($time, $tz);
}

/**
 * Calculate timestamp of start of interval.
 *
 * @param int $timestamp
 * @param int $interval
 * @return int
 */
function base_timestamp(int $timestamp, int $interval = 60): int
{
    return intdiv($timestamp, $interval) * $interval;
}
