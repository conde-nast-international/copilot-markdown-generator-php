<?php

use PHPUnit\Framework\TestCase;
use CopilotTags\Blockquote;
require_once 'CopilotTagTest.php';

class BlockquoteTest extends CopilotTagTest
{
    public function expectedWrites()
    {
        return [
            [
                new Blockquote("Hello world!"),
                "Hello world!"
            ]
        ];
    }
}
