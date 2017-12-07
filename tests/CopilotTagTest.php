<?php

use PHPUnit\Framework\TestCase;
use CopilotTags\CopilotTag;

abstract class CopilotTagTest extends TestCase
{
    /**
     * @dataProvider expectedWrite
     */
    public function testWrite($tag, $expected)
    {
        $this->assertEquals($tag->write(), $expected);
    }

    abstract public function expectedWrite();
}
