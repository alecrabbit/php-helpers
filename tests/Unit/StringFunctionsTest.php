<?php
/**
 * User: alec
 * Date: 12.10.18
 * Time: 15:29
 */

namespace Unit;


use PHPUnit\Framework\TestCase;

class StringFunctionsTest extends TestCase
{
    /** @test */
    public function FunctionTag(){
        $this->assertEquals('<br>str</br>', tag('str', 'br'));
        $this->assertEquals('str', tag('str'));
    }

    /** @test */
    public function FunctionBrackets(){
        $this->assertEquals('[str]', brackets('str'));
        $this->assertEquals('[str]', brackets('str',BRACKETS_SQUARE));
        $this->assertEquals('{str}', brackets('str',BRACKETS_CURLY));
        $this->assertEquals('(str)', brackets('str', BRACKETS_PARENTHESES));
        $this->assertEquals('⟨str⟩', brackets('str', BRACKETS_ANGLE));
        $this->assertEquals('<ddstr/dd>', brackets('str', null, '<dd', '/dd>'));
    }
}