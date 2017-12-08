<?php
use CopilotTags\Tests\CopilotTagTest;
use CopilotTags\ListTag;

class ListTagTest extends CopilotTagTest
{
    public function expectedWrites()
    {
        return [
            [
                new ListTag(["Hello world!"]),
                "Hello world!"
            ]
        ];
    }
}
