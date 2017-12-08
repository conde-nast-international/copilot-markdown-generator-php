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

    abstract public function expectedWrites();
}
