<?php

use PHPUnit\Framework\TestCase;
use CopilotTags\Text;
require_once 'CopilotTagTest.php';

class TextTest extends CopilotTagTest
{
    public function expectedWrites()
    {
        return [
            [
                new Text("Hello world!"),
                "Hello world!"
            ]
        ];
    }
}
