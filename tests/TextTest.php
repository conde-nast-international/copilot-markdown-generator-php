<?php

use PHPUnit\Framework\TestCase;
use CopilotTags\Text;

class TextTest extends CopilotTagTest
{
    public function expectedWrite()
    {
        return [
            [
                new Text("Hello world!"),
                "Hello world!"
            ]
        ];
    }
}
