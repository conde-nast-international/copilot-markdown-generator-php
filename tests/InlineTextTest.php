<?php

use PHPUnit\Framework\TestCase;
use CopilotTags\InlineText;
require_once 'CopilotTagTest.php';

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
