<?php

use PHPUnit\Framework\TestCase;
use CopilotTags\Embed;
use CopilotTags\EmbedSubtype;

class EmbedTest extends TestCase
{
    public function testWrite()
    {
        $tag = new Embed("https://www.google.com", EmbedSubtype::IFRAME);
        $this->assertEquals($tag->write(), "\n\n[#iframe:https://www.google.com]\n");
    }
}
