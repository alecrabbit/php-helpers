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

if (!function_exists('formatted_array')) {
    function formatted_array(iterable $array, ?int $columns = null, callable $callback = null): iterable
    {
        $columns = $columns ?? 10;
        $str = [];
        $maxLen = 0;
        if ($callback)
            array_walk($array, $callback);
        foreach ($array as $key => $value) {
            $maxLen = $maxLen < ($len = strlen((string)$value)) ? $len : $maxLen;
        }
        while ($element = array_shift($array)) {
            $tmp[] = str_pad($element, $maxLen);
            if (count($tmp) >= $columns) {
                $str[] = implode(' ', $tmp);
                $tmp = [];
            }
        }
        if (!empty($tmp))
            $str[] = implode(' ', $tmp);
        return $str;
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
            $bytes = abs($bytes);
        }
        $value = 0;
        $unit = strtoupper($unit ?? '');
        if ($bytes > 0) {
            // generate automatic prefix by bytes if wrong prefix given
            if (!array_key_exists($unit, BYTES_UNITS)) {
                $pow = floor(log($bytes) / log(1024));
                $unit = array_search($pow, BYTES_UNITS);
            }
            // calculate byte value by prefix
            $value = ($bytes / pow(1024, floor(BYTES_UNITS[$unit])));
        } else {
            $unit = 'B';
        }

        if ($unit == 'B')
            $decimals = 0;

        // if decimals is not numeric or decimals is less than 0
        if (!is_numeric($decimals) || $decimals < 0) {
            // set default value
            $decimals = 2;
        } elseif ($decimals > 24) {
            $decimals = 24;
        }

        // output
        return
            sprintf('%s%.' . $decimals . 'f' . $unit, $negative ? '-' : '', $value);
    }

}
