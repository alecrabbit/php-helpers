<?php declare(strict_types=1);

namespace AlecRabbit\Helpers\Classes;

/**
 * Class System
 *
 * @internal
 */
final class System
{
    protected const CGROUP_FILE = '/proc/1/cgroup';
    protected const CGROUP_PATTERN = '(lxc|docker|kubepods)';

    /**
     * Determine if run in container
     *
     * @return bool
     *
     * @codeCoverageIgnore
     *
     * @link https://stackoverflow.com/a/20012536
     */
    public static function inContainer(): bool
    {
        if (file_exists(self::CGROUP_FILE)
            && ($content = file_get_contents(self::CGROUP_FILE))
            && preg_match(self::CGROUP_PATTERN, $content)) {
            return true;
        }
        return false;
    }
}
