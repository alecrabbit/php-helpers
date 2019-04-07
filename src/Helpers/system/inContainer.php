<?php declare(strict_types=1);

//// https://stackoverflow.com/a/20012536
//function checkInContainer () {
//  const fs = require('fs')
//  if (fs.existsSync(`/proc/1/cgroup`)) {
//    const content = fs.readFileSync(`/proc/1/cgroup`, 'utf-8')
//    return /:\/(lxc|docker|kubepods)\//.test(content)
//  }
//}

const CGROUP_FILE = '/proc/1/cgroup';
const CGROUP_PATTERN = '(lxc|docker|kubepods)';

function inContainer(): bool
{
    if (file_exists(CGROUP_FILE)) {
        $content = file_get_contents(CGROUP_FILE);
        if (preg_match(CGROUP_PATTERN, $content)) {
            return true;
        }
        return false;
    }
}

dump(inContainer());
