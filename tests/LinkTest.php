<?php
use CopilotTags\Tests\CopilotTagTest;
use CopilotTags\Link;

class LinkTest extends CopilotTagTest
{
    public function expectedWrites()
    {
        return [
            [
                new Link("Hello world!"),
                "Hello world!"
            ]
        ];
    }
}
