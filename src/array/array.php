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

if (!function_exists('unset_first')) {
    function unset_first(iterable $data): iterable
    {
        $key = array_key_first($data);
        unset($data[$key]);
        return $data;
    }
}

if (!function_exists('array_key_first')) {
    /**
     * @param iterable $data
     * @return int|null|string
     */
    function array_key_first(iterable $data)
    {
        reset($data);
        return key($data);
    }
}

if (!function_exists('array_key_last')) {
    /**
     * @param iterable $data
     * @return int|null|string
     */
    function array_key_last(iterable $data)
    {
        end($data);
        return key($data);
    }
}

