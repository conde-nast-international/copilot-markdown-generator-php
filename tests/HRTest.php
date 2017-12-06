<?php

use PHPUnit\Framework\TestCase;
use CopilotTags\HR;

class HRTest extends TestCase
{
    public function testWrite()
    {
        $tag = new HR();
        $this->assertEquals($tag->write(), "\n----------\n");
    }
}
