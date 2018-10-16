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
        return new \Carbon\Carbon($tz);
    }
}

