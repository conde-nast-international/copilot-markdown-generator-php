<?php

use PHPUnit\Framework\TestCase;
use CopilotTags\Section;
require_once 'CopilotTagTest.php';

class SectionTest extends CopilotTagTest
{
    public function expectedWrites()
    {
        return [
            [
                new Section("Hello world!"),
                "Hello world!"
            ]
        ];
    }
}
