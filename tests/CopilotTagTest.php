<?php

use PHPUnit\Framework\TestCase;

abstract class CopilotTagTest extends TestCase
{
    /**
     * @dataProvider expectedWrites
     */
    public function testWrite($tag, $expected)
    {
        $this->assertEquals($tag->write(), $expected);
    }

    abstract public function expectedWrites();
}
