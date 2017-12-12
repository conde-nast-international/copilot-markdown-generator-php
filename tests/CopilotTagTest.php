<?php
namespace CopilotTags\Tests;
use PHPUnit\Framework\TestCase;

abstract class CopilotTagTest extends TestCase
{
    /**
     * @dataProvider expectedWrites
     */
    public function testWrite($tag, $expected)
    {
        $this->assertEquals($expected, $tag->write());
    }

    /**
     * @dataProvider expectedConstructExceptions
     */
    public function testConstructException($class = NULL, $args = [], $exceptionType = Exception::class)
    {
        if (!isset($class)) return;
        $this->expectException($exceptionType);
        new $class(...$args);
    }

    public function expectedConstructExceptions() { return [[]]; }
    abstract public function expectedWrites();
}
