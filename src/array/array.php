<?php
/**
 * User: alec
 * Date: 12.10.18
 * Time: 15:53
 */

if (!function_exists('formatted_array')) {
    function formatted_array(iterable $data, ?int $columns = null, callable $callback = null): iterable
    {
        $columns = $columns ?? 10;
        $result = [];
        $maxLen = 0;
        if ($callback) {
//            $data = array_map($callback, $data);
            array_walk($data, $callback);
        }
        foreach ($data as $key => $value) {
            $maxLen = $maxLen < ($len = strlen((string)$value)) ? $len : $maxLen;
        }
        while ($element = array_shift($data)) {
            $tmp[] = str_pad($element, $maxLen);
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

