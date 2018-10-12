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

