<?php

use PHPUnit\Framework\TestCase;
use CopilotTags\Heading;
require_once 'CopilotTagTest.php';

class HeadingTest extends CopilotTagTest
{
    public function expectedWrites()
    {
        return [
            [
                new Heading("Hello world!"),
                "Hello world!"
            ]
        ];
    }
}
