<?php

use PHPUnit\Framework\TestCase;
use CopilotTags\Text;

class TextTest extends TestCase
{
    public function testWrite()
    {
        $tag = new Text("Hello world!");
        $this->assertEquals($tag->write(), "Hello world!");
    }
}
