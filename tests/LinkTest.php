<?php

use PHPUnit\Framework\TestCase;
use CopilotTags\Link;
require_once 'CopilotTagTest.php';

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
