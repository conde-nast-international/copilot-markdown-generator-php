<?php
use CopilotTags\Tests\CopilotTagTest;
use CopilotTags\InlineText;

class InlineTextTest extends CopilotTagTest
{
    public function expectedWrites()
    {
        return [
            [
                new InlineText("Hello world!"),
                "Hello world!"
            ]
        ];
    }
}
