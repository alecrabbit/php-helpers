<?php
/**
 * User: alec
 * Date: 12.10.18
 * Time: 14:18
 */

if (!function_exists('now')) {
    /**
     * Create a new Carbon instance for the current time.
     *
     * @param  \DateTimeZone|string|null $tz
     * @return \Carbon\Carbon
     */
    function now($tz = null)
    {
        return new \Carbon\Carbon(null, $tz);
    }
}

if (!function_exists('base_timestamp')) {
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
}
