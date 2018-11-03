<?php
/**
 * User: alec
 * Date: 12.10.18
 * Time: 15:53
 */

if (!function_exists('formatted_array')) {
    /**
     * @param iterable $data
     * @param int|null $columns
     * @param callable|null $callback
     * @param int $pad
     * @return iterable
     */
    function formatted_array(iterable $data, ?int $columns = null, ?callable $callback = null, $pad = STR_PAD_RIGHT): iterable
    {
        $columns = $columns ?? 10;
        $result = [];
        $maxLen = 0;
        if ($callback) {
            array_walk($data, $callback);
        }
        foreach ($data as $value) {
            $maxLen = $maxLen < ($len = strlen((string)$value)) ? $len : $maxLen;
        }
        while ($element = array_shift($data)) {
            $tmp[] = str_pad($element, $maxLen, ' ', $pad);
            if (count($tmp) >= $columns) {
                $result[] = implode(' ', $tmp);
                $tmp = [];
            }
        }
        if (!empty($tmp)) {
            $result[] = implode(' ', $tmp);
        }
        return $result;
    }

}

