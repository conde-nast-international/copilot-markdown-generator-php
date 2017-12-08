<?php
use CopilotTags\Tests\CopilotTagTest;
use CopilotTags\Blockquote;

class BlockquoteTest extends CopilotTagTest
{
    public function expectedWrites()
    {
        return [
            [
                new Blockquote("Hello world!"),
                "Hello world!"
            ]
        ];
    }
}
