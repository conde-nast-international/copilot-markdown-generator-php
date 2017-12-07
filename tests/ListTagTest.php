<?php

use PHPUnit\Framework\TestCase;
use CopilotTags\ListTag;
require_once 'CopilotTagTest.php';

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
