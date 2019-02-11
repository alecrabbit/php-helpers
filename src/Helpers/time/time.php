<?php
/**
 * User: alec
 * Date: 12.10.18
 * Time: 14:18
 */

namespace AlecRabbit;

/**
 * Create a new Carbon instance for the current time.
 *
 * @param  \DateTimeZone|string|null $tz
 * @return \Carbon\Carbon
 * @throws \Exception
 */
function now($tz = null)
{
    return new \Carbon\Carbon(null, $tz);
}

/**
 * @param string|null               $time
 * @param \DateTimeZone|string|null $tz
 * @return \Carbon\Carbon
 * @throws \Exception
 */
function carbon($time = null, $tz = null)
{
    return new \Carbon\Carbon($time, $tz);
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
    return \intdiv($timestamp, $interval) * $interval;
}
