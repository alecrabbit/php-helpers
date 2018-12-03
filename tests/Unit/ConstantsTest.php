<?php
/**
 * User: alec
 * Date: 03.12.18
 * Time: 17:10
 */

namespace Unit;


use const AlecRabbit\Constants\String\STR_TRUE;
use const AlecRabbit\Constants\String\STR_FALSE;
use const AlecRabbit\Constants\String\STR_EMPTY;
use const AlecRabbit\Constants\String\STR_NULL;
use PHPUnit\Framework\TestCase;

class ConstantsTest extends TestCase
{
    /** @test */
    public function constants(): void
    {
        $this->assertEquals(STR_TRUE, 'true');
        $this->assertEquals(STR_FALSE, 'false');
        $this->assertEquals(STR_EMPTY, 'empty');
        $this->assertEquals(STR_NULL, 'null');
    }
}