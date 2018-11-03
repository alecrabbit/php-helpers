<?php
/**
 * User: alec
 * Date: 12.10.18
 * Time: 15:24
 */

define('BRACKETS_SQUARE', 10); // []
define('BRACKETS_CURLY', 20); // {}
define('BRACKETS_PARENTHESES', 30); // ()
define('BRACKETS_ANGLE', 40); //  ⟨⟩


if (!function_exists('tag')) {
    /**
     * @param string $text
     * @param string|null $tag
     * @return string
     */
    function tag(string $text, string $tag = null): string
    {
        if ($tag)
            $text = sprintf('<%s>%s</%s>', $tag, $text, $tag);
        return $text;
    }
}

if (!function_exists('brackets')) {
    function brackets(string $text, ?int $brackets = null, string $open = '[', string $close = ']'): string
    {
        switch ($brackets) {
            case BRACKETS_CURLY:
                $open = '{';
                $close = '}';
                break;
            case BRACKETS_SQUARE:
                $open = '[';
                $close = ']';
                break;
            case BRACKETS_PARENTHESES:
                $open = '(';
                $close = ')';
                break;
            case BRACKETS_ANGLE:
                $open = '⟨';
                $close = '⟩';
                break;
        }
        $text = sprintf('%s%s%s', $open, $text, $close);
        return $text;
    }
}

if (!function_exists('format_bytes')) {
    define(
        'BYTES_UNITS',
        [
            'B' => 0,
            'KB' => 1,
            'MB' => 2,
            'GB' => 3,
            'TB' => 4,
            'PB' => 5,
            'EB' => 6,
            'ZB' => 7,
            'YB' => 8
        ]);

    function format_bytes(int $bytes, ?string $unit = null, int $decimals = null): string
    {
        $negative = is_negative($bytes);
        if ($negative) {
            $bytes = (int)abs($bytes);
        }
        $value = 0;
        $unit = strtoupper($unit ?? '');
        if ($bytes > 0) {
            // Generate automatic prefix by bytes
            // If wrong prefix given
            if (!array_key_exists($unit, BYTES_UNITS)) {
                $pow = (int)floor(log($bytes) / log(1024));
                $unit = (string)array_search($pow, BYTES_UNITS, true);
            }
            // Calculate byte value by prefix
            $value = ($bytes / 1024 ** floor(BYTES_UNITS[$unit]));
        } else {
            $unit = 'B';
        }
        if ($unit === 'B') {
            $decimals = 0;
        }
        // If decimals is not numeric or decimals is less than 0
        // set default value
        if (!\is_numeric($decimals) || $decimals < 0) {
            $decimals = 2;
        } elseif ($decimals > 24) {
            $decimals = 24;
        }

        // Format output
        return
            sprintf('%s%.' . $decimals . 'f' . $unit, $negative ? '-' : '', $value);
    }
}
