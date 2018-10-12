<?php
/**
 * User: alec
 * Date: 12.10.18
 * Time: 13:21
 */



if (!function_exists('find_files')) {
    /**
     * Find all files in directory recursively matching the regex, by default searches for *.php files
     *
     * @param string $path
     * @param string $regex
     * @return array
     */
    function find_files(string $path, string $regex = '/^.+\.php$/i')
    {
        $files = [];
        $dir = new RecursiveDirectoryIterator($path);
        $iterator = new RecursiveIteratorIterator($dir);
        foreach ($iterator as $file) {
            $filename = $file->getFilename();
            if (preg_match($regex, $filename)) {
                $files[] = $file->getPathname();
            }
        }
        return $files;
    }
}

if (!function_exists('env')) {
    /**
     * Gets the value of an environment variable.
     *
     * @param  string $key
     * @param  mixed $default
     * @return mixed
     */
    function env($key, $default = null)
    {
        $value = getenv($key);

        if ($value === false) {
            return value($default);
        }

        switch (strtolower($value)) {
            case 'true':
            case '(true)':
                return true;
            case 'false':
            case '(false)':
                return false;
            case 'empty':
            case '(empty)':
                return '';
            case 'null':
            case '(null)':
                return null;
        }

        if (($valueLength = strlen($value)) > 1 && $value[0] === '"' && $value[$valueLength - 1] === '"') {
            return substr($value, 1, -1);
        }

        return $value;
    }
}

if (!function_exists('value')) {
    /**
     * Return the default value of the given value.
     *
     * @param  mixed $value
     * @return mixed
     */
    function value($value)
    {
        return $value instanceof Closure ? $value() : $value;
    }
}